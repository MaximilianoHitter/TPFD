<?php

require_once('../config.php');

$usuario = new Usuario();

// Insertar funca tuki
/* $usuario->cargar( 'gparra', '123', 'gonzzaparra@gmail.com', null );
$asd = $usuario->insertar();
if( $asd['respuesta'] ){
    echo('gut');
} else {
    var_dump($asd['errorInfo']);
} */

// Buscar funca tuki
/*$arrayBusqueda['idusuario'] = 1;
$rta = $usuario->buscar( $arrayBusqueda );
if( $rta['respuesta'] ){
    echo('gut');
} else {
    var_dump( $rta['errorInfo'] );
} 

// Modificar funca tuki
 $usuario->cargar( 'mhitter', '1234', 'mhitter@gmail.com', null );
$answ = $usuario->modificar();
if( $answ['respuesta'] ){
    echo('gut');
    print_r($usuario);
} else {
    var_dump($answ['errorInfo']);
} */

// Listar funca
$arrayBusqueda['idusuario'] = 1;
$rta = Usuario::listar( $arrayBusqueda );
if( $rta['respuesta'] ){
    echo('gut');
    var_dump( $rta['array'] );
} else {
    var_dump($rta['errorInfo']);
} 