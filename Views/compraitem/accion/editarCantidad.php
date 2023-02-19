<?php
require_once('../../../config.php');
$objCompraitemCon = new CompraitemController();
$data = $objCompraitemCon->buscarKey('idcompraitem');
$respuesta = false;
if ($data != null) {
    //FUNCION EN CONTROLADOR PAR AQUE TRAIGA LA CANTIDAD DE PRODUCTO
    //FUNCION PARA COMPRAR 
    $cantTotal = $objCompraitemCon->stockTotal();
    $cantidad = $objCompraitemCon->buscarKey('cicantidad');
    if ($cantTotal >= $cantidad) {
        $rta = $objCompraitemCon->modificar();
        if (!$rta) {
            $mensaje = "La accion no pudo concretarse";
        }
    } else {
        $mensaje = 'No hay en stock esa cantidad';
        $rta = false;
    }
}

$retorno['respuesta'] = $rta;
if (isset($mensaje)) {
    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno);
