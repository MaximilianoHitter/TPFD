<?php
require_once('../../../config.php');
$objSession = new SessionController();
//require_once('../templates/preheader.php');
$objCompraEstadoCon = new CompraestadoController();
try {
    $rol = $objSession->getRolPrimo();
    if ($rol != '') {
        if ($rol == 'Admin' || $rol == 'Deposito') {
            $arrBu = [];
            $list = $objCompraEstadoCon->listarTodo($arrBu);
            //var_dump($lista);
            $lista = [];
            foreach ($list as $key => $value) {
                $datos = $value->dameDatos();
                array_push($lista, $datos);
            }
        } elseif ($rol == 'Cliente') {
            $arrBuUs['idusuario'] = $objSession->getIdusuario();
            $objCompraCon = new CompraController();
            //var_dump($arrBuUs);
            $listCompraDeCliente = $objCompraCon->listarTodo($arrBuUs);
            //var_dump($listCompraDeCliente);
            $arrList = [];
            foreach ($listCompraDeCliente as $key => $value) {
                $arrBuCEcliente['idcompra'] = $value->getIdcompra();
                //$arrBuCEcliente['cefechafin'] = NULL;
                $lis = $objCompraEstadoCon->listarTodo($arrBuCEcliente);
                array_push($arrList, $lis);
            }
            $lista = [];
            foreach ($arrList as $key => $value) {
                foreach ($value as $llave => $valor) {
                    $datos = $valor->dameDatos();
                    $arDatos = ['idcompraestado' => $datos['idcompraestado'], 'idcompra' => $datos['idcompra'], 'idcompraestadotipo' => $datos['idcompraestadotipo'], 'cetdescripcion' => $datos['cetdescripcion'], 'cefechaini' => $datos['cefechaini'], 'cefechafin' => $datos['cefechafin']];
                    array_push($lista, $arDatos);
                }
            }
            
        }
        

        //var_dump($lista);
    }
} catch (\Throwable $th) {
    $rol = '';
    $lista = []; //  ['idproducto' => '', 'pronombre' => '', 'sinopsis'=>'', 'procantstock'=>'', 'autor'=>'', 'precio'=>'', 'isbn'=>'', 'categoria'=>''];
}
/* $arreglo_salid = array();
foreach ($lista as $key => $value) {
    $nuevoElemen = $value->dameDatos();
    array_push($arreglo_salid, $nuevoElemen);
} */
//var_dump($arreglo_salid);
echo json_encode($lista);