<?php
require_once('../../../config.php');
$objMenuCon = new MenuController();
//$data = $objMenuCon->buscarKey('idmenu');
$data = Data::buscarKey('idmenu');
$respuesta = false;
if($data != null){
   $rta = $objMenuCon->eliminar($data);
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