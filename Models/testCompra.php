<?php

require_once('../config.php');

$compra = new Compra();
$usuario = new Usuario();
/* $busqueda['idusuario'] = 1;
$rsta = $usuario->buscar($busqueda);
if($rsta['respuesta']){
    echo "funco usuario";
    /* echo "<pre>";
	var_dump($compra);
	echo "</pre>";
	die(); */
/*}else{
    echo "segui participando";
    $rsta['errorInfo'];
} */

//$found = [];
//$found['idusuario'] = 2;
//print_r ($found);
//die();
//$usuarios = $usuario->buscar($found);
//var_dump($usuarios);
//var_dump($usuario);
//die();
/*
if($usuarios['respuesta']){
    echo "funco";
}else{
    echo $usuarios['errorInfo'];
}
print_r($usuarios);
*/


//FUNCIONA EL CARGAR
//FUNCIONA EL INSERTAR
//$respuesta = $compra->cargar($usuario);
//$rta = $compra->insertar();
//var_dump($compra);


//BUSCAR funca

$found = [];
$found['idcompra'] = 8;
//$found['idusuario'] = 1;

$rta = $compra->buscar($found);


if($rta['respuesta']){
    echo "funco";
    echo "<pre>";
	var_dump($compra);
	echo "</pre>";
	
}else{
    echo "segui participando";
    $rta['errorInfo'];
}
die();
//var_dump($compra);

//MODIFICAR funciona

//1)BUSCAMOS EL OBJETO A MODIFICAR


//var_dump($usuario);

//die();

//$rta = $compra->buscar($found);
//var_dump($compra);
//die();
/*
//2)CARGAMOS INFO NUEVA
$rtas = $compra->cargar($usuario);
//var_dump($compra);
//die();
//MODIFICAR funca
//$rta = $compra->modificar($usuario);
//var_dump($compra);
//die();
if($rta){
    echo "funco";
    //var_dump($compra);
}else{
    echo "segui participando";
    $rta['errorInfo'];
}

//PARA MODIFICAR PRIMERO BUSCAMOS EL QUE QUEREMOS MODIFICAR
//LUEGO LO CARGAMOS CON LA INFO NUEVA
//Y LO SUBIMOS CON MODIFICAR
*/
//ELIMINAR
//NO HACE EL BORRADO LOGICO, BORRA TODO EL REGISTRO
/*
$changui =  $compra->eliminar();
if($changui){
    echo "funco";
    //var_dump($compra);
}else{
    echo "segui participando";
    $changui['errorInfo'];
}*/

/*//LISTAR FUNCA
$listar = [];
$rta = Compra::listar($listar);
if($rta['respuesta']){
    echo "funco";
    var_dump($rta['array']);
}else{
    var_dump ($rta['errorInfo']);
}*/

/*//DAMEDATOS FUNCA
$found = [];
$found['idcompra'] = 8;
$rta = $compra->buscar($found);
$datos = $compra->dameDatos();
var_dump($datos);*/

