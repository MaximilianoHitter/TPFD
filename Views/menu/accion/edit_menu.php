<?php
require_once('../../../config.php');
$objMenuCon = new MenuController();
//$data = $objMenuCon->buscarKey('idusuario');
$data = Data::buscarKey('idmenu');
$respuesta = false;
if($data != null){
    $valores['menombre'] = Data::buscarKey('menombre'); 
    $valores['medescripcion'] = Data::buscarKey('medescripcion');
    $valores['idpadre'] = Data::buscarKey('idpadre');
    $rta = $objMenuCon->modificar($data, $valores);
    if(!$rta){
        $mensaje = "La accion no pudo concretarse";
    }
}
$retorno['respuesta'] = $rta;
if(isset($mensaje)){
    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno);