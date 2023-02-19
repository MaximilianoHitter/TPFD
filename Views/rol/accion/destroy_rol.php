<?php
require_once('../../../config.php');
$objRolCon = new RolController();
$data = $objRolCon->buscarKey('idrol');
$respuesta = false;
if($data != null){
   $rta = $objRolCon->eliminar();
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