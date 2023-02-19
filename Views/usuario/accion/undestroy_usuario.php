<?php
require_once('../../../config.php');
$objUsuCon = new UsuarioController();
$data = $objUsuCon->buscarKey('idusuario');
//var_dump($data);
$respuesta = false;
if($data != null){
   $rta = $objUsuCon->Noeliminar();
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