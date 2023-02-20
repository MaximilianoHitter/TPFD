<?php

require_once('../../../config.php');
$objConCompraestadotipo = new CompraestadotipoController();
//$data = $objConCompraestadotipo->buscarKey('cetdescripcion');

$datos['idcompraestadotipo'] = Data::buscarKey('idcompraestadotipo');
$datos['cetdescripcion'] = Data::buscarKey('cetdescripcion');
$datos['cetdetalle'] = Data::buscarKey('cetdetalle');
$respuesta = false;
if($datos != null){
    $rta = $objConCompraestadotipo->insertar($datos);
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