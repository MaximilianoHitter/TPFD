<?php
require_once('../../../config.php');
$objConCompraestadotipo = new CompraestadotipoController();
$data = $objConCompraestadotipo->buscarIdDos();
//var_dump($data);
/* if($data){
    $objConCompraestadotipo->modificar();
} */
$respuesta = false;
if($data != null){
    $rta = $objConCompraestadotipo->modificar();
    if(!$rta){
        $mensaje = "La accion no pudo concretarse";
    }
}
$retorno['respuesta'] = $rta;
if(isset($mensaje)){
    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno);