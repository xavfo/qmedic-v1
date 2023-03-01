<?php
session_start();

//Fechas
require_once('includes/fechas.php');


//Connection statement
require_once('Connections/qualitat_ado.php');

//Aditional Functions
require_once('includes/functions.inc.php');

// build the form action
$editFormAction = $_SERVER['PHP_SELF'] . (isset($_SERVER['QUERY_STRING']) ? "?" . $_SERVER['QUERY_STRING'] : "");

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO descripcion (descripcionFecha, descripcionEvolucion, descripcionTratamiento) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['descripcionFecha'], "date"),
                       GetSQLValueString($_POST['descripcionEvolucion'], "text"),
                       GetSQLValueString($_POST['descripcionTratamiento'], "text"));

  $Result1 = $qualitat->Execute($insertSQL) or die($qualitat->ErrorMsg());

  $insertGoTo = "nuevoSeguimiento.php?mensaje=GUARDADO";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  KT_redir($insertGoTo);
}

// begin Recordset
$colname__rsDescripcion = '-1';
if (isset($_GET['idPaciente'])) {
  $colname__rsDescripcion = $_GET['idPaciente'];
}
$query_rsDescripcion = sprintf("SELECT * FROM descripcion WHERE idPaciente = %s", $colname__rsDescripcion);
$rsDescripcion = $qualitat->SelectLimit($query_rsDescripcion) or die($qualitat->ErrorMsg());
$totalRows_rsDescripcion = $rsDescripcion->RecordCount();
// end Recordset

//PHP ADODB document - made with PHAkt 2.7.2
?>
<?php
//initialize the session
session_start();

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  session_unregister('MM_Username');
  session_unregister('MM_UserGroup');
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>

<html>
<head>
<title>qualit&auml;t</title>
<meta http-equiv="Content-Type" content="text/html;">
<!--Fireworks MX 2004 Dreamweaver MX 2004 target.  Created Wed Mar 16 20:44:01 GMT-0500 2005-->
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <script src="js/bootstrap.min.js"></script>
<body bgcolor="#ffffff"> 
<?php require("includes/head.php"); ?> 
<table width="754"  border="0" cellspacing="0" cellpadding="0"> 
  <tr> 
    <td width="25%" valign="top"><?php include("includes/menu1.php"); ?></td> 
    <td width="75%">&nbsp; 
    <p>&nbsp;</p>
    <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
      <p align="center" class="navLink"><?php echo $_GET['mensaje']; ?></p>
      <table align="center">
        <tr valign="baseline">
          <td colspan="2" align="right" nowrap class="h2">Nueva Consulta</td>
          </tr>
        <tr valign="baseline">
          <td nowrap align="right">IdDescripcion:</td>
          <td></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">IdPaciente:</td>
          <td></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">DescripcionFecha:</td>
          <td><input type="text" name="descripcionFecha" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right" valign="top">DescripcionEvolucion:</td>
          <td>
            <textarea name="descripcionEvolucion" cols="60" rows="6">
    </textarea>
          </td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right" valign="top">DescripcionTratamiento:</td>
          <td>
            <textarea name="descripcionTratamiento" cols="60" rows="6">
    </textarea>
          </td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">&nbsp;</td>
          <td><input type="submit" class="btn btn-dark" value="Guardar"></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form1">
    </form>
    <p>&nbsp;</p></td> 
  </tr> 
</table> 
<?php require("includes/pie.php"); ?>
</body>
</html>
<?php
$rsDescripcion->Close();

mysql_free_result($rsEdad);

mysql_free_result($rsClase);

mysql_free_result($rsEstado);

mysql_free_result($rsGenero);

mysql_free_result($rsInstruccion);

mysql_free_result($rsResidencia);
?>
