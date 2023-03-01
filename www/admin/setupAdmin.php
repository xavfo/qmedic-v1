<?php
    @session_start();

    //Connection statement
    require_once('../Connections/qualitat_ado.php');
    //Aditional Functions
    require_once('../includes/functions.inc.php');

    //debug
    /* if ($_REQUEST) {
    echo '<pre>';
    echo htmlspecialchars(print_r($_REQUEST, true));
    echo '</pre>';
    } */
    /* if (isset($accesscheck)) {
    $GLOBALS['PrevUrl'] = $accesscheck;
    session_register('PrevUrl');
    } */

    $loginFormAction = $_SERVER['PHP_SELF'];

    $inicial = "aenima";

    //Salt + Hash
    require_once('../includes/sal.php');
    $passw = password_hash(isset($inicial), PASSWORD_DEFAULT);
    //echo $passw."\n";

    $blowf = "$2y$10\$TFmUu4germzwMobRgZWRV.DUjmN4x5nUG6.cRBsFf90m7vfDLK2E6";

    echo $blowf;

    if (password_verify($inicial, $blowf)) {
        echo '¡La contraseña es válida!';
    }else{
        echo '¡La contraseña NO es válida!';
    }
  ?>