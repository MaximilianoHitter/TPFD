<?php

require_once('../config.php');

$producto = new Producto();

/* $producto->cargar('Mi rey', 'NombreDelRey', 2, 'Aurelio', 200, 2322, 'Comedia');
$producto->insertar(); */

$arrayBus['idproducto'] = 1;

$respuesta = $producto->buscar($arrayBus);
print_r($producto);
die();
if($respuesta['respuesta']){
    echo 'si';
    print_r($producto);
}else{
    var_dump($respuesta['errorInfo']);
}

/* $producto->cargar('Hola', 'Nombre', 2, 'Aurelio', 200, 2322, 'Comedia');
$modificar = $producto->modificar();

if($modificar['respuesta']){
    echo 'si';
}else{
    var_dump($modificar['errorInfo']);
} */
/*
$respuesta = $producto->eliminar();

if($respuesta['respuesta']){
    echo 'si';
}else{
    var_dump($respuesta['errorInfo']);
}

/* $array = [];

$respuesta = $producto->listar($array);
if($respuesta['respuesta']){
    var_dump($respuesta['array']);
}else{
    $respuesta['errorInfor'];
} */
