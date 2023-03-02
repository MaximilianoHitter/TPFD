<?php
require_once('../../../config.php');
$objCompraitemCon = new CompraitemController();
//$data = $objCompraitemCon->buscarKey('idcompraitem');
$data = Data::buscarKey('idcompraitem');
$idproducto = Data::buscarKey('idproducto');
$cantidad = Data::buscarKey('cicantidad');
//nuevo 
$respuesta = $objCompraitemCon->editarCantidad($data, $idproducto, $cantidad);



$retorno['respuesta'] = $respuesta[0];
if (isset($respuesta[1])) {
    $retorno['errorMsg'] = $respuesta[1];
}
echo json_encode($retorno);
