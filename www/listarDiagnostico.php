<?php
//Connection statement
require_once('Connections/qualitat_ado.php');

//Aditional Functions
require_once('includes/functions.inc.php');

// begin Recordset
$maxRows_rsDiagnosticos = 20;
$pageNum_rsDiagnosticos = 0;
if (isset($_GET['pageNum_rsDiagnosticos'])) {
  $pageNum_rsDiagnosticos = $_GET['pageNum_rsDiagnosticos'];
}
$startRow_rsDiagnosticos = $pageNum_rsDiagnosticos * $maxRows_rsDiagnosticos;
$query_rsDiagnosticos = "SELECT * FROM diagnostico ORDER BY diagnosticoCategoria ASC";
$rsDiagnosticos = $qualitat->SelectLimit($query_rsDiagnosticos, $maxRows_rsDiagnosticos, $startRow_rsDiagnosticos) or die($qualitat->ErrorMsg());
if (isset($_GET['totalRows_rsDiagnosticos'])) {
  $totalRows_rsDiagnosticos = $_GET['totalRows_rsDiagnosticos'];
} else {
  $all_rsDiagnosticos = $qualitat->SelectLimit($query_rsDiagnosticos) or die($qualitat->ErrorMsg());
  $totalRows_rsDiagnosticos = $all_rsDiagnosticos->RecordCount();
}
$totalPages_rsDiagnosticos = (int)(($totalRows_rsDiagnosticos-1)/$maxRows_rsDiagnosticos);
// end Recordset

// rebuild the query string by replacing pageNum and totalRows with the new values
$queryString_rsDiagnosticos = KT_removeParam("&" . @$_SERVER['QUERY_STRING'], "pageNum_rsDiagnosticos");
$queryString_rsDiagnosticos = KT_replaceParam($queryString_rsDiagnosticos, "totalRows_rsDiagnosticos", $totalRows_rsDiagnosticos);

//keep all parameters except recordID
KT_keepParams('recordID');

//PHP ADODB document - made with PHAkt 2.7.2
?>

<?php require_once("includes/logout.php"); ?>
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
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <script src="js/bootstrap.min.js"></script>

  </head>
<body bgcolor="#ffffff">
<?php require("includes/head.php"); ?>
<table width="754"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="25%" valign="top"><?php include("includes/menu2.php"); ?></td>
    <td width="75%">&nbsp;
      <table width="100%" border="1" align="center" cellpadding="3" cellspacing="0" bordercolor="#C1C19B">
        <tr class="promo">
          <th width="32%" class="navLink">ID</th>
          <th width="68%" class="navLink">Descripci&oacute;n</th>
        </tr>
        <?php
    while (!$rsDiagnosticos->EOF) {
  ?>
        <tr>
          <td><?php echo $rsDiagnosticos->Fields('idDiagnostico')?> </td>
          <td><a href="actualizarDiagnostico.php?<?php echo $MM_keepURL . (($MM_keepURL!="")?"&":"") . "recordID=" . urlencode($rsDiagnosticos->Fields('idDiagnostico')) ?>"><?php echo $rsDiagnosticos->Fields('diagnosticoDescripcion')?> </a></td>
        </tr>
        <?php
    $rsDiagnosticos->MoveNext();
  }
?>
      </table>
      <br>
      <table border="0" width="50%" align="center">
        <tr>
          <td width="23%" align="center">
            <?php if ($pageNum_rsDiagnosticos > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_rsDiagnosticos=%d%s", $_SERVER["PHP_SELF"], 0, $queryString_rsDiagnosticos); ?>">|&lt;&lt;</a>
            <?php } // Show if not first page ?>
          </td>
          <td width="31%" align="center">
            <?php if ($pageNum_rsDiagnosticos > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_rsDiagnosticos=%d%s", $_SERVER["PHP_SELF"], max(0, $pageNum_rsDiagnosticos - 1), $queryString_rsDiagnosticos); ?>">&lt;&lt;</a>
            <?php } // Show if not first page ?>
          </td>
          <td width="23%" align="center">
            <?php if ($pageNum_rsDiagnosticos < $totalPages_rsDiagnosticos) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_rsDiagnosticos=%d%s", $_SERVER["PHP_SELF"], min($totalPages_rsDiagnosticos, $pageNum_rsDiagnosticos + 1), $queryString_rsDiagnosticos); ?>">&gt;&gt;</a>
            <?php } // Show if not last page ?>
          </td>
          <td width="23%" align="center">
            <?php if ($pageNum_rsDiagnosticos < $totalPages_rsDiagnosticos) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_rsDiagnosticos=%d%s", $_SERVER["PHP_SELF"], $totalPages_rsDiagnosticos, $queryString_rsDiagnosticos); ?>">&gt;&gt;|</a>
            <?php } // Show if not last page ?>
          </td>
        </tr>
      </table>
      Registros <?php echo (min($startRow_rsDiagnosticos + 1, $totalRows_rsDiagnosticos)) ?> al <?php echo min($startRow_rsDiagnosticos + $maxRows_rsDiagnosticos, $totalRows_rsDiagnosticos) ?> de <?php echo $totalRows_rsDiagnosticos ?> </td>
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
?>
