<?php
require_once('../../../config.php');
$objCompraestadotipo = new CompraestadotipoController();
//$data = $objCompraestadotipo->buscarKey('idcompraestadotipo');
$data = Data::buscarKey('idcompraestadotipo');
$respuesta = false;
if($data != null){
   $rta = $objCompraestadotipo->eliminar($data);
   //var_dump($rta);
   //die()
   if(!$rta){
    $mensaje = "La acción no pudo concretarse";
   } 
}

$retorno['respuesta'] = true;
if(isset($mensaje)){
    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno);