<?php
if (!isset($sal)){
/**
 * La sal se genera aleatoriamente aquí.
 *
 * Para la GRAN mayoría de los casos de uso, dejar que password_hash genere la sal aleatoriamente
 */
$sal = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
}
//echo $sal;

//Encriptar
//$hash= password_hash("rasmuslerdorf", PASSWORD_DEFAULT);

//Ingresar - comparar
/* if (password_verify('rasmuslerdorf', $hash)) {
    echo '¡La contraseña es válida!';
} else {
    echo 'La contraseña no es válida.';
} */
?>
