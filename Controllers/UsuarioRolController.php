<?php

class UsuarioRolController extends MasterController
{
    use Errores;

    public function listarTodo($arrayBusqueda)
    {
        $rta = Usuariorol::listar($arrayBusqueda);
        if ($rta['respuesta'] == true) {
            //conversion
            $data['array'] = $rta['array'];
            $data['arrayHTML'] = [];
            foreach ($data['array'] as $key => $value) {
                $objUsuarioRol = $value;
                $objUsuario = $value->getObjUsuario();
                $objRol = $value->getObjRol();
                $idur = $objUsuarioRol->getIdur();
                $nombre = $objUsuario->getUsnombre();
                $rol = $objRol->getRodescripcion();
                $array['idur'] = $idur;
                $array['nombre'] = $nombre;
                $array['rol'] = $rol;
                array_push($data['arrayHTML'], $array);
            }
        } else {
            $data['error'] = $this->manejarError($rta);
        }
        return $data;
    }

    /* public function busqueda(){
        $arrayBusqueda = [];
        $idusuario = $this->buscarKey( 'idur' );
        $usnombre = $this->buscarKey( 'usnombre' );
        $rol = $this->buscarKey( 'rol' );
        $arrayBusqueda = [
            'idusuario' => $idusuario,
            'usnombre' => $usnombre,
            'uspass' => $rol
        ];
        return $arrayBusqueda;
    } */

    public function buscarRoles($idusuario)
    {
        //$idusuario = $this->buscarKey('idusuario');
        //var_dump($idusuario);
        $arrayBus = [];
        $arrayBus['idusuario'] = $idusuario;
        $rta = Usuariorol::listar($arrayBus);
        $listaRoles = [];
        if ($rta['respuesta']) {
            $listaRoles = $rta['array'];
        }
        return $listaRoles;
    }

    public function buscarId()
    {
        $idBusqueda = Data::buscarKey('idur');
        if ($idBusqueda == false) {
            // Error
            $data['error'] = $this->warning('No se ha encontrado dicho registro');
        } else {
            // Se encontrĂ³
            $array['idur'] = $idBusqueda;
            $usuarioRol = new Usuariorol();
            $rta = $usuarioRol->buscar($array);
            if ($rta['respuesta'] == false) {
                $data['error'] = $this->manejarError($rta);
            } else {
                $data['array'] = $usuarioRol;
            }
        }
        return $data;
    }

    public function buscarNombreUsuario()
    {
        $idBusqueda = Data::buscarKey('usnombre');
        if ($idBusqueda == false) {
            // Error
            $data['error'] = $this->warning('No se ha encontrado dicho registro');
        } else {
            // Se encontrĂ³
            $data = $idBusqueda;
        }
        return $data;
    }

    public function insertar($data)
    {
        $newUsuarioRol = new Usuariorol();
        //$data = $this->busqueda();

        $newUsuarioRol->setIdur($data['idur']);
        $newUsuarioRol->setObjUsuario($data['objUsuario']);
        $newUsuarioRol->setObjRol($data['objRol']);

        $operacion = $newUsuarioRol->insertar();
        if ($operacion['respuesta'] == false) {
            $rta = $operacion['errorInfo'];
        } else {
            $rta = $operacion['respuesta'];
        }
        return $rta;
    }

    /* public function modificacionChetita() {
        $rta = $this->buscarId();
        $usuarioRol = $rta['array'];

        $idur = $this->buscarKey( 'idur' );
        $objUsuario = $this->buscarKey( 'objUsuario' );
        $objRol = $this->buscarKey( 'objRol' );

        $usuarioRol->setIdur( $idur );
        $usuarioRol->setObjUsuario( $objUsuario );
        $usuarioRol->setObjRol( $objRol );

        $respuesta = $usuarioRol->modificar();
        return $respuesta;
    } */

    public function eliminar($idur)
    {
        $response = false;
        $arrayBus['idur'] = $idur;
        $objUsuarioRol = new UsuarioRol();
        $rta = $objUsuarioRol->buscar($arrayBus);
        if ($rta['respuesta']) {
            $rtaa = $objUsuarioRol->eliminar();
            if ($rtaa['respuesta']) {
                //se elimino
                $response = true;
            }
        }
        return $response;
    }

    public function getRoles()
    {
        $arrayBus = [];
        $listaRoles = Rol::listar($arrayBus);
        if (isset($listaRoles['array'])) {
            $lista = $listaRoles['array'];
        } else {
            $lista = $listaRoles['respuesta'];
        }
        return $lista;
    }

    public function getRolesConIdUsuario($idUsuario)
    {
        $arrBUsuario['idusuario'] = $idUsuario;
        $rt = Usuariorol::listar($arrBUsuario);
        if (array_key_exists('array', $rt)) {
            //encontro los roles
            $roles = [];
            foreach ($rt['array'] as $key => $value) {
                $objUsuRol = $value->dameDatos();
                array_push($roles, $objUsuRol);
            }
            $response = $roles;
        } else {
            $response = false;
        }
        return $response;
    }

    public function getUsuarios()
    {
        $arrayBus = [];
        $arrayBus['usdeshabilitado'] = NULL;
        $listaUsuarios = Usuario::listar($arrayBus);
        return $listaUsuarios['array'];
    }

    public function obtenerNuevosRoles()
    {
        $roles = $this->getRoles();
        $arrayRoles = [];
        foreach ($roles['array'] as $key => $value) {
            $data = $value->dameDatos();
            $array['idrol'] = $data['idrol'];
            $array['rodescripcion'] = $data['rodescripcion'];
            array_push($arrayRoles, $array);
        }
        $arrayRta = [];
        foreach ($arrayRoles as $key => $value) {
            $rodescripcion = $value['rodescripcion'];
            $input = Data::buscarKey("$rodescripcion");
            if ($input != null) {
                $campo = true;
            } else {
                $campo = false;
            }
            $arr[$rodescripcion] = $campo;
            array_push($arrayRta, $arr);
        }
    }

    public function baja($param)
    {
        $bandera = false;
        if ($param->getIdur !== null) {
            if ($param->eliminar()) {
                $bandera = true;
            }
        }
        return $bandera;
    }

    public function dameDatos()
    {
        $objUsuarioRol = new Usuariorol();
        $data = [];
        $data['idur'] = $objUsuarioRol->getIdur();
        $objUsuario = $objUsuarioRol->getObjUsuario();
        $data['idusuario'] = $objUsuario->getIdusuario();
        $objUsuario = null;
        $objRol = $objUsuarioRol->getObjRol();
        $data['idrol'] = $objRol->getIdrol();
        $objRol = null;
        return $data;
    }

    public function manejoDeRoles($idusuario)
    {
        if ($idusuario != null) {
            $arraybus['idusuario'] = $idusuario;
            $rolesDeUsuario = Usuariorol::listar($arraybus);
            if ($rolesDeUsuario['respuesta']) {
                if (count($rolesDeUsuario['array']) > 0) {
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
            $arrayRoles = $this->getRoles();
            $rolesNuevos = [];
            $rolesSimple = [];
            if (count($arrayRoles) > 0) {
                foreach ($arrayRoles as $key => $value) {
                    $data = $value->dameDatos();
                    $idrol = $data['idrol'];
                    //$rolesSimple[$data['idrol']] = false;
                    //$guardarDato = $objUsuarioRolCon->buscarKey(("rol$idrol"));
                    $guardarDato = Data::buscarKey(("rol$idrol"));
                    //var_dump($guardarDato);
                    if ($guardarDato != null && $guardarDato == 'on') {
                        $rolesNuevos[$idrol] = $guardarDato;
                    }
                }
                //var_dump($rolesNuevos);
                //cargar los nuevos roles
                foreach ($rolesNuevos as $key => $value) {
                    $aBus['idrol'] = $key;
                    if ($value == 'on') {
                        $objRol = new Rol();
                        $objRol->buscar($aBus);
                        $objUsuarioRol = new UsuarioRol();
                        $objUsuarioRol->cargar($objUsuario, $objRol);
                        $objUsuarioRol->insertar();
                        $objRol = null;
                        $objUsuarioRol = null;
                    }
                }
                $respuesta = true;
            } else {
                $respuesta = false;
                $mensaje = 'No hay roles cargados';
            }
        } else {
            $respuesta = false;
            $mensaje = 'No se ha podido realizar la operacion';
        }
        $retorno[0] = $respuesta;
        if (isset($mensaje)) {
            $retorno[1] = $mensaje;
        }
        return $retorno;
    }

    public function temasDeRoles($idusuario)
    {
        $rta = $this->buscarRoles($idusuario);
        $arrayRoles = $this->getRoles();
        $rolesSimple = [];
        foreach ($arrayRoles as $key => $value) {
            $data = $value->dameDatos();
            $rolesSimple[$data['idrol']] = false;
        }
        //var_dump($rolesSimple);
        //convertir roles del usuario a texto
        $rolesTexto = [];
        //var_dump($rta);
        if (count($rta) != 0) {
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
        if (count($rolesTexto) != 0) {
            foreach ($rolesSimple as $id => $idrolArray) {
                $valor = 'false';
                if (array_key_exists($id, $rolesTexto)) {
                    $rolesSimple[$id] = true;
                    $valor = 'true';
                }
                $arrayOtro["rol$id"] = $valor;
                if ($string == '') {
                    $string .= "[$id => $valor,";
                } else {
                    $string .= " $id => $valor,";
                }
            }
        }
        $string = substr($string, 0, -1);
        $string .= "] ";
        $objNuevo = (object)array('data' => $arrayOtro);
        return $objNuevo;
    }
}
