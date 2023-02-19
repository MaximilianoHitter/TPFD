<?php
require_once('../../../config.php');
$objConCompraItem = new CompraitemController();
$data = $objConCompraItem->buscarKey('idcompraitem');
$respuesta = false;
if($data != null){
   $rta = $objConCompraItem->eliminar();
   if(!$rta){
    $mensaje = "La acción no pudo concretarse";
   } 
}

$retorno['respuesta'] = true;
if(isset($mensaje)){
    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno);