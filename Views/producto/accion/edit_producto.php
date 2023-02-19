<?php
require_once('../../../config.php');
$objConPro = new ProductoController();
$data = $objConPro->buscarKey('idproducto');
$respuesta = false;
if($data != null){
    $rta = $objConPro->modificar();
    if(!$rta){
        $mensaje = "La accion no pudo concretarse";
    }
}
$retorno['respuesta'] = $rta;
if(isset($mensaje)){
    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno);