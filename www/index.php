<?php
// *** Start the session
@session_start();

//Connection statement
require_once('Connections/qualitat_ado.php');

//Aditional Functions
require_once('includes/functions.inc.php');

//debug
/* if ($_REQUEST) {
  echo '<pre>';
  echo htmlspecialchars(print_r($_REQUEST, true));
  echo '</pre>';
} */

// begin Recordset
$maxRows_rsConsultas = 1;
$pageNum_rsConsultas = 0;
if (isset($_GET['pageNum_rsConsultas'])) {
  $pageNum_rsConsultas = $_GET['pageNum_rsConsultas'];
}
$startRow_rsConsultas = $pageNum_rsConsultas * $maxRows_rsConsultas;
$query_rsConsultas = "SELECT descripcionFecha FROM descripcion ORDER BY descripcionFecha DESC";
$rsConsultas = $qualitat->SelectLimit($query_rsConsultas, $maxRows_rsConsultas, $startRow_rsConsultas) or die($qualitat->ErrorMsg());
if (isset($_GET['totalRows_rsConsultas'])) {
  $totalRows_rsConsultas = $_GET['totalRows_rsConsultas'];
} else {
  $all_rsConsultas = $qualitat->SelectLimit($query_rsConsultas) or die($qualitat->ErrorMsg());
  $totalRows_rsConsultas = $all_rsConsultas->RecordCount();
}
$totalPages_rsConsultas = (int)(($totalRows_rsConsultas-1)/$maxRows_rsConsultas);
// end Recordset

// begin Recordset
$query_rsPacientes = "SELECT pacienteFecha FROM paciente ORDER BY pacienteFecha DESC";
$rsPacientes = $qualitat->SelectLimit($query_rsPacientes) or die($qualitat->ErrorMsg());
$totalRows_rsPacientes = $rsPacientes->RecordCount();
// end Recordset

// Añadir Sal
require_once('includes/sal.php');
$passw = md5 (isset($_POST['pass']).$sal);
//echo $passw;

// *** Validate request to log in to this site.
$KT_LoginAction = $_SERVER["REQUEST_URI"];
if (isset($_POST["user"])) {
  $KT_valUsername = $_POST['user'];
  $KT_fldUserAuthorization = "idUsuario";
  $KT_redirectLoginSuccess = "sistema.php";
  $KT_redirectLoginFailed = "index.php?action=fail";
  $KT_rsUser_Source = "SELECT usuarioUser, usuarioPass ";
  if ($KT_fldUserAuthorization != "") $KT_rsUser_Source .= "," . $KT_fldUserAuthorization;
  $KT_rsUser_Source .= " FROM usuario WHERE usuarioUser='" . $KT_valUsername . "' AND usuarioPass='" . $_POST['pass'] . "'";
  $KT_rsUser=$qualitat->Execute($KT_rsUser_Source) or DIE($qualitat->ErrorMsg());
  if (!$KT_rsUser->EOF) {
    // username and password match - this is a valid user
  $KT_Username=$KT_valUsername;
  $MM_Username=$KT_valUsername;

  KT_session_register("MM_Username");
  KT_session_register("KT_Username");
    if ($KT_fldUserAuthorization != "") {
      $KT_userAuth=$KT_rsUser->Fields($KT_fldUserAuthorization);
    } else {
      $KT_userAuth="";
    }

    KT_session_register("KT_userAuth");
    if (isset($_GET['accessdenied']) && false) {
      $KT_redirectLoginSuccess = $_GET['accessdenied'];
    }
    $KT_rsUser->Close();

    KT_session_register("KT_login_failed");
    $KT_login_failed = false;
    // Add code here if you want to do something if login succeded

KT_redir($KT_redirectLoginSuccess);
  }
  $KT_rsUser->Close();
  $KT_login_failed = true;

  KT_session_register("KT_login_failed");
  // Add code here if you want to do something if login fails

KT_redir($KT_redirectLoginFailed);
}

?>
<html>
<head>
  <title>qualit&auml;t</title>
  <meta http-equiv="Content-Type" content="text/html;">
  <link href="CSS/Level3_1.css" rel="stylesheet" type="text/css">

  <link href="css/custom/main.css" rel="stylesheet"/>
  <link href="css/bootstrap.min.css" rel="stylesheet"/>
  <script src="js/bootstrap.min.js"></script>
  <script src="https://www.google.com/recaptcha/api.js?render=6LfydpQUAAAAAHqAYvxs6_LjxcdOC2xsMRM-Cw93"></script>

</head>
<body>
  <!-- <script>
grecaptcha.ready(function() {
    grecaptcha.execute('6LfydpQUAAAAAHqAYvxs6_LjxcdOC2xsMRM-Cw93', {action: 'admin'}).then(function(token) {
       ...
    });
});
</script> -->
<div class="bg">
<a class="navbar-brand" href="http://www.qsoftware.biz/qmedic_descripcion/" target="_blank">
  <img src="images/qmedic.gif" alt="QMedic"
        width="120"></a>
        <hr/>
  <table border="0" cellpadding="0" cellspacing="0" width="900">
    <tr>
    <td><img src="images/spacer.gif" width="97" height="1" border="0" alt=""></td>
    <td><img src="images/spacer.gif" width="110" height="1" border="0" alt=""></td>
    <td><img src="images/spacer.gif" width="11" height="1" border="0" alt=""></td>
    <td><img src="images/spacer.gif" width="75" height="1" border="0" alt=""></td>
    <td><img src="images/spacer.gif" width="31" height="1" border="0" alt=""></td>
    <td><img src="images/spacer.gif" width="111" height="1" border="0" alt=""></td>
    <td><img src="images/spacer.gif" width="342" height="1" border="0" alt=""></td>
    <td><img src="images/spacer.gif" width="123" height="1" border="0" alt=""></td>
    <td><img src="images/spacer.gif" width="1" height="1" border="0" alt=""></td>
    </tr>

    <tr>
    <td colspan="4"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr class="table-dark">
        <td width="7%">&nbsp;</td>
        <td width="93%" class="h2"><hr/>
        Bienvenidos
        <hr/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><form action="<?php echo $KT_LoginAction?>" method="POST" name="entrar" id="entrar">
          <p>
            Usuario:<br><input name="user" type="text" class="campo" id="user">
            <br>
            Contraseña:<br><input name="pass" type="password" class="campo" id="pass">
            <br>
            <input name="Submit" type="submit" class="btn btn-dark" value="Entrar">
                </p>
          </form></td>
      </tr>
      <?php if (isset($_GET['action']) == "fail") { // action fail ?>
        <div class="alert alert-danger" role="alert">
          Fallo en usuario o clave
        </div>
      <?php } // action Fail ?>
    </table></td>
    <td><img src="images/spacer.gif" width="1" height="226" border="0" alt=""></td>
    </tr>
    <tr>
    <td colspan="7">
      <blockquote><p class="h4">Estadísticas:</p>
        <p> <?php echo $totalRows_rsPacientes ?> Pacientes (<?php echo $rsPacientes->Fields('pacienteFecha'); ?>) </p>
        <p><?php echo $totalRows_rsConsultas ?> Consultas (<?php echo $rsConsultas->Fields('descripcionFecha'); ?> ) </p>
      </blockquote>
    </td>
    <td >&nbsp; </td>
    <td><img src="images/spacer.gif" width="1" height="139" border="0" alt=""></td>
    </tr>
  </table>
  <div class="row">
        <div class="col-8 col-sm-6">
          (c) 2020
        </div>
        <div class="col col-4 col-sm-6 align-self-end">
          <a class="navbar-brand" href="http://www.qsoftware.biz/" target="_blank">
            <img src="images/qualitat-curvas-sombra-exp.png" alt="QSoftware.biz" width="180">
          </a>  
        </div>
  </div>
</div>
</body>
</html>
<?php
$rsConsultas->Close();

$rsPacientes->Close();
?>
