<?php

class MenuRolController extends MasterController {
    use Errores;

    /* public function listarTodo( $arrayBusqueda ){
        $rta = Menurol::listar( $arrayBusqueda );
        if( $rta['respuesta'] == true ){
            $data['array'] = $rta['array'];
        } else {
            $data['error'] = $this->manejarError( $rta );
        }
        return $data;
    } */

    public function listarTodo() {
        $arrayBusqueda = [];
        $arrayTotal = Menurol::listar( $arrayBusqueda );
        $array = $arrayTotal['array'];
        return $array;
    }

    public function buscarId() {
        $idBusqueda = $this->buscarKey( 'idmr' );
        if( $idBusqueda == false ){
            // error
            $data['error'] = $this->warning( 'No se ha encontrado dicho registro' );
        } else {
            // encontrado!
            $array['idmr'] = $idBusqueda;
            $MenuRol = new Menurol();
            $rta = $MenuRol->buscar( $array );
            if( $rta['respuesta'] == false ){
                $data['error'] = $this->manejarError( $rta );
            } else {
                $data['array'] = $MenuRol;
            }
            return $data;
        }
    }

    public function insertar( $data ){
        $newMenuRol = new Menurol();
        $newMenuRol->setIdmr( $data['idmr'] );
        $newMenuRol->setObjMenu( $data['objMenu'] );
        $newMenuRol->setObjRol( $data['objRol'] );

        $operacion = $newMenuRol->insertar();
        if( $operacion['respuesta'] == false ){
            $rta = $operacion['errorInfo'];
        } else {
            $rta = $operacion['respuesta'];
        }
        return $rta;
    }

    public function modificacionChetita() {
        $rta = $this->buscarId();
        $menuRol = $rta['array'];

        $objMenu = $this->buscarKey( 'objMenu' );
        $objRol = $this->buscarKey( 'objRol' );

        $menuRol->setObjMenu( $objMenu );
        $menuRol->setObjRol( $objRol );

        $respuesta = $menuRol->modificar();
        return $respuesta;
    }

    public function baja( $param ){
        $bandera = false;
        if( $param->getIdmr() !== null ){
            if( $param->eliminar() ){
                $bandera = true;
            }
        }
        return $bandera;
    }

    public function buscarRoles(){
        $idmenu = $this->buscarKey('idmenu');
        $arrayBus['idmenu'] = $idmenu;
        $rta = Menurol::listar($arrayBus);
        if($rta['respuesta']){
            $arr = $rta['array'];
        }else{
            $arr = [];
        }
        return $arr;    
    }

    /**
     * Busca todos los MenuRol correspondientes a un objeto Menú
     * Lista todos los roles que tiene el Menú
     * Retorna las descripciones de cada rol correspondientes al Menú
     * @param object
     * @return array
     */
    /* public function buscarRolesMenu( $objMenu ){
        $arr = [];
        $lista = $this->listarTodo( $arr );
        $roles = [];
        if( array_key_exists('array', $lista) ){
            foreach( $lista as $menuRol ){
                $obj = $menuRol->getObjMenu();
                $idmr = $obj->getIdmr();
                if( $idmr == $objMenu->getIdmr() ){
                    $rolDescripcion = $menuRol->getObjRol()->getRodescripcion();
                    array_push( $roles, $rolDescripcion );
                }
            }
        }
        return $roles;
    } */

    

}
