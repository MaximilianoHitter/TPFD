<?php
require_once('../../../config.php');
$objMenuCon = new MenuController();
$data = $objMenuCon->buscarKey('menombre');
$respuesta = false;
if($data != null){
    $rta = $objMenuCon->insertar();
    if($rta['respuesta']){
        $respuesta = true;
    }
    if(!$respuesta){
        $mensaje = "La accion no pudo completarse";
    }
}
$retorno['respuesta'] = $respuesta;
if(isset($mensaje)){
    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno);