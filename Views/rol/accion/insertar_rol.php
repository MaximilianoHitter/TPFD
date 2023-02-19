<?php
require_once('../../../config.php');
$objRolCon = new RolController();
$data = $objRolCon->buscarKey('rodescripcion');
$respuesta = false;
if($data != null){
    $rta = $objRolCon->insertar();
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