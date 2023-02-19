<?php
require_once('../config.php');



//$menu = new Menu();
//var_dump ($menu);
//die();

/*/cargar E INSERTAR FUNCIONA

$menu->cargar(200, "Peluqueria","servicios que realiza",null, null);
$resultado = $menu->insertar();
var_dump($menu);
/* if($resultado['respuesta']){
    echo "se realizo";
}else{
    var_dump( $resultado['errorInfo']);
    echo "juira bicho";
} */


//MODIFICAR diria pequeña langosta: FUNCO PAPA
//$buscado = [];
//$buscado ['idmenu'] = 15;

//$menurecargado = $menu->buscar($buscado);
//var_dump($menu);
//die();

//$menu->cargar("veterinaria","veterinario del local", null,null);
//var_dump($menurecargado);

//var_dump($menu);
//die();

//if($menurecargado['respuesta']){
    //echo "funco";
//}else{
    //var_dump ($menurecargado['errorInfo']);
//}

/*
$lala=$menu->modificar();
if($lala['respuesta']){
    echo "funco";
}else{
    var_dump ($lala['errorInfo']);
}

*/
/*
//ELIMINAR FUNCA PAPA
$menu = new Menu();
$buscado = [];
$buscado ['idmenu'] = 15;

$menurecargado = $menu->buscar($buscado);
//var_dump($menu);
//die();
$lala=$menu->eliminar();
if($lala['respuesta']){
    echo "funco";
}else{
    var_dump ($lala['errorInfo']);
}*/

/*//LISTAR FUNCIONA
$menu = new Menu();
$listar = [];
$rta = Menu::listar($listar); 
if($rta['respuesta']){
    echo "funco";
    var_dump($rta['array']);
}else{
    var_dump ($rta['errorInfo']);
}*/


//DAME DATOS RECURSIVO-----FUNCA

$menu = new Menu();
$buscado ['idmenu'] = 9;
$menurecargado = $menu->buscar($buscado);
//print_r($menu);
//die();
if($menurecargado['respuesta']){
    echo "funco";
}else{
    echo "segui participando";
}
//die();
//$datos = $menu->dameDatosRecursivo();
$datos = $menu->dameDatos();
var_dump($datos);
//echo $datos['menombre'];


