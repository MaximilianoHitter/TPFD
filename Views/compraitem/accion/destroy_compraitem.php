<?php
require_once('../../../config.php');
$objConCompraItem = new CompraitemController();
//$data = $objConCompraItem->buscarKey('idcompraitem');
$data = Data::buscarKey('idcompraitem');
$respuesta = false;
if($data != null){
   $rta = $objConCompraItem->eliminar($data);
   if(!$rta){
    $mensaje = "La acción no pudo concretarse";
   } 
}

$retorno['respuesta'] = true;
if(isset($mensaje)){
    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno);