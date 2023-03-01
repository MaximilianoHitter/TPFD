<?php
require_once('../../../config.php');
$objMenuCon = new MenuController();
$retorno['respuesta'] = false;
//borrar roles de menu
//$idmenu = $objMenuCon->buscarKey('idmenu');
$idmenu = Data::buscarKey('idmenu');
//nuevo 
$respuesta = $objMenuCon->temaRoles($idmenu);



$retorno['respuesta'] = $respuesta[0];
if(isset($respuesta[1])){
    $retorno['errorMsg'] = $respuesta[1];
}
echo json_encode($retorno);
