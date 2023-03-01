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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE paciente SET pacienteFecha=%s, pacienteNombre=%s, pacienteApellido=%s, pacienteNacimiento=%s, idEdad=%s, pacienteEstadoCivil=%s, idInstruccion=%s, pacienteOcupacion=%s, idResidencia=%s, pacienteResidencia=%s, idCiudad=%s, idClaseSocial=%s, pacienteTelefono=%s, pacienteEmail=%s, pacienteObservacion=%s, pacienteAPP=%s, pacienteAPF=%s, pacienteEnfermedadAct=%s, pacienteMC=%s, pacienteDiagnostico=%s, idGenero=%s, idUsuario=%s, pacienteResidenciaCiudad=%s, pacienteActualizado=%s, pacienteMTratante=%s, pacienteMEnviante=%s, pacienteSeguro=%s, pacienteNSeguro=%s WHERE idPaciente=%s",
                       GetSQLValueString($_POST['pacienteFecha'], "date"),
                       GetSQLValueString($_POST['pacienteNombre'], "text"),
                       GetSQLValueString($_POST['pacienteApellido'], "text"),
                       GetSQLValueString($_POST['pacienteNacimiento'], "text"),
                       GetSQLValueString($_POST['idEdad'], "text"),
                       GetSQLValueString($_POST['pacienteEstadoCivil'], "text"),
                       GetSQLValueString($_POST['idInstruccion'], "text"),
                       GetSQLValueString($_POST['pacienteOcupacion'], "text"),
                       GetSQLValueString($_POST['idResidencia'], "text"),
                       GetSQLValueString($_POST['pacienteResidencia'], "text"),
                       GetSQLValueString($_POST['idCiudad'], "text"),
                       GetSQLValueString($_POST['idClaseSocial'], "int"),
                       GetSQLValueString($_POST['pacienteTelefono'], "text"),
                       GetSQLValueString($_POST['pacienteEmail'], "text"),
                       GetSQLValueString($_POST['pacienteObservacion'], "text"),
                       GetSQLValueString($_POST['pacienteAPP'], "text"),
                       GetSQLValueString($_POST['pacienteAPF'], "text"),
                       GetSQLValueString($_POST['pacienteEnfermedadAct'], "text"),
                       GetSQLValueString($_POST['pacienteMC'], "text"),
                       GetSQLValueString($_POST['pacienteDiagnostico'], "text"),
                       GetSQLValueString($_POST['idGenero'], "text"),
                       GetSQLValueString($_POST['idUsuario'], "int"),
                       GetSQLValueString($_POST['pacienteResidenciaCiudad'], "text"),
                       GetSQLValueString($_POST['pacienteActualizado'], "text"),
                       GetSQLValueString($_POST['idDiagnostico'], "text"),
                       GetSQLValueString($_POST['pacienteMEnviante'], "text"),
                       GetSQLValueString($_POST['pacienteSeguro'], "text"),
                       GetSQLValueString($_POST['pacienteNSeguro'], "text"),
                       GetSQLValueString($_POST['idPaciente'], "int"));

  $Result1 = $qualitat->Execute($updateSQL) or die($qualitat->ErrorMsg());
  $updateGoTo = "editarPaciente.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  KT_redir($updateGoTo);
}

// begin Recordset
$colname__rsEditarPaciente = '-1';
if (isset($_GET['id'])) {
  $colname__rsEditarPaciente = $_GET['id'];
}
$query_rsEditarPaciente = sprintf("SELECT * FROM paciente WHERE idPaciente = %s", $colname__rsEditarPaciente);
$rsEditarPaciente = $qualitat->SelectLimit($query_rsEditarPaciente) or die($qualitat->ErrorMsg());
$totalRows_rsEditarPaciente = $rsEditarPaciente->RecordCount();
// end Recordset

// begin Recordset
$query_rsClase = "SELECT * FROM clasesocial ORDER BY idClaseSocial ASC";
$rsClase = $qualitat->SelectLimit($query_rsClase) or die($qualitat->ErrorMsg());
$totalRows_rsClase = $rsClase->RecordCount();
// end Recordset

// begin Recordset
$query_rsInstruccion = "SELECT * FROM instruccion ORDER BY idInstruccion ASC";
$rsInstruccion = $qualitat->SelectLimit($query_rsInstruccion) or die($qualitat->ErrorMsg());
$totalRows_rsInstruccion = $rsInstruccion->RecordCount();
// end Recordset

// begin Recordset
$query_rsEdad = "SELECT * FROM grupoedad";
$rsEdad = $qualitat->SelectLimit($query_rsEdad) or die($qualitat->ErrorMsg());
$totalRows_rsEdad = $rsEdad->RecordCount();
// end Recordset

// begin Recordset
$query_rsEstadoCivil = "SELECT * FROM estadocivil ORDER BY idEstadoCivil ASC";
$rsEstadoCivil = $qualitat->SelectLimit($query_rsEstadoCivil) or die($qualitat->ErrorMsg());
$totalRows_rsEstadoCivil = $rsEstadoCivil->RecordCount();
// end Recordset

// begin Recordset
$query_rsResidencia = "SELECT * FROM residencia ORDER BY idResidencia ASC";
$rsResidencia = $qualitat->SelectLimit($query_rsResidencia) or die($qualitat->ErrorMsg());
$totalRows_rsResidencia = $rsResidencia->RecordCount();
// end Recordset

// begin Recordset
$query_rsGenero = "SELECT * FROM genero ORDER BY idGenero ASC";
$rsGenero = $qualitat->SelectLimit($query_rsGenero) or die($qualitat->ErrorMsg());
$totalRows_rsGenero = $rsGenero->RecordCount();
// end Recordset

// begin Recordset
$query_rsDiagnostico = "SELECT * FROM diagnostico ORDER BY idDiagnostico ASC";
$rsDiagnostico = $qualitat->SelectLimit($query_rsDiagnostico) or die($qualitat->ErrorMsg());
$totalRows_rsDiagnostico = $rsDiagnostico->RecordCount();
// end Recordset


//PHP ADODB document - made with PHAkt 2.7.2

?>
<html>
<head>
<title>qualit&auml;t</title>
<meta http-equiv="Content-Type" content="text/html;">

  <!-- calendar stylesheet -->
    <link rel="stylesheet" type="text/css" media="all" href="calendario/calendar-system.css" title="system" />

  <!-- main calendar program -->
  <script type="text/javascript" src="calendario/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="calendario/lang/calendar-es.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="calendario/calendar-setup.js"></script>

<script type="text/javascript">
function escribirDiagnostico(){
    //var texto
  //alert(texto)
    //texto = "El numero de opciones del select: " + document.forml.idDiagnostico.length
    //var indice = document.form1.idDiagnostico.selectedIndex
    //texto += "\nIndice de la opcion escogida: " + indice
    //var valor = document.forml.idDiagnostico.options[indice].value
    //texto += "\nValor de la opcion escogida: " + valor
    //var textoEscogido = document.form1.idDiagnostico.options[indice].text
    //texto += "\nTexto de la opcion escogida: " + textoEscogido
  document.form1.pacienteDiagnostico.value += " " + document.form1.idDiagnostico.value
    //alert(texto)
}
</script>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <script src="js/bootstrap.min.js"></script>

</meta>
<body>
<?php require("includes/head.php"); ?>
<table width="800"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
      <form action="<?php echo $editFormAction; ?>" method="POST" name="form1">
        <table width="100%" align="center">
          <tr valign="baseline">
            <td colspan="2" align="right" nowrap class="h2">Actualizar Datos del Paciente </td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">Identificador de Paciente:</td>
            <td><?php echo $rsEditarPaciente->Fields('idPaciente'); ?></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">Fecha de Ingreso:</td>
            <td>

<input type="text" name="pacienteFecha" value="<?php echo $rsEditarPaciente->Fields('pacienteFecha'); ?>" size="10"  id="f_date_b">
<button type="reset" class="btn btn-dark" id="f_trigger_b">...</button>
<script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_b",      // id of the input field
        ifFormat       :    "%Y-%m-%d",       // format of the input field
        showsTime      :    false,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
    //align          :    "Tl",           // alignment (defaults to "Bl")
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
    });
</script>
</td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">Nombres:</td>
            <td><input type="text" name="pacienteNombre" value="<?php echo $rsEditarPaciente->Fields('pacienteNombre'); ?>" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">Apellidos:</td>
            <td><input type="text" name="pacienteApellido" value="<?php echo $rsEditarPaciente->Fields('pacienteApellido'); ?>" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">Fecha de Nacimiento:</td>
            <td><input type="text" name="pacienteNacimiento" value="<?php echo $rsEditarPaciente->Fields('pacienteNacimiento'); ?>" size="10" id="f_date_c">
            <button type="reset" class="btn btn-dark" id="f_trigger_c">...</button>
<script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c",      // id of the input field
        ifFormat       :    "%Y-%m-%d",       // format of the input field
        showsTime      :    false,            // will display a time selector
        button         :    "f_trigger_c",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
    //align          :    "Tl",           // alignment (defaults to "Bl")
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
    });
</script></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">Grupo de Edad:</td>
            <td> <select name="idEdad">
              <?php
  while(!$rsEdad->EOF){
?>
              <option value="<?php echo $rsEdad->Fields('idEdad')?>"<?php if (!(strcmp($rsEdad->Fields('idEdad'), $rsEditarPaciente->Fields('idEdad')))) {echo "SELECTED";} ?>><?php echo $rsEdad->Fields('edad')?></option>
              <?php
    $rsEdad->MoveNext();
  }
  $rsEdad->MoveFirst();
?>
              </select>
            - <?php echo $rsEditarPaciente->Fields('pacienteEdad'); ?> </td>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">Estado Civil:</td>
            <td><select name="pacienteEstadoCivil" id="pacienteEstadoCivil">
              <?php
  while(!$rsEstadoCivil->EOF){
?>
              <option value="<?php echo $rsEstadoCivil->Fields('idEstadoCivil')?>"<?php if (!(strcmp($rsEstadoCivil->Fields('idEstadoCivil'), $rsEditarPaciente->Fields('pacienteEstadoCivil')))) {echo "SELECTED";} ?>><?php echo $rsEstadoCivil->Fields('estadoCivil')?></option>
              <?php
    $rsEstadoCivil->MoveNext();
  }
  $rsEstadoCivil->MoveFirst();
?>
            </select></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">Instrucci�n:</td>
            <td> <select name="idInstruccion">
              <?php
  while(!$rsInstruccion->EOF){
?>
              <option value="<?php echo $rsInstruccion->Fields('idInstruccion')?>"<?php if (!(strcmp($rsInstruccion->Fields('idInstruccion'), $rsEditarPaciente->Fields('idInstruccion')))) {echo "SELECTED";} ?>><?php echo $rsInstruccion->Fields('instruccDescripcion')?></option>
              <?php
    $rsInstruccion->MoveNext();
  }
  $rsInstruccion->MoveFirst();
?>
              </select> </td>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">Ocupacion:</td>
            <td><input type="text" name="pacienteOcupacion" value="<?php echo $rsEditarPaciente->Fields('pacienteOcupacion'); ?>" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">Tipo de Residencia:</td>
            <td> <select name="idResidencia">
              <?php
  while(!$rsResidencia->EOF){
?>
              <option value="<?php echo $rsResidencia->Fields('idResidencia')?>"<?php if (!(strcmp($rsResidencia->Fields('idResidencia'), $rsEditarPaciente->Fields('idResidencia')))) {echo "SELECTED";} ?>><?php echo $rsResidencia->Fields('residenciaDescripcion')?></option>
              <?php
    $rsResidencia->MoveNext();
  }
  $rsResidencia->MoveFirst();
?>
              </select> </td>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">Ciudad / Residencia:</td>
            <td><input name="pacienteResidenciaCiudad" type="text" id="pacienteResidenciaCiudad" value="<?php echo $rsEditarPaciente->Fields('pacienteResidenciaCiudad'); ?>" size="11">
              <br>
              <textarea name="pacienteResidencia" cols="60" rows="6"><?php echo $rsEditarPaciente->Fields('pacienteResidencia'); ?></textarea></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">Ciudad de Nacimiento:</td>
            <td><input type="text" name="idCiudad" value="<?php echo $rsEditarPaciente->Fields('idCiudad'); ?>" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">Clase Social:</td>
            <td> <select name="idClaseSocial">
              <?php
  while(!$rsClase->EOF){
?>
              <option value="<?php echo $rsClase->Fields('idClaseSocial')?>"<?php if (!(strcmp($rsClase->Fields('idClaseSocial'), $rsEditarPaciente->Fields('idClaseSocial')))) {echo "SELECTED";} ?>><?php echo $rsClase->Fields('claseSocial')?></option>
              <?php
    $rsClase->MoveNext();
  }
  $rsClase->MoveFirst();
?>
              </select> </td>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">G�nero:</td>
            <td> <select name="idGenero">
              <?php
  while(!$rsGenero->EOF){
?>
              <option value="<?php echo $rsGenero->Fields('idGenero')?>"<?php if (!(strcmp($rsGenero->Fields('idGenero'), $rsEditarPaciente->Fields('idGenero')))) {echo "SELECTED";} ?>><?php echo $rsGenero->Fields('generoDescripcion')?></option>
              <?php
    $rsGenero->MoveNext();
  }
  $rsGenero->MoveFirst();
?>
              </select> </td>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">Tel�fono:</td>
            <td><input type="text" name="pacienteTelefono" value="<?php echo $rsEditarPaciente->Fields('pacienteTelefono'); ?>" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">Email:</td>
            <td><input type="text" name="pacienteEmail" value="<?php echo $rsEditarPaciente->Fields('pacienteEmail'); ?>" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td align="right" valign="top" nowrap class="titlebar">Observaci�n:</td>
            <td> <textarea name="pacienteObservacion" cols="60" rows="6"><?php echo $rsEditarPaciente->Fields('pacienteObservacion'); ?></textarea> </td>
          </tr>
          <tr valign="baseline">
            <td align="right" valign="top" nowrap class="titlebar">MC:</td>
            <td><textarea name="pacienteMC" cols="60" rows="6"><?php echo $rsEditarPaciente->Fields('pacienteMC'); ?></textarea></td>
          </tr>
          <tr valign="baseline">
            <td align="right" valign="top" nowrap class="titlebar">Enfermedad Actual:</td>
            <td>
              <textarea name="pacienteEnfermedadAct" cols="60" rows="6"><?php echo $rsEditarPaciente->Fields('pacienteEnfermedadAct'); ?></textarea>
            </td>
          </tr>
          <tr valign="baseline">
            <td align="right" valign="top" nowrap class="titlebar">APP:</td>
            <td> <textarea name="pacienteAPP" cols="60" rows="6"><?php echo $rsEditarPaciente->Fields('pacienteAPP'); ?></textarea> </td>
          </tr>
          <tr valign="baseline">
            <td align="right" valign="top" nowrap class="titlebar">APF:</td>
            <td> <textarea name="pacienteAPF" cols="60" rows="6"><?php echo $rsEditarPaciente->Fields('pacienteAPF'); ?></textarea> </td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">Diagn�stico:</td>
            <td><p>
              <input type="text" name="pacienteDiagnostico" id="pacienteDiagnostico" value="<?php echo $rsEditarPaciente->Fields('pacienteDiagnostico'); ?>" size="32">
</p>
              <p>Referencia :<br>
                <select name="idDiagnostico" class="titlebar" id="idDiagnostico" onChange="escribirDiagnostico()">
                  <?php
  while(!$rsDiagnostico->EOF){
?>
                  <option value="<?php echo $rsDiagnostico->Fields('idDiagnostico')?>"<?php if (!(strcmp($rsDiagnostico->Fields('idDiagnostico'), $rsEditarPaciente->Fields('pacienteDiagnostico')))) {echo "SELECTED";} ?>><?php echo $rsDiagnostico->Fields('idDiagnostico')?> - <?php echo $rsDiagnostico->Fields('diagnosticoDescripcion')?></option>
                  <?php
    $rsDiagnostico->MoveNext();
  }
  $rsDiagnostico->MoveFirst();
?>
                </select>
            </p>            </td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">M&eacute;dico Tratante:</td>
            <td>
            <input name="pacienteMTratante" type="text" id="pacienteMTratante" value="<?php echo $rsEditarPaciente->Fields('pacienteMTratante'); ?>"></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">M&eacute;dico Enviante:</td>
            <td>
            <input name="pacienteMEnviante" type="text" id="pacienteMEnviante" value="<?php echo $rsEditarPaciente->Fields('pacienteMEnviante'); ?>"></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">Seguro:</td>
            <td><input name="pacienteSeguro" type="text" id="pacienteSeguro" value="<?php echo $rsEditarPaciente->Fields('pacienteSeguro'); ?>">              </td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">N&uacute;mero de Seguro:</td>
            <td><input name="pacienteNSeguro" type="text" id="pacienteNSeguro" value="<?php echo $rsEditarPaciente->Fields('pacienteNSeguro'); ?>">              </td>
          </tr>
          <tr valign="baseline" bgcolor="#CCCCCC">
            <td align="right" nowrap class="titlebar">Usuario Actual:</td>
            <td><?php echo $rsEditarPaciente->Fields('idUsuario'); ?>/<?php echo $_SESSION['MM_Username']."/".$ahora; ?><br>
              Actualizado: <?php echo $rsEditarPaciente->Fields('pacienteActualizado'); ?>              <input name="pacienteActualizado" type="hidden" id="pacienteActualizado" value="<?php echo $_SESSION['MM_Username']."/".$ahora; ?>"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right">              <input name="idPaciente" type="hidden" id="idPaciente" value="<?php echo $rsEditarPaciente->Fields('idPaciente'); ?>">
            <input name="idUsuario" type="hidden" id="idUsuario" value="1"></td>
            <td><input type="submit" value="Guardar" class="btn btn-dark"></td>
          </tr>
        </table>
        <input type="hidden" name="MM_update" value="form1">
      </form>
      <p>&nbsp;</p></td>
  </tr>
</table>
<?php require("includes/pie.php"); ?>
</body>
</html>
<?php
$rsEditarPaciente->Close();

$rsClase->Close();

$rsInstruccion->Close();

$rsEdad->Close();

$rsEstadoCivil->Close();

$rsResidencia->Close();

$rsGenero->Close();

$rsDiagnostico->Close();
?>
