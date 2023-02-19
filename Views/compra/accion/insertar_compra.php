<?php
require_once('../../../config.php');
$objConCompra = new ProductoController();
$data = $objConCompra->buscarKey('idcompra');
$respuesta = false;
if($data != null){
    $rta = $objConCompra->insertar();
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