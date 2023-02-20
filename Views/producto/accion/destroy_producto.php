<?php
require_once('../../../config.php');
$objConPro = new ProductoController();
//$data = $objConPro->buscarKey('idproducto');
$data = Data::buscarKey('idproducto');
$respuesta = false;
if($data != null){
   $rta = $objConPro->eliminar($data);
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