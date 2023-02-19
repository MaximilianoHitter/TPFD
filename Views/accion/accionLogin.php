<?php
//require_once( '../templates/header.php');
require_once('../../config.php');

$objUsuarioCon = new UsuarioController;
$gola = $objUsuarioCon->buscarObjUsuario2();


/* $objSession = new SessionController();

$usnombre = $objSession->buscarKey('usnombre');
$uspass = $objSession->buscarKey('uspass');

$rta = $objSession->validarCredenciales();
if( $rta == false ){
    echo "<script>console.log('no son validas');</script>";
    $url = $PRINCIPAL;
} else {
    $url = $PRODUCTOS;
    echo "<script>console.log('si son validas');</script>";
} */

if( $gola['rta'] ){
    $objSession = new SessionController();
    $valido = $objSession->validarCredenciales();
    if( $valido ){
        $url = $PRODUCTOS;
    }
} else {
    $url = $PRINCIPAL;
}

header($url);
die();