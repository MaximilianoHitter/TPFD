<?php

require_once('../../../config.php');
$objConCompraestadotipo = new CompraestadotipoController();
$data = $objConCompraestadotipo->buscarKey('cetdescripcion');
$respuesta = false;
if($data != null){
    $rta = $objConCompraestadotipo->insertar();
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