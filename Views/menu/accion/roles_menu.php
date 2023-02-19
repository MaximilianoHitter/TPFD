<?php
require_once('../../../config.php');
$objMenuRol = new MenuRolController();
$rta = $objMenuRol->buscarRoles();
$objUsuarioRolCon = new UsuarioRolController();
$arrayRoles = $objUsuarioRolCon->getRoles();
$rolesSimple = [];
foreach ($arrayRoles as $key => $value) {
    $data = $value->dameDatos();
    $rolesSimple[$data['idrol']] = false;
}
//var_dump($rolesSimple);
//convertir roles del usuario a texto
$rolesTexto = [];
//var_dump($rta);
if(count($rta) != 0){
    foreach ($rta as $key => $value) {
        $data = $value->dameDatos();
        //$idRol = $data['idrol'];
        //var_dump($idRol);
        $rolesTexto[$data['idrol']] = true;
    }
}
//var_dump($rolesTexto);
//var_dump($rolesSimple);
$string = "";
$arrayOtro = [];
if(count($rolesTexto) != 0){
    foreach ($rolesSimple as $id => $idrolArray) {
        $valor = 'false';
        if(array_key_exists($id, $rolesTexto)){
            $rolesSimple[$id] = true;
            $valor = 'true';
            
        }
        $arrayOtro["rol$id"] = $valor;
        if($string == ''){
            $string.="[$id => $valor,";
        }else{
            $string.= " $id => $valor,";
        }
        
    }
}
$string = substr($string, 0, -1);
$string .= "] ";
$objNuevo = (object)array('data' => $arrayOtro);
echo json_encode($objNuevo);
/* $string = substr($string, 0, -1);
$string.= '}'; */

//responder como _easyui_checkbox2 en adelante
//var_dump($rolesSimple);
/* $check = "_easyui_checkbox_";
$contador = 2;
foreach ($rolesSimple as $key => $value) {
    $arrayOtro[$check.$contador] = $value;
    $contador++;
} */
//echo $string;
//echo json_encode($string);
//echo json_encode($arrayOtro);