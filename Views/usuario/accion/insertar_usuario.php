<?php
require_once('../../../config.php');
$objUsuCon = new UsuarioController();
//$data = $objUsuCon->buscarKey('usnombre');
$data['idusuario'] = '';
$data['usnombre'] = Data::buscarKey('usnombre');
$data['uspass'] = Data::buscarKey('uspass');
$data['usmail'] = Data::buscarKey('usmail');
$data['usdeshabilitado'] = Data::buscarKey('usdeshabilitado');
$respuesta = false;
if($data != null){
    $rta = $objUsuCon->insertar($data);
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