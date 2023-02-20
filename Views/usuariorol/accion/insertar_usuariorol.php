<?php
require_once('../../../config.php');

$objUsuarioRol = new UsuarioRolController();
//$data = $objUsuarioRol->buscarKey( 'nombre' );
$data['nombre'] = Data::buscarKey('usnombre');
$data['idur'] = Data::buscarKey( 'idur' );
$data['rol'] = Data::buscarKey( 'rol' );

$respuesta = false;
if( $data != null ){
    $rta = $objUsuarioRol->insertar($data);
    if($rta['respuesta']){
        $respuesta = true;
    }
    if(!$respuesta){
        $mensaje = "La accion no pudo completarse";
    }
}

$retorno['respuesta'] = $respuesta;
if( isset($mensaje) ){
    $retorno['errorMsg'] = $mensaje;
}

echo json_encode($retorno);