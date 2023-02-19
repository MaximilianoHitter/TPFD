<?php
require_once('../../../config.php');
$objUsuCon = new UsuarioController();
$data = $objUsuCon->buscarKey('usnombre');
$respuesta = false;
if($data != null){
    $rta = $objUsuCon->insertar();
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