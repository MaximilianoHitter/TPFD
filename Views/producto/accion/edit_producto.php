<?php
require_once('../../../config.php');
$objConPro = new ProductoController();
//$data = $objConPro->buscarKey('idproducto');
$data = Data::buscarKey('idproducto');
$respuesta = false;
if($data != null){
    $valores['pronombre'] = Data::buscarKey('pronombre');
    $valores['sinopsis'] = Data::buscarKey('sinopsis');
    $valores['procantstock'] = Data::buscarKey('procantstock');
    $valores['autor'] = Data::buscarKey('autor');
    $valores['precio'] = Data::buscarKey('precio');
    $valores['isbn'] = Data::buscarKey('isbn');
    $valores['categoria'] = Data::buscarKey('categoria');
    $rta = $objConPro->modificar($data, $valores);
    if(!$rta){
        $mensaje = "La accion no pudo concretarse";
    }
}
$retorno['respuesta'] = $rta;
if(isset($mensaje)){
    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno);