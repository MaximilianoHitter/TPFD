<?php
require_once('../../../config.php');
$objUsuCon = new UsuarioController();
//$data = $objUsuCon->buscarKey('idusuario');
$data = Data::buscarKey('idusuario');
$respuesta = false;
if($data != null){
   $rta = $objUsuCon->eliminar($data);
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