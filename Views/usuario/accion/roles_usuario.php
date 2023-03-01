<?php
require_once('../../../config.php');
$objUsuarioRolCon = new UsuarioRolController();
$idusuario = Data::buscarKey('idusuario');
//nuevo 
$objNuevo = $objUsuarioRolCon->temasDeRoles($idusuario);



echo json_encode($objNuevo);
/* $string = substr($string, 0, -1);
$string.= '}'; */

//responder como _easyui_checkbox2 en adelante
//var_dump($rolesSimple);
/* $check = "_easyui_checkbox_";
$contador = 2;
foreach ($rolesSimple as $key => $value) {
    $arrayOtro[$check.$contador] = $value;
    $contador++;
} */
//echo $string;
//echo json_encode($string);
//echo json_encode($arrayOtro);