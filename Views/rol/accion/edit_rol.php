<?php
require_once('../../../config.php');
$objRolCon = new RolController();
//$data = $objRolCon->buscarKey('idrol');
$data = Data::buscarKey('idrol');
$valores['rodescripcion'] = Data::buscarKey('rodescripcion');
$respuesta = false;
if($data != null){
    $rta = $objRolCon->modificar($data, $valores);
    if(!$rta){
        $mensaje = "La accion no pudo concretarse";
    }
}
$retorno['respuesta'] = $rta;
if(isset($mensaje)){
    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno);