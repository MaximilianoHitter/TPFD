<?php
require_once('../../../config.php');
$objUsuarioRolCon = new UsuarioRolController();
$data = $objUsuarioRolCon->eliminar();
$respuesta = false;
if($data){
   $retorno['respuesta'] = true;
   //var_dump($rta);
   //die()
   
    
   
}else{
    $mensaje = "La acción no pudo concretarse";
}
if(isset($mensaje)){
    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno);