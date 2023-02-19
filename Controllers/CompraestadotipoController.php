<?php

class CompraestadotipoController extends MasterController{
    use Errores;

    public function busqueda(){
        $arrayBusqueda = [];
        $idCompraestadoTipo = $this->buscarKey('idcompraestadotipo');
        $cetdescripcion = $this->buscarKey('cetdescripcion');
        $cetdetalle = $this->buscarKey('cetdetalle');
        $arrayBusqueda = [
            'idcompraestadotipo' => $idCompraestadoTipo,
            'cetdescripcion' => $cetdescripcion,
            'cetdetalle' => $cetdetalle
        ];
        return $arrayBusqueda;
    }

    public function listarTodo(){
        //$arrayBusqueda = $this->busqueda();
        $arrayBusqueda = [];
        $arrayTotal = Compraestadotipo::listar($arrayBusqueda);
        if($arrayTotal['respuesta'] == false){
            $array = [];
        }else{
            $array = $arrayTotal['array'];
        }
        
        //var_dump($array);
        return $array;        
    }


    public function buscarId() {
        $idBusqueda = $this->buscarKey( 'idcompraestadotipo' );
        if( $idBusqueda == false ){
            // Error
            $data['error'] = $this->warning( 'No se ha encontrado dicho registro' );
        } else {
            // Encontrado!
            $array['idcompraestadotipo'] = $idBusqueda;
            $objCompraestadotipo = new Compraestadotipo();
            $rta = $objCompraestadotipo->buscar( $array['idcompraestadotipo'] );
            if( $rta['respuesta'] == false ){
                $data['error'] = $this->manejarError( $rta );
            } else {
                $data['array'] = $objCompraestadotipo;
            }
            return $data;
        }
    }

    public function buscarIdDos(){
        $rta['respuesta'] = false;
        $idBusqueda = [];
        $idBusqueda['idcompraestadotipo'] = $this->buscarKey('idcompraestadotipo');
        $objCompraestadotipo = new Compraestadotipo();
        $objEncontrado = $objCompraestadotipo->buscar($idBusqueda);
        if($objEncontrado['respuesta']){
            $rta['respuesta'] = true;
            $rta['obj'] = $objCompraestadotipo;
        }
        return $rta;
    }

    public function insertar(){
        $data = $this->busqueda();
        $objCompraestadotipo = new Compraestadotipo();
        $objCompraestadotipo->setIdcompraestadotipo($data['idcompraestadotipo']);
        $objCompraestadotipo->setCetdescripcion($data['cetdescripcion']);
        $objCompraestadotipo->setCetdetalle($data['cetdetalle']);
        $rta = $objCompraestadotipo->insertar();
        return $rta;
    }

    public function modificar(){
        $rta = $this->buscarIdDos();
        //var_dump($rta['respuesta']);
        $response = false;
        if($rta['respuesta']){
            //puedo modificar con los valores
            $valores = $this->busqueda();
            $objCompraestadotipo = $rta['obj'];
            $objCompraestadotipo->cargar($valores['cetdescripcion'], $valores['cetdetalle']);
            $rsta = $objCompraestadotipo->modificar();
            if($rsta['respuesta']){
                //todo gut
                $response = true;
            }
        }
        return $response;
    }

    public function eliminar(){
        $rta = $this->buscarIdDos();
        $response = false;
        if($rta['respuesta']){
            $objCompraestadotipo = $rta['obj'];
            $respEliminar = $objCompraestadotipo->eliminar();
            if($respEliminar['respuesta']){
                $response = true;
            }
        }else{
            //no encontro el obj
            $response = false;
        }
        return $response;
    }

    /* public function modificacionChetita() {
        $rta = $this->buscarId();
        $rol = $rta['array'];

        $roDescripcion = $this->buscarKey( 'rodescripcion' );
        $rol->setRodescripcion( $roDescripcion );

        $respuesta = $rol->modificar();
        return $respuesta;
    }

    public function baja( $param ){
        $bandera = false;
        if( $param->getIdrol() !== null ){
            if( $param->eliminar() ){
                $bandera = true;
            }
        }
        return $bandera;
    } */


}