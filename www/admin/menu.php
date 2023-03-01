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
  /* $MM_Username->unset();
  $MM_UserGroup->unset(); */
  session_destroy();

  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>

<table width="100%" border="0" cellpadding="3" cellspacing="0" class="Headding">
  <tr>
    <td width="23%">&nbsp;</td>
    <td width="43%">&nbsp;</td>
    <td width="34%">Ver.
      <?php //require_once('../includes/version.txt'); ?>
      - CIE
      <?php //require_once('../includes/versionCIE.txt'); ?></td>
  </tr>
  <tr bgcolor="#FFFFCC">
    <td><a href="listarUsuario.php">Listar Usuarios </a></td>
    <td bgcolor="#FFFFCC"><a href="#">Config</a></td>
    <td><a href="<?php echo $logoutAction ?>">Salir</a></td>
  </tr>
  <tr>
    <td><a href="nuevoUsuario.php">Nuevo Usuario </a></td>
    <td><a href="listarCodigosTipo.php">C&oacute;digos</a> | </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

