<?php
//Fechas
require_once('includes/fechas.php');

//Connection statement
require_once('Connections/qualitat_ado.php');

//Aditional Functions
require_once('includes/functions.inc.php');

// begin Recordset
$colname__rsPaciente = '-1';
if (isset($_GET['paciente'])) {
  $colname__rsPaciente = $_GET['paciente'];
}
$query_rsPaciente = sprintf("SELECT * FROM paciente WHERE idPaciente = %s", $colname__rsPaciente);
$rsPaciente = $qualitat->SelectLimit($query_rsPaciente) or die($qualitat->ErrorMsg());
$totalRows_rsPaciente = $rsPaciente->RecordCount();
// end Recordset

// build the form action
$editFormAction = $_SERVER['PHP_SELF'] . (isset($_SERVER['QUERY_STRING']) ? "?" . $_SERVER['QUERY_STRING'] : "");

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE descripcion SET descripcionFecha=%s, descripcionEvolucion=%s, descripcionTratamiento=%s, descripcionEstudios=%s WHERE idDescripcion=%s",
                       GetSQLValueString($_POST['descripcionFecha'], "date"),
                       GetSQLValueString($_POST['descripcionEvolucion'], "text"),
                       GetSQLValueString($_POST['descripcionTratamiento'], "text"),
					   GetSQLValueString($_POST['descripcionEstudios'], "text"),
                       GetSQLValueString($_POST['idDescripcion'], "int"));

  $Result1 = $qualitat->Execute($updateSQL) or die($qualitat->ErrorMsg());
  $updateGoTo = "editarPaciente.php?id=" . $rsPaciente->Fields('idPaciente') . "";
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  KT_redir($updateGoTo);
}

// begin Recordset
$colname__rsHistorial = '-1';
if (isset($_GET['cons'])) {
  $colname__rsHistorial = $_GET['cons'];
}
$query_rsHistorial = sprintf("SELECT * FROM descripcion WHERE idDescripcion = %s", $colname__rsHistorial);
$rsHistorial = $qualitat->SelectLimit($query_rsHistorial) or die($qualitat->ErrorMsg());
$totalRows_rsHistorial = $rsHistorial->RecordCount();
// end Recordset

?>

<?php require_once("includes/logout.php"); ?>

<html>
  <head>
    <title>qualit&auml;t</title>
    <meta http-equiv="Content-Type" content="text/html;"/> 
    <!-- calendar stylesheet -->
    <link rel="stylesheet" type="text/css" media="all" href="calendario/calendar-system.css" title="system" />

    <!-- main calendar program -->
    <script type="text/javascript" src="calendario/calendar.js"></script>

    <!-- language for the calendar -->
    <script type="text/javascript" src="calendario/lang/calendar-es.js"></script>

    <!-- the following script defines the Calendar.setup helper function, which makes
        adding a calendar a matter of 1 or 2 lines of code. -->
    <script type="text/javascript" src="calendario/calendar-setup.js"></script>

    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <script src="js/bootstrap.min.js"></script>
  </head>
<body>
<?php require("includes/head.php"); ?>
<table width="754"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="25%" valign="top"><?php include("includes/menu1.php"); ?></td>
    <td width="75%"><table width="100%"  border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td align="right" class="h2">Actualizar Consulta </td>
        </tr>
      <tr>
        <td><form method="POST" name="form1" action="<?php echo $editFormAction; ?>">
          <table width="100%" align="center">
            <tr valign="baseline">
              <td align="right" nowrap class="titlebar">Identificador de Consulta:</td>
              <td><?php echo $rsHistorial->Fields('idDescripcion'); ?></td>
            </tr>
            <tr valign="baseline">
              <td align="right" nowrap class="titlebar">Paciente:</td>
              <td><?php echo $rsHistorial->Fields('idPaciente'); ?> :<strong> <?php echo $rsPaciente->Fields('pacienteNombre'); ?> <?php echo $rsPaciente->Fields('pacienteApellido'); ?></strong> </td>
            </tr>
            <tr valign="baseline">
              <td align="right" nowrap class="titlebar">Fecha:</td>
              <td><input type="text" id="date_a" name="descripcionFecha" value="<?php echo $rsHistorial->Fields('descripcionFecha'); ?>" size="10">
                  <button type="reset" id="trigger_a">...</button>
                  <script type="text/javascript">
    Calendar.setup({
        inputField     :    "date_a",      // id of the input field
        ifFormat       :    "%Y-%m-%d",       // format of the input field
        showsTime      :    false,            // will display a time selector
        button         :    "trigger_a",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
		//align          :    "Tl",           // alignment (defaults to "Bl")
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
    });
          </script></td>
            </tr>
            <tr valign="baseline">
              <td align="right" valign="top" nowrap class="titlebar">Evolución:</td>
              <td>
                <textarea name="descripcionEvolucion" cols="50" rows="5">
<?php echo $rsHistorial->Fields('descripcionEvolucion'); ?></textarea>              </td>
            </tr>
            <tr valign="baseline">
              <td align="right" valign="top" nowrap class="titlebar">Tratamiento:</td>
              <td>
                <textarea name="descripcionTratamiento" cols="50" rows="5">
<?php echo $rsHistorial->Fields('descripcionTratamiento'); ?></textarea>              </td>
            </tr>
            <tr valign="baseline">
              <td align="right" valign="top" nowrap class="titlebar">Estudios:</td>
              <td><textarea name="descripcionEstudios" cols="50" rows="5" id="descripcionEstudios"><?php echo $rsHistorial->Fields('descripcionEstudios'); ?></textarea></td>
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
              <td><input class="btn btn-dark" name="submit" type="submit" value="Actualizar Consulta"></td>
            </tr>
          </table>
          <input type="hidden" name="MM_update" value="form1">
          <input type="hidden" name="idDescripcion" value="<?php echo $rsHistorial->Fields('idDescripcion'); ?>">
        </form></td>
        </tr>
    </table>      
    </td>
  </tr>
</table>
<?php require("includes/pie.php"); ?>
</body>
</html>
<?php
$rsPaciente->Close();

$rsHistorial->Close();

?>
