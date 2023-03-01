<?php

require_once('../Connections/qualitat_ado.php');

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsUsuario = 10;
$pageNum_rsUsuario = 0;
if (isset($_GET['pageNum_rsUsuario'])) {
  $pageNum_rsUsuario = $_GET['pageNum_rsUsuario'];
}
$startRow_rsUsuario = $pageNum_rsUsuario * $maxRows_rsUsuario;

$query_rsUsuario = "SELECT * FROM usuario ORDER BY idUsuario ASC";
$query_limit_rsUsuario = sprintf("%s LIMIT %d, %d", $query_rsUsuario, $startRow_rsUsuario, $maxRows_rsUsuario);
$rsUsuario = $qualitat->Execute($query_limit_rsUsuario) or die($qualitat->ErrorMsg());
$row_rsUsuario = mysqli_fetch_assoc($rsUsuario);

if (isset($_GET['totalRows_rsUsuario'])) {
  $totalRows_rsUsuario = $_GET['totalRows_rsUsuario'];
} else {
  $all_rsUsuario = $qualitat->Execute($query_rsUsuario);//mysql_query($query_rsUsuario);
  $totalRows_rsUsuario = $all_rsUsuario->recordCount();//mysql_num_rows($all_rsUsuario);
}
$totalPages_rsUsuario = ceil($totalRows_rsUsuario/$maxRows_rsUsuario)-1;

$queryString_rsUsuario = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsUsuario") == false &&
        stristr($param, "totalRows_rsUsuario") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsUsuario = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsUsuario = sprintf("&totalRows_rsUsuario=%d%s", $totalRows_rsUsuario, $queryString_rsUsuario);
?>
<html>
<head>
<title>Listar Usuarios</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <link href="../css/custom/main.css" rel="stylesheet"/>
    <link href="../css/bootstrap.min.css" rel="stylesheet"/>
    <script src="../js/bootstrap.min.js"></script>
</head>

<body>
<?php require_once('menu.php'); ?>
<table width="75%" border="0" align="center" cellpadding="3" cellspacing="2">
  <tr bgcolor="#CCCCCC">
    <td>idUsuario</td>
    <td>Nombre</td>
    <td>Apellido</td>
    <td>Usuario</td>
  </tr>
  <?php do { ?>
  <tr bgcolor="#EFEFEF">
    <td> <?php echo $row_rsUsuario['idUsuario']; ?>&nbsp; </td>
    <td> <?php echo $row_rsUsuario['usuarioNombre']; ?>&nbsp; </td>
    <td> <?php echo $row_rsUsuario['usuarioApellido']; ?>&nbsp; </td>
    <td> <a href="actualizarUsuario.php?recordID=<?php echo $row_rsUsuario['idUsuario']; ?>"> <?php echo $row_rsUsuario['usuarioUser']; ?>&nbsp; </a> </td>
  </tr>
  <?php } while ($row_rsUsuario = mysqli_fetch_assoc($rsUsuario)); ?>
</table>
<br>
<table border="0" width="50%" align="center">
  <tr>
    <td width="23%" align="center">
      <?php if ($pageNum_rsUsuario > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_rsUsuario=%d%s", $currentPage, 0, $queryString_rsUsuario); ?>">First</a>
      <?php } // Show if not first page ?>
    </td>
    <td width="31%" align="center">
      <?php if ($pageNum_rsUsuario > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_rsUsuario=%d%s", $currentPage, max(0, $pageNum_rsUsuario - 1), $queryString_rsUsuario); ?>">Previous</a>
      <?php } // Show if not first page ?>
    </td>
    <td width="23%" align="center">
      <?php if ($pageNum_rsUsuario < $totalPages_rsUsuario) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_rsUsuario=%d%s", $currentPage, min($totalPages_rsUsuario, $pageNum_rsUsuario + 1), $queryString_rsUsuario); ?>">Next</a>
      <?php } // Show if not last page ?>
    </td>
    <td width="23%" align="center">
      <?php if ($pageNum_rsUsuario < $totalPages_rsUsuario) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_rsUsuario=%d%s", $currentPage, $totalPages_rsUsuario, $queryString_rsUsuario); ?>">Last</a>
      <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
Records <?php echo ($startRow_rsUsuario + 1) ?> to <?php echo min($startRow_rsUsuario + $maxRows_rsUsuario, $totalRows_rsUsuario) ?> of <?php echo $totalRows_rsUsuario ?>
</body>
</html>
<?php
$rsUsuario->Close();
?>

