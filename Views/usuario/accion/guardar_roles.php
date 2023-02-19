<?php
require_once('../../../config.php');
$objUsuarioRolCon = new UsuarioRolController();
$retorno['respuesta'] = false;
//borrar roles de usuario
$idusuario = $objUsuarioRolCon->buscarKey('idusuario');
if ($idusuario != null) {
    $arraybus['idusuario'] = $idusuario;
    $rolesDeUsuario = Usuariorol::listar($arraybus);
    if($rolesDeUsuario['respuesta']){
        if(count($rolesDeUsuario['array']) > 0){
            foreach ($rolesDeUsuario['array'] as $key => $value) {
                $arrBus['idur'] = $value->getIdur();
                $objUsuarioRol = new Usuariorol();
                $objUsuarioRol->buscar($arrBus);
                $objUsuarioRol->eliminar();
                $objUsuarioRol = null;
               
            }
        }
    }
        //cargar objeto de usuario
        $objUsuario = new Usuario();
        $arrayDeBus['idusuario'] = $idusuario;
        $objUsuario->buscar($arrayDeBus);
        //obtener los nuevos roles
        $arrayRoles = $objUsuarioRolCon->getRoles();
        $rolesNuevos = [];
        $rolesSimple = [];
        if(count($arrayRoles)>0){
            foreach ($arrayRoles as $key => $value) {
                $data = $value->dameDatos();
                $idrol = $data['idrol'];
                //$rolesSimple[$data['idrol']] = false;
                $guardarDato = $objUsuarioRolCon->buscarKey(("rol$idrol"));
                //var_dump($guardarDato);
                if ($guardarDato != null && $guardarDato == 'on') {
                    $rolesNuevos[$idrol] = $guardarDato;
                }
            }
            //var_dump($rolesNuevos);
            //cargar los nuevos roles
            foreach ($rolesNuevos as $key => $value) {
                $aBus['idrol'] = $key;
                if($value == 'on'){
                    $objRol = new Rol();
                    $objRol->buscar($aBus);
                    $objUsuarioRol = new UsuarioRol();
                    $objUsuarioRol->cargar($objUsuario, $objRol);
                    $objUsuarioRol->insertar();
                    $objRol = null;
                    $objUsuarioRol = null;
                }
            }
            $retorno['respuesta'] = true;
        }else{
            $mensaje = 'No hay roles cargados';
        }
        
    
    
        
    
    
   
}else{
    $mensaje = 'No se ha podido realizar la operacion';
}
if(isset($mensaje)){
    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno);
