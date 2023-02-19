<?php
require_once('../../../config.php');
$objMenuCon = new MenuController();
$data = $objMenuCon->buscarKey('idusuario');
$respuesta = false;
if($data != null){
    $rta = $objMenuCon->modificar();
    if(!$rta){
        $mensaje = "La accion no pudo concretarse";
    }
}
$retorno['respuesta'] = $rta;
if(isset($mensaje)){
    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno);