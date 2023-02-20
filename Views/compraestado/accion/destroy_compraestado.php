<?php
require_once('../../../config.php');
$objCompraEstadoController = new CompraestadoController();
//$data = $objCompraEstadoController->buscarKey('idcompraestado');
$idcompraestado = Data::buscarKey(('idcompraestado'));
$respuesta = false;
if($idcompraestado != null){
   $rta = $objCompraEstadoController->eliminar($idcompraestado);
   /* var_dump($rta);
   die(); */
   if( !$rta ){
    $mensaje = "La acción no pudo concretarse";
   }
}

$retorno['respuesta'] = true;
if( isset($mensaje) ){
    $retorno['errorMsg'] = $mensaje;
}

echo json_encode($retorno);