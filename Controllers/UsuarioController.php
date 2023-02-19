<?php

class UsuarioController extends MasterController {
    use Errores;

    public function listarTodo($arrAlgo = NULL){
        //$arrayBusqueda = $this->busqueda();
        if($arrAlgo == NULL){
            $arr = [];
        }else{
            $arr = $arrAlgo;
        }
        //$arrayBusqueda['usdeshabilitado'] = NULL;
        $arrayTotal = Usuario::listar($arr);
        if(array_key_exists('array', $arrayTotal)){
            $array = $arrayTotal['array'];
        }else{
            $array = [];
        }
        //var_dump($array);
        return $array;        
    }

    /* public function listarTodo( $arrayBusqueda ){
        $rta = Usuario::listar( $arrayBusqueda );
        if( $rta['respuesta'] ){
            $data['array'] = $rta['array'];
        } else {
            $data['error'] = $this->manejarError( $rta['error'] );
        }
        return $data;
    } */

    public function busqueda(){
        $arrayBusqueda = [];
        $idusuario = $this->buscarKey('idusuario');
        $usnombre = $this->buscarKey('usnombre');
        $uspass = $this->buscarKey('uspass');
        $usmail = $this->buscarKey('usmail');
        $usdeshabilitado = $this->buscarKey('usdeshabilitado');
        $arrayBusqueda = ['idusuario' => $idusuario,
                          'usnombre' => $usnombre,
                          'uspass' => $uspass,
                          'usmail' => $usmail,
                          'usdeshabilitado' => $usdeshabilitado];
        return $arrayBusqueda;
    }

    public function buscarId(){
        $respuesta['respuesta'] = false;
        $respuesta['obj'] = null;
        $respuesta['error'] = '';
        $arrayBusqueda = [];
        $arrayBusqueda['idusuario'] = $this->buscarKey('idusuario');
        $objUsuario = new Usuario();
        $rta = $objUsuario->buscar($arrayBusqueda);
        if($rta['respuesta']){
            $respuesta['respuesta'] = true;
            $respuesta['obj'] = $objUsuario;
        }else{
            $respuesta['error'] = $rta;
        }
        return $respuesta;        
    }

    /* public function buscarId() {
        $idBusqueda = $this->buscarKey( 'idusuario' );
        if( $idBusqueda == false ){
            // error
            $data['error'] = $this->warning( 'No se ha encontrado dicho registro' );
        } else {
            // encontrado!
            $array['id'] = $idBusqueda;
            $usuario = new Usuario();
            $rta = $usuario->buscar( $array );
            if( $rta['respuesta'] == false ){
                $data['error'] = $this->manejarError( $rta );
            } else {
                $data['array'] = $usuario;
            }
            return $data;
        }
    } */

    public function insertar(){
        $data = $this->busqueda();
        $objUsuario = new Usuario();
        $objUsuario->setIdusuario($data['idusuario']);
        $objUsuario->setUsnombre($data['usnombre']);
        $objUsuario->setUspass($data['uspass']);
        $objUsuario->setUsmail($data['usmail']);
        $objUsuario->setUsdeshabilitado($data['usdeshabilitado']);
        $rta = $objUsuario->insertar();
        return $rta;
    }

    /* public function insertar( $data ){
        $newUsuario = new Usuario();
        $newUsuario->setIdusuario( $data['idusuario'] );
        $newUsuario->setUsnombre( $data['usnombre'] );
        $newUsuario->setUspass( $data['uspass'] );
        $newUsuario->setUsmail( $data['usmail'] );
        $newUsuario->setUsdeshabilitado( $data['usdeshabilitado'] );

        $operacion = $newUsuario->insertar();
        if( $operacion['respuesta'] == false ){
            $rta = $operacion['errorInfo'];
        } else {
            $rta = $operacion['respuesta'];
        }
        return $rta;
    } */

    public function modificar(){
        $rta = $this->buscarId();
        $response = false;
        if($rta['respuesta']){
            //puedo modificar con los valores
            $valores = $this->busqueda();
            $objUsuario = $rta['obj'];
            $objUsuario->cargar($valores['usnombre'], $valores['uspass'], $valores['usmail']);
            $rsta = $objUsuario->modificar();
            if($rsta['respuesta']){
                //todo gut
                $response = true;
            }
        }
        return $response;
    }

    public function modificacionChetita() {
        $rta = $this->buscarId();
        $usuario = $rta['array'];

        $usNombre = $this->buscarKey( 'usnombre' );
        $usPass = $this->buscarKey( 'uspass' );
        $usMail = $this->buscarKey( 'usmail' );
        $usDeshabilitado = $this->buscarKey( 'usdeshabilitado' );

        $usuario->setUsnombre( $usNombre );
        $usuario->setUspass( $usPass );
        $usuario->setUsmail( $usMail );
        $usuario->setUsdeshabilitado( $usDeshabilitado );

        $respuesta = $usuario->modificar();
        return $respuesta;
    }

    /* public function baja( $param ){
        $bandera = false;
        if( $param->getIdusuario() !== null ){
            if( $param->eliminar() ){
                $bandera = true;
            }
        }
        return $bandera;
    } */

    public function eliminar(){
        $rta = $this->buscarId();
        $response = false;
        if($rta['respuesta']){
            $objUsuario = $rta['obj'];
            $respEliminar = $objUsuario->eliminar();
            if($respEliminar['respuesta']){
                $response = true;
            }
        }else{
            //no encontro el obj
            $response = false;
        }
        return $response;
    }

    public function Noeliminar(){
        $rta = $this->buscarId();
        $response = false;
        if($rta['respuesta']){
            $objUsuario = $rta['obj'];
            $respEliminar = $objUsuario->Noeliminar();
            if($respEliminar['respuesta']){
                $response = true;
            }
        }else{
            //no encontro el obj
            $response = false;
        }
        return $response;
    }

    public function buscarObjUsuario(){
        $arrayBu = $this->busqueda();
        $objUsuario = new Usuario();
        $rt = $objUsuario->buscar($arrayBu);
        if($rt['respuesta']){
            //lo encontro
            $response = $objUsuario;
        }else{
            //no lo encontro
            $response = false;
        }
        return $response;
    }

    public function buscarObjUsuario2() {
        $usnombre = $this->buscarKey( 'usnombre' );
        $uspass = $this->buscarKey( 'uspass' );
        $arrayBu = [
            'usnombre' => $usnombre,
            'uspass' => $uspass
        ];
        $objUsuario = new Usuario();
        $rta = $objUsuario->buscar( $arrayBu );
        if( $rta['respuesta'] ){
            // Lo encontro
            $response['obj'] = $objUsuario;
            $response['rta'] = true;
        } else {
            // No lo encontro
            $response = false;
        }
        return $response;
    }
    
}