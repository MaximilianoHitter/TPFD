<?php
//require ('MasterController.php');
class RolController extends MasterController {
    use Errores;

    public function busqueda(){
        $arrayBusqueda = [];
        $idrol = $this->buscarKey('idrol');
        $rodescripcion = $this->buscarKey('rodescripcion');
        $arrayBusqueda = [
            'idrol' => $idrol,
            'rodescripcion' => $rodescripcion
        ];
        return $arrayBusqueda;
    }

    public function listarTodo(){
        //$arrayBusqueda = $this->busqueda();
        $arrayBusqueda = [];
        $arrayTotal = Rol::listar($arrayBusqueda);
        $array = $arrayTotal['array'];
        //var_dump($array);
        return $array;        
    }

    /* public function listarTodo( $arrayBusqueda ){
        $rta = Rol::listar( $arrayBusqueda );
        if( $rta['respuesta'] == true ){
            $data['array'] = $rta['array'];
        } else {
            $data['error'] = $this->manejarError( $rta );
        }
        return $data;
    } */

    public function buscarId() {
        $idBusqueda = $this->buscarKey( 'idrol' );
        if( $idBusqueda == false ){
            // Error
            $data['error'] = $this->warning( 'No se ha encontrado dicho registro' );
        } else {
            // Encontrado!
            $array['idrol'] = $idBusqueda;
            $rol = new Rol();
            $rta = $rol->buscar( $array );
            if( $rta['respuesta'] == false ){
                $data['error'] = $this->manejarError( $rta );
            } else {
                $data['obj'] = $rol;
            }
            return $data;
        }
    }

    public function buscarPorDesc($rodescripcion){
        $objRol = new Rol();
        $arrBuRol['rodescripcion'] = $rodescripcion;
        $objRol->buscar($arrBuRol);
        $idrol = $objRol->getIdrol();
        return $idrol;
    }

    public function modificacionChetita() {
        $rta = $this->buscarId();
        $rol = $rta['array'];

        $roDescripcion = $this->buscarKey( 'rodescripcion' );
        $rol->setRodescripcion( $roDescripcion );

        $respuesta = $rol->modificar();
        return $respuesta;
    }

    public function insertar(){
        $data = $this->busqueda();
        $objRol = new Rol();
        $objRol->setIdrol($data['idrol']);
        $objRol->setRodescripcion($data['rodescripcion']);
        $rta = $objRol->insertar();
        return $rta;
    }

    public function modificar(){
        $rta = $this->buscarId();
        $response = false;
        if($rta['obj']){
            //puedo modificar con los valores
            $valores = $this->busqueda();
            $objRol = $rta['obj'];
            $objRol->cargar($valores['rodescripcion']);
            $rsta = $objRol->modificar();
            if($rsta['respuesta']){
                //todo gut
                $response = true;
            }
        }
        return $response;
    }

    /* public function baja( $param ){
        $bandera = false;
        if( $param->getIdrol() !== null ){
            if( $param->eliminar() ){
                $bandera = true;
            }
        }
        return $bandera;
    } */

    public function eliminar() {
        $rta = $this->buscarId();
        $response = false;
        if($rta['obj']){
            $objRol = $rta['obj'];
            $respEliminar = $objRol->eliminar();
            if($respEliminar['respuesta']){
                $response = true;
            }
        }
        return $response;
    }

    public function algo(){
        $datos = $this->buscarId();
        if(array_key_exists('obj', $datos)){
            return $datos['obj']->dameDatos();
        }else{
            return $datos['error'];
        }
        
    }
}
