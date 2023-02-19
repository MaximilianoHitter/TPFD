<?php
require_once('../config.php');


$objCompraitem = new Compraitem();
$objProducto = new Producto();
$objCompra = new Compra();
/*$busc1 = [];
$busc1['idproducto'] = 1;
$prodBusc = $objProducto->buscar($busc1);
$busc2 = [];
$busc2['idcompra'] = 6;
$comprBusc = $objCompra->buscar($busc2);*/


/*//cargar FUNCIONA

$objCompraitem->cargar($objProducto,$objCompra,3);
//var_dump($objCompraitem);

//insertar FUNCIONA
$rta = $objCompraitem->insertar();
if($rta){
    echo "se pudo";
}else{
    echo "jodete ";
}
*/
//buscar FUNCA
$busc['idcompra'] = 3;
$rta = Compraitem::listar($busc);
if(array_key_exists('array', $rta)){
    //encontro algo 
    var_dump($rta['array']);
}else{
    $array = [];
}
var_dump($rta);


/* 
$busc3 = [];
$busc3['idcompraitem'] = 3;
$buscado = $objCompraitem->buscar($busc3); */
/* if($buscado['respuesta'])
echo "<pre>";
var_dump($objCompraitem);
echo "</pre>"; */


//modificar FUNCA
/* $busc2 = [];
$busc2['idcompraitem'] = 2;
$comprBusc = $objCompraitem->buscar($busc2); */
//print_r($objCompra);
//die();
//$busc10['idproducto'] = 2;
//$prodBusc = $objProducto->buscar($busc10);
//print_r($objProducto);
//die();
//$rtass= $objCompraitem->cargar($objProducto,$objCompra, 40);
/*echo "<pre>";
var_dump($objCompraitem);
echo "</pre>";

die();*/
/*$chan = $objCompraitem->modificar();
if($chan['respuesta']){
    echo "funco";
}else{
    echo "segui participando";
}
*/

//eliminar FUNCA
/* $borra=$objCompraitem->eliminar();
if($borra){
    echo "pudiste nava";
}else{
    echo "volate los sesos";
} */
