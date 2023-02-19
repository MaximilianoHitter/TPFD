<?php

require_once('../config.php');

$usuarioRol = new Usuariorol();
$usuario = new Usuario();
$rol = new Rol();
$usuariobusc = [];
$rolbusc = [];
$usuariobusc ['idusuario'] = 1;
$rolbusc['idrol']= 5;
$rol->buscar($rolbusc);
$usuario->buscar($usuariobusc);

//cargar funca

//$usuarioRol->cargar($usuario,$rol);
//var_dump($usuarioRol);


//insertar funca
/*
$rta = $usuarioRol->insertar();*/


//buscar FUNCA
$papa = [];
$papa['idur'] = 2;
$usuarioRol->buscar($papa);
//$usuarioRol->cargar($usuario, $rol);
//var_dump($usuarioRol);
//die();

//MODIFICAR FUNCA
//$usuarioRol->modificar();

if($rta){
    echo "vamos joda";
}else{
    echo "preso";
}

//ELIMINAR FUNCA
$usuarioRol->eliminar();
