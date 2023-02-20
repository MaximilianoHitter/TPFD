<?php
require_once('../../../config.php');

$objConPro = new ProductoController();
$data['pronombre'] = Data::buscarKey('pronombre');
$data['sinopsis'] = Data::buscarKey('sinopsis');
$data['procantstock'] = Data::buscarKey('procantstock');
$data['autor'] = Data::buscarKey('autor') ;
$data['precio'] = Data::buscarKey('precio') ;
$data['isbn'] = Data::buscarKey('isbn') ;
$data['categoria'] = Data::buscarKey('categoria') ;
$data['foto'] = '' ;
//$data[] = $objConPro->buscarKey('pronombre');
/* $foto = $objConPro->buscarKey('foto'); */

$respuesta = false;
if($data != null){
    /* $imagen = addslashes( file_get_contents($foto['tmp_name']) ); */
    $rta = $objConPro->insertar($data);
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