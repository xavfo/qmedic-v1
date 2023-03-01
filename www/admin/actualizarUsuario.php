<?php require_once('../Connections/hc.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

// si pone una contraseña
if (isset($_POST['usuarioPass'])&& isset($_POST['usuarioPass2'])&& $_POST['usuarioPass']<>""&& $_POST['usuarioPass'] == $_POST['usuarioPass2']){
	require_once('../includes/sal.php'); 
	$pass = md5 ($_POST['usuarioPass'].$sal);
	
} else {	
	$pass = $_POST['Passed'];
}
	



  $updateSQL = sprintf("UPDATE usuario SET usuarioTitulo=%s, usuarioNombre=%s, usuarioApellido=%s, usuarioUser=%s, usuarioPass=%s, usuarioDireccion=%s, usuarioDireccion2=%s, usuarioTelefono=%s, usuarioTelefono2=%s, usuarioCelular=%s, usuarioID=%s, usuarioCorreo=%s, usuarioCorreo2=%s, usuarioNota=%s WHERE idUsuario=%s",
                       GetSQLValueString($_POST['usuarioTitulo'], "text"),
                       GetSQLValueString($_POST['usuarioNombre'], "text"),
                       GetSQLValueString($_POST['usuarioApellido'], "text"),
                       GetSQLValueString($_POST['usuarioUser'], "text"),
                       GetSQLValueString($pass, "text"),
                       GetSQLValueString($_POST['usuarioDireccion'], "text"),
                       GetSQLValueString($_POST['usuarioDireccion2'], "text"),
                       GetSQLValueString($_POST['usuarioTelefono'], "text"),
                       GetSQLValueString($_POST['usuarioTelefono2'], "text"),
                       GetSQLValueString($_POST['usuarioCelular'], "text"),
                       GetSQLValueString($_POST['usuarioID'], "text"),
                       GetSQLValueString($_POST['usuarioCorreo'], "text"),
                       GetSQLValueString($_POST['usuarioCorreo2'], "text"),
                       GetSQLValueString($_POST['usuarioNota'], "text"),
                       GetSQLValueString($_POST['idUsuario'], "int"));

  mysql_select_db($database_hc, $hc);
  $Result1 = mysql_query($updateSQL, $hc) or die(mysql_error());

echo $pass;	

  $updateGoTo = "listarUsuario.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rsEditarUsuario = "1";
if (isset($_GET['recordID'])) {
  $colname_rsEditarUsuario = (get_magic_quotes_gpc()) ? $_GET['recordID'] : addslashes($_GET['recordID']);
}
mysql_select_db($database_hc, $hc);
$query_rsEditarUsuario = sprintf("SELECT * FROM usuario WHERE idUsuario = %s", $colname_rsEditarUsuario);
$rsEditarUsuario = mysql_query($query_rsEditarUsuario, $hc) or die(mysql_error());
$row_rsEditarUsuario = mysql_fetch_assoc($rsEditarUsuario);
$totalRows_rsEditarUsuario = mysql_num_rows($rsEditarUsuario);

$colname_rsTipoUsuario = "1";
if (isset($_GET['recordID'])) {
  $colname_rsTipoUsuario = (get_magic_quotes_gpc()) ? $_GET['recordID'] : addslashes($_GET['recordID']);
}
mysql_select_db($database_hc, $hc);
$query_rsTipoUsuario = sprintf("SELECT * FROM usuarionivel, nivel WHERE idUsuario = %s AND usuarionivel.idNivel = nivel.idNivel ORDER BY idUN ASC", $colname_rsTipoUsuario);
$rsTipoUsuario = mysql_query($query_rsTipoUsuario, $hc) or die(mysql_error());
$row_rsTipoUsuario = mysql_fetch_assoc($rsTipoUsuario);
$totalRows_rsTipoUsuario = mysql_num_rows($rsTipoUsuario);

?>
<html>
<head>
<title>Actualizar Usuario</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../CSS/Level3_1.css" rel="stylesheet" type="text/css">
</head>

<body>
		
<?php require_once('menu.php'); ?>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
        <tr valign="baseline">
          <td nowrap align="right">&nbsp;</td>
          <td><img src="../images/users/user2.jpg" alt="<?php echo $row_rsEditarUsuario['usuarioNombre']; ?>" width="123" height="123"></td>
        </tr>
    <tr valign="baseline">
          <td nowrap align="right">IdUsuario:</td>
          <td><?php echo $row_rsEditarUsuario['idUsuario']; ?></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Título:</td>
          <td><input type="text" name="usuarioTitulo" value="<?php echo $row_rsEditarUsuario['usuarioTitulo']; ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Nombre:</td>
          <td><input type="text" name="usuarioNombre" value="<?php echo $row_rsEditarUsuario['usuarioNombre']; ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Apellido:</td>
          <td><input type="text" name="usuarioApellido" value="<?php echo $row_rsEditarUsuario['usuarioApellido']; ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">User:</td>
          <td><input type="text" name="usuarioUser" value="<?php echo $row_rsEditarUsuario['usuarioUser']; ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Contraseña:</td>
          <td><input type="password" name="usuarioPass" size="32">
          *</td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right" valign="top">&nbsp;</td>
          <td><input type="password" name="usuarioPass2" size="32">
          *</td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right" valign="top">Dirección:</td>
          <td>
            <textarea name="usuarioDireccion" cols="50" rows="5"><?php echo $row_rsEditarUsuario['usuarioDireccion']; ?></textarea>
          </td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right" valign="top">Dirección 2:</td>
          <td>
            <textarea name="usuarioDireccion2" cols="50" rows="5"><?php echo $row_rsEditarUsuario['usuarioDireccion2']; ?></textarea>
          </td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Teléfono:</td>
          <td><input type="text" name="usuarioTelefono" value="<?php echo $row_rsEditarUsuario['usuarioTelefono']; ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Teléfono 2:</td>
          <td><input type="text" name="usuarioTelefono2" value="<?php echo $row_rsEditarUsuario['usuarioTelefono2']; ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Celular:</td>
          <td><input type="text" name="usuarioCelular" value="<?php echo $row_rsEditarUsuario['usuarioCelular']; ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Cédula / Pasaporte:</td>
          <td><input type="text" name="usuarioID" value="<?php echo $row_rsEditarUsuario['usuarioID']; ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Correo Elecrónico:</td>
          <td><input type="text" name="usuarioCorreo" value="<?php echo $row_rsEditarUsuario['usuarioCorreo']; ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Correo Elecrónico 2:</td>
          <td><input type="text" name="usuarioCorreo2" value="<?php echo $row_rsEditarUsuario['usuarioCorreo2']; ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right" valign="top">Nota:</td>
          <td>
            <textarea name="usuarioNota" cols="50" rows="5"><?php echo $row_rsEditarUsuario['usuarioNota']; ?></textarea>
          </td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Niveles de usuario: </td>
          <td><table border="1" cellpadding="3" cellspacing="0">
            <tr bgcolor="#CCCCCC">
              <td bgcolor="#CCCCCC">Nivel</td>
              <td>nivelNombre</td>
            </tr>
            <?php do { ?>
            <tr>
              <td><?php echo $row_rsTipoUsuario['idNivel']; ?></td>
              <td><?php echo $row_rsTipoUsuario['nivelNombre']; ?></td>
            </tr>
            <?php } while ($row_rsTipoUsuario = mysql_fetch_assoc($rsTipoUsuario)); ?>
          </table></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">&nbsp;</td>
          <td><p>
            <input type="submit" value="Actualizar">&nbsp;            </p>          </td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form1">
      <input type="hidden" name="idUsuario" value="<?php echo $row_rsEditarUsuario['idUsuario']; ?>">
      <input name="Passed" type="hidden" id="Passed" value="<?php echo $row_rsEditarUsuario['usuarioPass'] ;?>">
</form>
    <p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsEditarUsuario);

mysql_free_result($rsTipoUsuario);
?>
