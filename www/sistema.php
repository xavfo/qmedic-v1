<?php
// *** Start the session
@session_start();

require_once('Connections/qualitat_ado.php');

require_once("includes/logout.php");

$currentPage = $_SERVER["PHP_SELF"];

function mres($value)
{
    $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
    $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");

    return str_replace($search, $replace, $value);
}

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  /*
  $unsafe_variable = $_POST["user-input"];

    $stmt = $mysqli->prepare("INSERT INTO table (column) VALUES (?)");

    // TODO check that $stmt creation succeeded

    // "s" means the database expects a string
    $stmt->bind_param("s", $unsafe_variable);

    $stmt->execute();
  */
  $theValue = mres($theValue);

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
}

//SELECT @@character_set_database, @@collation_database;
//latin1, latin1_swedish_ci

//mysql_select_db($database_hc, $hc);
$query_rsPacientes = "SELECT idPaciente, pacienteFecha, pacienteNombre, pacienteApellido, pacienteNacimiento, idEdad, pacienteEstadoCivil, idInstruccion, pacienteOcupacion, idResidencia, pacienteResidencia, idCiudad, idClaseSocial, pacienteTelefono, pacienteEmail, pacienteObservacion, pacienteAPP, pacienteAPF, pacienteEnfermedadAct, pacienteMC, pacienteDiagnostico, idGenero, idUsuario FROM paciente ORDER BY pacienteApellido ASC";
$rsPacientes = $qualitat->Execute($query_rsPacientes) or DIE($qualitat->ErrorMsg());
//mysql_query($query_rsPacientes, $hc) or die(mysql_error());
$row_rsPacientes = $rsPacientes->FetchRow();
//$row_rsPacientes = mysql_fetch_assoc($rsPacientes);
//$totalRows_rsPacientes = mysql_num_rows($rsPacientes);

$maxRows_rsBuscar = 100;
$pageNum_rsBuscar = 0;
if (isset($_GET['pageNum_rsBuscar'])) {
  $pageNum_rsBuscar = $_GET['pageNum_rsBuscar'];
}
$startRow_rsBuscar = $pageNum_rsBuscar * $maxRows_rsBuscar;

$colname_rsBuscar = "";
if (isset($_POST['nombre'])) {
  $colname_rsBuscar = $_POST['nombre'];
}
//mysql_select_db($database_hc, $hc);
$query_rsBuscar = sprintf("SELECT * FROM paciente WHERE pacienteNombre LIKE %s OR pacienteApellido LIKE %s ORDER BY pacienteApellido ASC", GetSQLValueString("%" . $colname_rsBuscar . "%", "text"),GetSQLValueString("%" . $colname_rsBuscar . "%", "text"));
$query_limit_rsBuscar = sprintf("%s LIMIT %d, %d", $query_rsBuscar, $startRow_rsBuscar, $maxRows_rsBuscar);
$rsBuscar = $qualitat->Execute($query_limit_rsBuscar) or DIE($qualitat->ErrorMsg());
//mysql_query($query_limit_rsBuscar, $hc) or die(mysql_error());
//$row_rsBuscar = mysql_fetch_assoc($rsBuscar);
$row_rsBuscar = $rsBuscar->FetchRow();

if (isset($_GET['totalRows_rsBuscar'])) {
  $totalRows_rsBuscar = $_GET['totalRows_rsBuscar'];
} else {
  $all_rsBuscar = $qualitat->Execute($query_rsBuscar);
  //mysql_query($query_rsBuscar);
  $totalRows_rsBuscar = $all_rsBuscar->recordCount();
  //mysql_num_rows($all_rsBuscar);
}
$totalPages_rsBuscar = ceil($totalRows_rsBuscar/$maxRows_rsBuscar)-1;

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
    <meta http-equiv="Content-Type" content="text/html; charset=latin1">

    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <script src="js/bootstrap.min.js"></script>
  </head>
<body>
<?php require("includes/head.php"); ?>
<table cellspacing="0" cellpadding="0">
  <div class="container">
    <!-- Content here -->
    <div class="row">
      <div class="col-4">
        <div class="font-weight-bold">Pacientes : <?php echo $totalRows_rsBuscar ?></div>
      </div>
      <div class="col-8">
        <?php
          // BUSCAR
          if (isset($_GET['action']) && $_GET['action'] == "buscar") { // action buscar
                      ?>
          <div class="alert alert-secondary" role="alert">
          <form name="form1" method="post" action="">
            <table width="75%"  border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td colspan="3" class="h2">Buscar Paciente</td>
              </tr>
              <tr>
                <td width="31%" align="right">Nombre</td>
                <td width="1%">:</td>
                <td width="68%"><input name="nombre" type="text" class="campo" id="nombre"></td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td>&nbsp;</td>
                <td><input name="Submit" type="submit" class="btn btn-dark" value="Buscar"></td>
              </tr>
            </table>
          </form>

          </div>
        <?php } // action buscar ?>



      <?php //Error?>
      <?php if ($totalRows_rsBuscar == 0) { // Show if recordset empty ?>
        <div class="alert alert-warning" role="alert">
          <p>
            No se encontraron coincidencias para :<?php echo $_POST['nombre'] ?>
          </p>
        </div>
      <?php } // Show if recordset empty ?>


      <table border="0" width="50%" align="center">
        <tr>
          <td width="23%" align="center">
            <?php if ($pageNum_rsBuscar > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_rsBuscar=%d%s", $currentPage, 0, $queryString_rsBuscar); ?>"><img src="First.gif" border=0></a>
            <?php } // Show if not first page ?>
          </td>
          <td width="31%" align="center">
            <?php if ($pageNum_rsBuscar > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_rsBuscar=%d%s", $currentPage, max(0, $pageNum_rsBuscar - 1), $queryString_rsBuscar); ?>"><img src="Previous.gif" border=0></a>
            <?php } // Show if not first page ?>
          </td>
          <td width="23%" align="center">
            <?php if ($pageNum_rsBuscar < $totalPages_rsBuscar) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_rsBuscar=%d%s", $currentPage, min($totalPages_rsBuscar, $pageNum_rsBuscar + 1), $queryString_rsBuscar); ?>"><img src="Next.gif" border=0></a>
            <?php } // Show if not last page ?>
          </td>
          <td width="23%" align="center">
            <?php if ($pageNum_rsBuscar < $totalPages_rsBuscar) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_rsBuscar=%d%s", $currentPage, $totalPages_rsBuscar, $queryString_rsBuscar); ?>"><img src="Last.gif" border=0></a>
            <?php } // Show if not last page ?>
          </td>
        </tr>
      </table>
        <?php if ($totalRows_rsBuscar > 0) { // Show if recordset not empty ?>
          <div class="alert alert-primary" role="alert">
             Buscando : <?php echo isset($_POST['nombre']) ?>
          </div>

        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr class="table table-dark">
          <td width="20%" class="sidebarHeader"><div align="center">Historia</div></td>
          <td width="57%" class="sidebarHeader"><div align="center">Nombres</div></td>
          <td width="23%" class="sidebarHeader"><div align="center">Fecha</div></td>
        </tr>
        <?php do { ?>
        <tr>
          <td align="center"><?php echo $row_rsBuscar['idPaciente']; ?></td>
          <td><a href="editarPaciente.php?id=<?php echo $row_rsBuscar['idPaciente']; ?>"><?php echo $row_rsBuscar['pacienteNombre']; ?> / <?php echo $row_rsBuscar['pacienteApellido']; ?></a></td>
          <td><?php echo $row_rsBuscar['pacienteFecha']; ?><br>
          <?php echo $row_rsBuscar['pacienteActualizado']; ?></td>
        </tr>
        <?php } while ($row_rsBuscar = $rsBuscar->FetchRow()); ?>
      </table>
      <?php } // Show if recordset not empty ?>
      <table border="0" width="50%">
        <tr>
          <nav aria-label="Pacientes">
            <ul class="pagination">
              <td width="23%" align="center">
                <?php if ($pageNum_rsBuscar > 0) { // Show if not first page ?>
                <a class="page-item" href="<?php printf("%s?pageNum_rsBuscar=%d%s", $currentPage, 0, $queryString_rsBuscar); ?>"><img src="First.gif" border=0></a>
                <?php } // Show if not first page ?>
              </td>
              <td width="31%" align="center">
                <?php if ($pageNum_rsBuscar > 0) { // Show if not first page ?>
                <a class="page-item" href="<?php printf("%s?pageNum_rsBuscar=%d%s", $currentPage, max(0, $pageNum_rsBuscar - 1), $queryString_rsBuscar); ?>"><img src="Previous.gif" border=0></a>
                <?php } // Show if not first page ?>
              </td>
              <td width="23%" align="center">
                <?php if ($pageNum_rsBuscar < $totalPages_rsBuscar) { // Show if not last page ?>
                <a class="page-item" href="<?php printf("%s?pageNum_rsBuscar=%d%s", $currentPage, min($totalPages_rsBuscar, $pageNum_rsBuscar + 1), $queryString_rsBuscar); ?>"><img src="Next.gif" border=0></a>
                <?php } // Show if not last page ?>
              </td>
              <td width="23%" align="center">
                <?php if ($pageNum_rsBuscar < $totalPages_rsBuscar) { // Show if not last page ?>
                <a class="page-item" href="<?php printf("%s?pageNum_rsBuscar=%d%s", $currentPage, $totalPages_rsBuscar, $queryString_rsBuscar); ?>"><img src="Last.gif" border=0></a>
                <?php } // Show if not last page ?>
              </td>
            </ul>
          </nav>
        </tr>
      </table>
      <nav aria-label="Pacientes">
        <ul class="pagination">
          <li class="page-item"><a class="page-link" href="#">Anterior</a></li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
        </ul>
      </nav>
      <?php echo ($startRow_rsBuscar + 1) ?> hasta <?php echo min($startRow_rsBuscar + $maxRows_rsBuscar, $totalRows_rsBuscar) ?> de <?php echo $totalRows_rsBuscar ?>

    </td>

      </div>
    </div>
  </div>


  <tr>

  </tr>
</table>
<?php require("includes/pie.php"); ?>
</body>
</html>
<?php
$rsPacientes->close();
$rsBuscar->close();
?>
