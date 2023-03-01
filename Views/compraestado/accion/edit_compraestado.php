<?php
require_once('../../../config.php');

$objCompraEstadoTipoCon = new CompraestadotipoController();

//$idCompraEstado = $objCompraEstadoTipoCon->buscarKey('idcompraestado');
$idCompraEstado = Data::buscarKey('idcompraestado');
//nuevo 
$objCompraEstadoCon = new CompraestadoController();
$idCompraEstadoTipoPorParametro = Data::buscarKey('idcompraestadotipo');
$respuestaVerificar = $objCompraEstadoCon->verificar($idCompraEstado, $idCompraEstadoTipoPorParametro);



$retorno['respuesta'] = $respuestaVerificar[0];
if(isset($respuestaVerificar[1])){
    $retorno['errorMsg'] = $respuestaVerificar[1];
}

echo json_encode($retorno);