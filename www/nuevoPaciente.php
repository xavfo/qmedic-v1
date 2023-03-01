<?php
@session_start();
//Connection statement
require_once('Connections/qualitat_ado.php');

//Aditional Functions
require_once('includes/functions.inc.php');

//Fechas
require_once('includes/fechas.php');

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  session_destroy();
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}

// begin Recordset
$query_rsDiagnostico = "SELECT * FROM diagnostico ORDER BY idDiagnostico ASC";
$rsDiagnostico = $qualitat->SelectLimit($query_rsDiagnostico) or die($qualitat->ErrorMsg());
$totalRows_rsDiagnostico = $rsDiagnostico->RecordCount();
// end Recordset

// build the form action
$editFormAction = $_SERVER['PHP_SELF'] . (isset($_SERVER['QUERY_STRING']) ? "?" . $_SERVER['QUERY_STRING'] : "");

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO paciente (pacienteFecha, pacienteNombre, pacienteApellido, pacienteNacimiento, idEdad, pacienteEstadoCivil, idInstruccion, pacienteOcupacion, idResidencia, pacienteResidencia, idCiudad, idClaseSocial, pacienteTelefono, pacienteEmail, pacienteObservacion, pacienteAPP, pacienteAPF, pacienteEnfermedadAct, pacienteMC, pacienteDiagnostico, idGenero, idUsuario, pacienteResidenciaCiudad, pacienteEdad, pacienteActualizado, pacienteMTratante, pacienteMEnviante, pacienteSeguro, pacienteNSeguro) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
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
                       GetSQLValueString($_POST['pacienteEdad'], "double"),
                       GetSQLValueString($_POST['pacienteActualizado'], "text"),
                       GetSQLValueString($_POST['pacienteMTratante'], "text"),
                       GetSQLValueString($_POST['pacienteMEnviante'], "text"),
                       GetSQLValueString($_POST['pacienteSeguro'], "text"),
                       GetSQLValueString($_POST['pacienteNSeguro'], "text"));

  $Result1 = $qualitat->Execute($insertSQL) or die($qualitat->ErrorMsg());

  $insertGoTo = "sistema.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  KT_redir($insertGoTo);
}

$query_rsEdad = "SELECT * FROM grupoedad ORDER BY idEdad ASC";
$rsEdad = $qualitat->Execute($query_rsEdad) or DIE($qualitat->ErrorMsg()); 
//mysql_query($query_rsEdad, $hc) or die(mysql_error());
$row_rsEdad = $rsEdad->FetchRow();
//mysql_fetch_assoc($rsEdad);
$totalRows_rsEdad = $rsEdad->recordCount();
//mysql_num_rows($rsEdad);


$query_rsClase = "SELECT * FROM clasesocial ORDER BY idClaseSocial ASC";
$rsClase = $qualitat->Execute($query_rsClase) or DIE($qualitat->ErrorMsg()); 
//mysql_query($query_rsClase, $hc) or die(mysql_error());
$row_rsClase = $rsClase->FetchRow();
//mysql_fetch_assoc($rsClase);
$totalRows_rsClase = $rsClase->recordCount();
//mysql_num_rows($rsClase);


$query_rsEstado = "SELECT * FROM estadocivil ORDER BY idEstadoCivil ASC";
$rsEstado = $qualitat->Execute($query_rsEstado) or DIE($qualitat->ErrorMsg()); 
//mysql_query($query_rsEstado, $hc) or die(mysql_error());
$row_rsEstado = $rsEstado->FetchRow();
//mysql_fetch_assoc($rsEstado);
$totalRows_rsEstado = $rsEstado->recordCount();
//mysql_num_rows($rsEstado);


$query_rsGenero = "SELECT * FROM genero ORDER BY idGenero ASC";
$rsGenero = $qualitat->Execute($query_rsGenero) or DIE($qualitat->ErrorMsg()); 
//mysql_query($query_rsGenero, $hc) or die(mysql_error());
$row_rsGenero = $rsGenero->FetchRow();
//mysql_fetch_assoc($rsGenero);
$totalRows_rsGenero = $rsGenero->recordCount();
//mysql_num_rows($rsGenero);


$query_rsInstruccion = "SELECT * FROM instruccion ORDER BY idInstruccion ASC";
$rsInstruccion = $qualitat->Execute($query_rsInstruccion) or DIE($qualitat->ErrorMsg());
//mysql_query($query_rsInstruccion, $hc) or die(mysql_error());
$row_rsInstruccion = $rsInstruccion->FetchRow();
//mysql_fetch_assoc($rsInstruccion);
$totalRows_rsInstruccion = $rsInstruccion->recordCount();
//mysql_num_rows($rsInstruccion);


$query_rsResidencia = "SELECT * FROM residencia ORDER BY idResidencia ASC";
$rsResidencia = $qualitat->Execute($query_rsResidencia) or DIE($qualitat->ErrorMsg());
//mysql_query($query_rsResidencia, $hc) or die(mysql_error());
$row_rsResidencia = $rsResidencia->FetchRow();
//mysql_fetch_assoc($rsResidencia);
$totalRows_rsResidencia = $rsResidencia->recordCount();
//mysql_num_rows($rsResidencia);

$currentPage = $_SERVER["PHP_SELF"];

$queryString_rsBuscar = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsBuscar") == false && 
        stristr($param, "totalRows_rsBuscar") == false) {
      array_push($newParams, $param);
    }else{
      $totalRows_rsBuscar = 0;
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
  <meta http-equiv="Content-Type" content="text/html; charset=latin1"/> 
  <!-- calendar stylesheet -->
    <link rel="stylesheet" type="text/css" media="all" href="calendario/calendar-system.css" title="system" />

  <!-- main calendar program -->
  <script type="text/javascript" src="calendario/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="calendario/lang/calendar-es.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="calendario/calendar-setup.js"></script>

<!--Fireworks MX 2004 Dreamweaver MX 2004 target.  Created Wed Mar 16 20:44:01 GMT-0500 2005-->

<script type="text/javascript">
function escribirDiagnostico(){

	document.form1.pacienteDiagnostico.value += " " + document.form1.idDiagnostico.value
    
} 
</script>

    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <script src="js/bootstrap.min.js"></script>
<body bgcolor="#ffffff"> 
<?php require("includes/head.php"); ?> 
<table width="754"  border="0" cellspacing="0" cellpadding="0"> 
  <tr> 
    <td width="25%" valign="top"><?php include("includes/menu1.php"); ?></td> 
    <td width="75%">&nbsp; 
      <form action="<?php echo $editFormAction; ?>" method="POST" name="form1"> 
        <table width="100%" align="center"> 
          <tr valign="baseline">
            <td colspan="2" align="right" nowrap class="h2">Nuevo Paciente </td>
          </tr>
          <tr valign="baseline"> 
            <td align="right" nowrap class="titlebar">IdPaciente:</td> 
            <td></td> 
          </tr> 
          <tr valign="baseline"> 
            <td align="right" nowrap class="titlebar">Fecha:</td> 
            <td>
			
<input type="text" name="pacienteFecha" value="<?php echo date("Y-m-d"); ?>" size="10"  id="f_date_b">
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
            <td align="right" nowrap class="titlebar">Nombre:</td> 
            <td><input type="text" name="pacienteNombre" value="" size="32"></td> 
          </tr> 
          <tr valign="baseline"> 
            <td align="right" nowrap class="titlebar">Apellido:</td> 
            <td><input type="text" name="pacienteApellido" value="" size="32"></td> 
          </tr> 
          <tr valign="baseline"> 
            <td align="right" nowrap class="titlebar">Nacimiento:</td> 
            <td><input type="text" name="pacienteNacimiento" value="1950-01-01" size="10" id="f_date_c">
              <input name="pacienteEdad" type="text" id="pacienteEdad" value="0" size="4">            
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
            <td align="right" nowrap class="titlebar">IdEdad:</td> 
            <td> <select name="idEdad"> 
                <?php 
do {  
?> 
                <option value="<?php echo $row_rsEdad['idEdad']?>" ><?php echo $row_rsEdad['edad']?></option> 
                <?php
} while ($row_rsEdad = $rsEdad->FetchRow());//mysql_fetch_assoc($rsEdad)
?> 
              </select> </td> 
          <tr valign="baseline"> 
            <td align="right" nowrap class="titlebar">EstadoCivil:</td> 
            <td><select name="pacienteEstadoCivil" id="pacienteEstadoCivil">
			<?php 
do {  
?> 
                <option value="<?php echo $row_rsEstado['idEstadoCivil']?>" ><?php echo $row_rsEstado['estadoCivil']?></option> 
                <?php
} while ($row_rsEstado = $rsEstado->FetchRow());//mysql_fetch_assoc($rsEstado));
?> 
            </select></td>
          </tr> 
          <tr valign="baseline"> 
            <td align="right" nowrap class="titlebar">IdInstruccion:</td> 
            <td> <select name="idInstruccion"> 
                <?php 
do {  
?> 
                <option value="<?php echo $row_rsInstruccion['idInstruccion']?>" ><?php echo $row_rsInstruccion['instruccDescripcion']?></option> 
                <?php
} while ($row_rsInstruccion = $rsInstruccion->FetchRow());//mysql_fetch_assoc($rsInstruccion));
?> 
              </select> </td> 
          <tr valign="baseline"> 
            <td align="right" nowrap class="titlebar">Ocupacion:</td> 
            <td><input type="text" name="pacienteOcupacion" value="" size="32"></td> 
          </tr> 
          <tr valign="baseline"> 
            <td align="right" nowrap class="titlebar">IdResidencia:</td> 
            <td> <select name="idResidencia"> 
                <?php 
do {  
?> 
                <option value="<?php echo $row_rsResidencia['idResidencia']?>" ><?php echo $row_rsResidencia['residenciaDescripcion']?></option> 
                <?php
} while ($row_rsResidencia = $rsResidencia->FetchRow());//mysql_fetch_assoc($rsResidencia));
?> 
              </select> </td> 
          <tr valign="baseline"> 
            <td align="right" nowrap class="titlebar">Residencia:</td> 
            <td><p>
              <input name="pacienteResidenciaCiudad" type="text" id="pacienteResidenciaCiudad" size="11">
              <br>
              <textarea class="form-control" name="pacienteResidencia" cols="60" rows="5"></textarea>
              </p>
            </td> 
          </tr> 
          <tr valign="baseline"> 
            <td align="right" nowrap class="titlebar">Ciudad Nacimiento:</td> 
            <td><input type="text" name="idCiudad" value="" size="32"></td> 
          </tr> 
          <tr valign="baseline"> 
            <td align="right" nowrap class="titlebar">Clase Social:</td> 
            <td> <select name="idClaseSocial"> 
                <?php 
do {  
?> 
                <option value="<?php echo $row_rsClase['idClaseSocial']?>" ><?php echo $row_rsClase['claseSocial']?></option> 
                <?php
} while ($row_rsClase = $rsClase->FetchRow());//mysql_fetch_assoc($rsClase));
?> 
              </select> </td> 
          <tr valign="baseline"> 
            <td align="right" nowrap class="titlebar">G&eacute;nero:</td> 
            <td> <select name="idGenero"> 
                <?php 
do {  
?> 
                <option value="<?php echo $row_rsGenero['idGenero']?>" ><?php echo $row_rsGenero['generoDescripcion']?></option> 
                <?php
} while ($row_rsGenero = $rsGenero->FetchRow());//mysql_fetch_assoc($rsGenero));
?> 
              </select> </td> 
          <tr valign="baseline"> 
            <td align="right" nowrap class="titlebar">Tel&eacute;fono:</td> 
            <td><input type="text" name="pacienteTelefono" value="" size="32"></td> 
          </tr> 
          <tr valign="baseline"> 
            <td align="right" nowrap class="titlebar">Email:</td> 
            <td><input type="text" name="pacienteEmail" value="" size="32"></td> 
          </tr> 
          <tr valign="baseline"> 
            <td align="right" valign="top" nowrap class="titlebar">Observaci&oacute;n:</td> 
            <td> <textarea class="form-control" name="pacienteObservacion" cols="60" rows="5"></textarea> </td> 
          </tr>
          <tr valign="baseline">
            <td align="right" valign="top" nowrap class="titlebar">Motivo de Consulta:</td>
            <td>
              <textarea class="form-control" name="pacienteMC" cols="60" rows="6"></textarea>
            </td>
          </tr>
          <tr valign="baseline">
            <td align="right" valign="top" nowrap class="titlebar">EnfermedadAct:</td>
            <td>
              <textarea class="form-control" name="pacienteEnfermedadAct" cols="60" rows="6"></textarea>
            </td>
          </tr>
          <tr valign="baseline">
            <td align="right" valign="top" nowrap class="titlebar">APF:</td>
            <td>
              <textarea class="form-control" name="pacienteAPF" cols="60" rows="6"></textarea>
            </td>
          </tr>
          <tr valign="baseline"> 
            <td align="right" valign="top" nowrap class="titlebar">APP:</td> 
            <td> <textarea class="form-control" name="pacienteAPP" cols="60" rows="6"></textarea> </td> 
          </tr> 
          <tr valign="baseline"> 
            <td align="right" nowrap class="titlebar">Diagnostico:</td> 
            <td><input type="text" name="pacienteDiagnostico" value="" size="32">
              <br>
              Referencia :<br>
              <select name="idDiagnostico" class="titlebar" id="idDiagnostico" onChange="escribirDiagnostico()">
                  <?php
  while(!$rsDiagnostico->EOF){
?>
                  <option value="<?php echo $rsDiagnostico->Fields('idDiagnostico')?>"><?php echo $rsDiagnostico->Fields('idDiagnostico')?> - <?php echo $rsDiagnostico->Fields('diagnosticoDescripcion')?></option>
                  <?php
    $rsDiagnostico->MoveNext();
  }
  $rsDiagnostico->MoveFirst();
?>
                </select></td> 
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">M&eacute;dico Tratante:</td>
            <td>
              <input name="pacienteMTratante" type="text" class="form-control" id="pacienteMTratante"></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">M&eacute;dico Enviante:</td>
            <td>
              <input name="pacienteMEnviante" type="text" class="form-control" id="pacienteMEnviante"></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">Seguro:</td>
            <td><input name="pacienteSeguro" type="text" id="pacienteSeguro">
            </td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="titlebar">N&uacute;mero de Seguro:</td>
            <td><input name="pacienteNSeguro" type="text" id="pacienteNSeguro">
            </td>
          </tr>
          <tr valign="baseline" bgcolor="#CCCCCC">
            <td align="right" nowrap class="titlebar">Usuario Actual:</td>
            <td><?php echo $_SESSION['MM_Username']."/".$ahora; ?><br>
    <input name="pacienteActualizado" type="hidden" id="pacienteActualizado" value="<?php echo $_SESSION['MM_Username']."/".$ahora; ?>"></td>
          </tr>
          <tr valign="baseline"> 
            <td nowrap align="right">&nbsp;</td> 
            <td><input type="submit" value="Guardar" class="btn btn-dark"></td> 
          </tr> 
        </table> 
      <input type="hidden" name="idUsuario" value="1">
      <input type="hidden" name="MM_insert" value="form1">
</form> 
      <p>&nbsp;</p></td> 
  </tr> 
</table> 
<?php require("includes/pie.php"); ?>
</body>
</html>
<?php


$rsDiagnostico->Close();

/* mysql_free_result($rsEdad);

mysql_free_result($rsClase);

mysql_free_result($rsEstado);

mysql_free_result($rsGenero);

mysql_free_result($rsInstruccion);

mysql_free_result($rsResidencia); */

$qualitat->close();
?>
