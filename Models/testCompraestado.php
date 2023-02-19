<?php
require_once('../config.php');

$objCompra = new Compra();
$objUsuario = new Usuario();
$objCompraEstadoTipo = new Compraestadotipo();
$objCompraEstadoTipo->cargar("vamos", "que podemos");
$objCompraEstadoTipo->insertar();//funca bien hasta aca
$compraestado = new Compraestado();
$found = [];
$found['idusuario'] = 2;
$founds = [];
$founds['idcompra'] = 1;
$camp = $objUsuario->buscar($found);
//var_dump($objUsuario);
$camps = $objCompra->buscar($founds);
//var_dump($objCompra);
//die();
$foundSS = [];
$foundSS['idcompraestadotipo'] = 4;
$objCompraEstadoTipo->buscar($foundSS);
//var_dump($objCompraEstadoTipo);
//die();

/*//cargar FUNCIONA

$compraestado->cargar($objCompra,$objCompraEstadoTipo);
//var_dump($compraestado);
//die();

*//*//insertar FUNCA

$sepudo = $compraestado->insertar();
//var_dump($compraestado);
//die();
if($sepudo){
    echo "funco";
}else{
    echo "segui participando mamerto/a";
}*/


//modificar FUNCA


$busq = [];
$busq['idcompraestado'] = 5;
$info = $compraestado->buscar($busq);
$compraestado->cargar($objCompra,$objCompraEstadoTipo);
$compraestado->modificar();
/*
die();
if($info){
    echo "se encontro";
    var_dump($compraestado);
}else{
    echo "perdido";
}*/


//eliminar FUNCIONA
//$compraestado->eliminar();


/*//buscar FUNCO

$busq = [];
$busq['idcompraestado'] = 4;
$info = $compraestado->buscar($busq);
if($info){
    echo "se encontro";
    var_dump($compraestado);
}else{
    echo "perdido";
}*/

/*//listar FUNCA

$listar = [];
$rta = Compraestado::listar($listar);
if($rta['respuesta']){
    echo "funco";
    var_dump($rta['array']);
}else{
    var_dump ($rta['errorInfo']);
}*/

//dameDatos FUNCA

$found = [];
$found['idcompraestado'] = 4;
$rta = $compraestado->buscar($found);
$datos = $compraestado->dameDatos();
var_dump($datos);