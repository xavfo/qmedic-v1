<?php

// *** Start the session
@session_start();

require_once("includes/logout.php"); 

$currentPage = $_SERVER["PHP_SELF"];

//Connection statement
require_once('Connections/qualitat_ado.php');

// begin Recordset
$query_rsDiagnosticos = "SELECT * FROM diagnostico ORDER BY diagnosticoCategoria ASC";
$rsDiagnosticos = $qualitat->SelectLimit($query_rsDiagnosticos) or die($qualitat->ErrorMsg());
$totalRows_rsDiagnosticos = $rsDiagnosticos->RecordCount();
// end Recordset

// begin Recordset
$KTParam1__Recordset1 = '-1';
if (isset($_GET['recordID'])) {
  $KTParam1__Recordset1 = $_GET['recordID'];
}
$query_Recordset1 = sprintf("SELECT * FROM diagnostico WHERE idDiagnostico = '%s' order by diagnosticoCategoria ASC", $KTParam1__Recordset1);
$Recordset1 = $qualitat->SelectLimit($query_Recordset1) or die($qualitat->ErrorMsg());
$totalRows_Recordset1 = $Recordset1->RecordCount();
// end Recordset

//PHP ADODB document - made with PHAkt 2.7.2


 

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
      <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <script src="js/bootstrap.min.js"></script>
<body bgcolor="#ffffff">

<?php require("includes/head.php"); ?>
<table width="754"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="25%" valign="top"><?php include("includes/menu2.php"); ?></td>
    <td width="75%"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="sidebarFooter">
      <tr align="right">
        <td colspan="2" class="h2">Editar Diagn&oacute;stico </td>
        </tr>
      <tr>
        <td width="30%" align="right" class="titlebar">id</td>
        <td width="70%"><?php echo $Recordset1->Fields('idDiagnostico')?></td>
      </tr>
      <tr>
        <td align="right" class="titlebar">Categoria</td>
        <td><?php echo $Recordset1->Fields('diagnosticoCategoria')?></td>
      </tr>
      <tr>
        <td align="right" class="titlebar">Descripcion</td>
        <td><?php echo $Recordset1->Fields('diagnosticoDescripcion')?></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><p>&nbsp;</p></td>
  </tr>
</table>
<?php require("includes/pie.php"); ?>
</body>
</html>
<?php
$rsDiagnosticos->Close();

$Recordset1->Close();
?>
