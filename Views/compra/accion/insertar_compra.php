<?php
require_once('../../../config.php');
$objConProd = new ProductoController();
//$data = $objConCompra->buscarKey('idcompra');
$respuesta = false;
if(Data::estaSeteado()){
    //obtencion de datos
    $datos = [];
    $datos['idproducto'] = Data::buscarKey('idproducto');
    $datos['pronombre'] = Data::buscarKey('pronombre');
    $datos['sinopsis'] = Data::buscarKey('sinopsis');
    $datos['procantstock'] = Data::buscarKey('procantstock');
    $datos['autor'] = Data::buscarKey('autor');
    $datos['precio'] = Data::buscarKey('precio');
    $datos['isbn'] = Data::buscarKey('isbn');
    $datos['categoria'] = Data::buscarKey('categoria'); 
    //insercion del producto
    $rta = $objConProd->insertar($datos);
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