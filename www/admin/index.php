<?php
@session_start();

//Connection statement
require_once('../Connections/qualitat_ado.php');
//Aditional Functions
require_once('../includes/functions.inc.php');

//debug
/* if ($_REQUEST) {
  echo '<pre>';
  echo htmlspecialchars(print_r($_REQUEST, true));
  echo '</pre>';
} */
/* if (isset($accesscheck)) {
  $GLOBALS['PrevUrl'] = $accesscheck;
  session_register('PrevUrl');
} */

$loginFormAction = $_SERVER['PHP_SELF'];

  //Salt + Hash
  require_once('../includes/sal.php');
  $passw = password_hash(isset($_POST['pass']), PASSWORD_DEFAULT);
  echo $passw;

  // *** Validate request to login to this site.
  // SELECT * FROM usuario, usuarionivel WHERE usuario.idUsuario = usuarionivel.idUsuario AND usuarionivel.idNivel = 1
  $KT_LoginAction = $_SERVER["REQUEST_URI"];
  if (isset($_POST["user"])) {
    $KT_valUsername = $_POST['user'];
    $KT_fldUserAuthorization = "idUsuario";
    $KT_redirectLoginSuccess = "listarUsuario.php";
    $KT_redirectLoginFailed = "index.php?action=fail";
    $KT_rsUser_Source = "SELECT usuarioUser, usuarioPass ";

    if ($KT_fldUserAuthorization != "") $KT_rsUser_Source .= "," . $KT_fldUserAuthorization;
    $KT_rsUser_Source .= " FROM usuario WHERE usuarioUser='" . $KT_valUsername."'"; // . "' AND usuarioPass='" . $passw . "'";
    $KT_rsUser=$qualitat->Execute($KT_rsUser_Source) or DIE($qualitat->ErrorMsg());
    if (!$KT_rsUser->EOF) {
      if (password_verify($KT_rsUser->Fields('usuarioPass'), $passw)) {
        echo '¡La contraseña es válida!';

        $KT_Username=$KT_valUsername;
        $MM_Username=$KT_valUsername;
    
        KT_session_register("MM_Username");
        KT_session_register("KT_Username");

        // username and password match - this is a valid user

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

      } else {
          //echo 'La contraseña no es válida.';

          $KT_rsUser->Close();
          $KT_login_failed = true;
      
          KT_session_register("KT_login_failed");
          // Add code here if you want to do something if login fails
      
          KT_redir($KT_redirectLoginFailed);
      }




    }

    // No existe el usuario
    $KT_rsUser->Close();
    $KT_login_failed = true;

    KT_session_register("KT_login_failed");
    // Add code here if you want to do something if login fails

    KT_redir($KT_redirectLoginFailed);
  }

?>
<html>
  <head>
    <title>Administraci&oacute;n</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

    <link href="../css/custom/main.css" rel="stylesheet"/>
    <link href="../css/bootstrap.min.css" rel="stylesheet"/>
    <script src="../js/bootstrap.min.js"></script>
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
<table width="813" height="206" border="0" cellpadding="0" cellspacing="0" class="Headding">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
      &nbsp;
    </td>
  </tr>
  <tr>
    <td>
      &nbsp;
    </td>
    <td><form action="<?php echo $loginFormAction; ?>" method="POST" name="administracion" id="administracion">
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="2">
        <tr>
          <td colspan="3"><p>&nbsp;</p>
           </td>
        </tr>
        <tr>
          <td colspan="3" class="h1"><hr />
            Administraci&oacute;n
          </td>
        </tr>
        <tr>
          <td>
          <?php //action fail
              if (isset($_GET['action'])) { // action fail ?>
              <div class="alert alert-danger" role="alert">
                Fallo en usuario o clave
              </div>
            <?php } // action Fail ?>
          </td>
        </tr>
        <tr>
          <td width="38%">
          <div align="right" class="navLink">Usuario</div></td>
          <td width="4%">:</td>
          <td width="58%"><input name="user" type="text" id="user"></td>
        </tr>
        <tr>
          <td><div align="right" class="navLink">Contrase&ntilde;a</div></td>
          <td>:</td>
          <td><input name="pass" type="password" id="pass"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><input type="submit" class="btn btn-dark" name="submit" value="Entrar"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </form></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</body>
</html>
