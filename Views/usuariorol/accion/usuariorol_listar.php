<?php
require_once('../../../config.php');
$objUsuarioRolCon = new UsuarioRolController();
$array = [];
$lista = $objUsuarioRolCon->listarTodo($array);
var_dump($lista);
die();
if(array_key_exists('arrayHTML', $lista)){
    echo json_encode($lista['arrayHTML']);
}else{
    $arreglo_salid = array();
    foreach ($lista as $key => $value) {
    $nuevoElemen = $value->dameDatos();
    array_push($arreglo_salid, $nuevoElemen);
}
}

//var_dump($arreglo_salid);
//echo json_encode($arreglo_salid);