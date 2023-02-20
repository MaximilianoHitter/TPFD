<?php
require_once('../../../config.php');
$objUsuCon = new UsuarioController();
//$data = $objUsuCon->buscarKey('idusuario');
$data = Data::buscarKey('idusuario');
$respuesta = false;
if($data != null){
    $valores['usnombre'] = Data::buscarKey('usnombre');
    $valores['uspass'] = Data::buscarKey('uspass');
    $valores['usmail'] = Data::buscarKey('usmail');
    $rta = $objUsuCon->modificar($data, $valores);
    if(!$rta){
        $mensaje = "La accion no pudo concretarse";
    }
}
$retorno['respuesta'] = $rta;
if(isset($mensaje)){
    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno);