<?php

require_once('../config.php');

$rol = new Rol();
$descripcion = "loquito";

//CARGAR FUNCA
$rol->cargar($descripcion);
//INSERTAR FUNCA
//$rta = $rol->insertar();

//BUSCAR FUNCA
$busca = [];
$busca['idrol'] = 1;

$rol->buscar($busca);
$nuevorol= "administreitor";
//$rol->cargar($nuevorol);

//MODIFICAR FUNCA
//$rta = $rol->modificar();
if($rta){
    echo "echo";
}else{
    echo "jajaj";
}

//ELIMINAR FUNCA
$rol->eliminar();

