<?php
require_once('../../../config.php');

$objConPro = new ProductoController();
$data = $objConPro->buscarKey('pronombre');
/* $foto = $objConPro->buscarKey('foto'); */

$respuesta = false;
if($data != null){
    /* $imagen = addslashes( file_get_contents($foto['tmp_name']) ); */
    $rta = $objConPro->insertar();
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