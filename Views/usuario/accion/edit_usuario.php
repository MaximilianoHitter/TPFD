<?php
require_once('../../../config.php');
$objUsuCon = new UsuarioController();
$data = $objUsuCon->buscarKey('idusuario');
$respuesta = false;
if($data != null){
    $rta = $objUsuCon->modificar();
    if(!$rta){
        $mensaje = "La accion no pudo concretarse";
    }
}
$retorno['respuesta'] = $rta;
if(isset($mensaje)){
    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno);