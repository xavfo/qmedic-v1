<?php
//initialize the session
@session_start();

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
/*   session_unregister('MM_Username');
  session_unregister('MM_UserGroup'); */
  session_unset();
  session_destroy();
	
  $logoutGoTo = "index.php?action=gracias";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>