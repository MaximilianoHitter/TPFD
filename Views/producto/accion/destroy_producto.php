<?php
require_once('../../../config.php');
$objConPro = new ProductoController();
$data = $objConPro->buscarKey('idproducto');
$respuesta = false;
if($data != null){
   $rta = $objConPro->eliminar();
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