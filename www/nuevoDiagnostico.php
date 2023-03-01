
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO diagnostico (idDiagnostico, diagnosticoCategoria, diagnosticoDescripcion) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['idDiagnostico'], "text"),
					   GetSQLValueString($_POST['diagnosticoCategoria'], "text"),
                       GetSQLValueString($_POST['diagnosticoDescripcion'], "text"));

  mysql_select_db($database_hc, $hc);
  $Result1 = mysql_query($insertSQL, $hc) or die(mysql_error());

  $insertGoTo = "listarDiagnostico.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
 require_once("includes/logout.php"); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$queryString_rsBuscar = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsBuscar") == false && 
        stristr($param, "totalRows_rsBuscar") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsBuscar = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsBuscar = sprintf("&totalRows_rsBuscar=%d%s", $totalRows_rsBuscar, $queryString_rsBuscar);
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
    <td width="25%" valign="top"><?php include("includes/menu2.php"); ?></td>
    <td width="75%">&nbsp;
      <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
        <table align="center">
          <tr valign="baseline">
            <td colspan="2" align="right" nowrap class="h2">Nuevo Diagn&oacute;stico </td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">IdDiagnostico:</td>
            <td><input name="idDiagnostico" type="text" id="idDiagnostico" value="" size="10" maxlength="10"></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">DiagnosticoCategoria:</td>
            <td><input type="text" name="diagnosticoCategoria" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td align="right" valign="top" nowrap class="titlebar">DiagnosticoDescripcion:</td>
            <td>
              <textarea name="diagnosticoDescripcion" cols="60" rows="6"></textarea>
            </td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">&nbsp;</td>
            <td><input type="submit" class="btn btn-dark" value="Guardar"></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1">
      </form>
    <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><p>&nbsp;</p></td>
  </tr>
</table>
<?php require("includes/pie.php"); ?>
</body>
</html>
