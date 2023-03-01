<?php
require_once('../../../config.php');
$objUsuarioRolCon = new UsuarioRolController();
$retorno['respuesta'] = false;
//borrar roles de usuario
//$idusuario = $objUsuarioRolCon->buscarKey('idusuario');
$idusuario = Data::buscarKey('idusuario');
//nuevo 
$respuestaRoles = $objUsuarioRolCon->manejoDeRoles($idusuario);

$retorno['respuesta'] = $respuestaRoles[0];
if(isset($respuestaRoles[1])){
    $retorno['errorMsg'] = $respuestaRoles[1];
}
echo json_encode($retorno);
