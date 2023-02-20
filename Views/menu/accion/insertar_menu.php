<?php
require_once('../../../config.php');
$objMenuCon = new MenuController();
//$data = $objMenuCon->buscarKey('menombre');
$data['menombre'] = Data::buscarKey('menombre');
$data['medescripcion'] = Data::buscarKey('medescripcion');
$data['idpadre'] = Data::buscarKey('idpadre');
$data['medeshabilitado'] = Data::buscarKey('medeshabilitado');
$respuesta = false;
if($data != null){
    $rta = $objMenuCon->insertar($data);
    if($rta['respuesta']){
        $respuesta = true;
    }
    if(!$respuesta){
        $mensaje = "La accion no pudo completarse";
    }
}
$retorno['respuesta'] = $respuesta;
if(isset($mensaje)){
    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno);