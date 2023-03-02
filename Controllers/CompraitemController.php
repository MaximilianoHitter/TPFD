<?php

use React\Promise\Promise;

class CompraitemController extends MasterController
{
    use Errores;

    public function listarTodo($arrBus){
        $arrayTotal = Compraitem::listar($arrBus);
        if(array_key_exists('array', $arrayTotal)){
            $array = $arrayTotal['array'];
        }else{
            $array = [];
        }
        
        //var_dump($array);
        return $array;    
    }

    public function listarTodos( $param ) {
        if( $param = null ) {
            $arrayBus['idcompraitem'] = NULL;
            $arrayTotal = Compraitem::listar( $arrayBus );
        } else {
            $arrayBus = $param;
            $arrayTotal = Compraitem::listar( $arrayBus );
        }

        if (array_key_exists('array', $arrayTotal)) {
            $array = $arrayTotal['array'];
        } else {
            $array = [];
        }
        return $array;
    }


   

    //ACA EN MODIFICAR SETEAMOS LA CANTIDAD QUE QUEDA EN STOCK (DENTRO DE PRODUCTO, NO EN COMPRAITEM)
    public function modificar($idcompraitem, $cicantidad)
    {
        $rta = $this->buscarId($idcompraitem);
        //var_dump($rta);
        $response = false;
        if ($rta['respuesta']) {
            //puedo modificar con los valores
            //$valores = $this->busqueda();
            $objCompraItem = $rta['obj'];
            /* $idproducto['idproducto'] = $valores['idproducto'];
            $idcompra['idcompra'] = $valores['idcompra']; */
            $objProducto = new Producto();
            $objProducto = $objCompraItem->getObjProducto();
            //$objProducto->buscar($idproducto);
            $objCompra = new Compra();
            $objCompra = $objCompraItem->getObjCompra();
            //$objCompra->buscar($idcompra);
            $objCompraItem->cargar($objProducto, $objCompra, $cicantidad);
            $rsta = $objCompraItem->modificar();
            if ($rsta['respuesta']) {
                //todo gut
                $response = true;
            }
        } else {
            //no encontro el obj
            $response = false;
        }
        return $response;
    }



    public function buscarId($idcompraitem)
    {
        $respuesta['respuesta'] = false;
        $respuesta['obj'] = null;
        $respuesta['error'] = '';
        $arrayBusqueda = [];
        $arrayBusqueda['idcompraitem'] = $idcompraitem;
        $objCompIt = new Compraitem();
        $rta = $objCompIt->buscar($arrayBusqueda);
        if ($rta['respuesta']) {
            $respuesta['respuesta'] = true;
            $respuesta['obj'] = $objCompIt;
        } else {
            $respuesta['error'] = $rta;
        }
        return $respuesta;
    }

    /* public function busqueda()
    {
        $arrayBusqueda = [];
        $idcompraitem = $this->buscarKey('idcompraitem');
        $idproducto = $this->buscarKey('idproducto');
        $idcompra = $this->buscarKey('idcompra');
        $cicantidad = $this->buscarKey('cicantidad');

        $arrayBusqueda = [
            'idcompraitem' => $idcompraitem,
            'idproducto' => $idproducto,
            'idcompra' => $idcompra,
            'cicantidad' => $cicantidad,
        ];
        return $arrayBusqueda;
    } */

    public function eliminar($idcompraitem)
    {
        $rta = $this->buscarId($idcompraitem);
        $response = false;
        if ($rta['respuesta']) {
            $objCompraItem = $rta['obj'];
            $respEliminar = $objCompraItem->eliminar();
            if ($respEliminar['respuesta']) {
                $response = true;
            }
        } else {
            //no encontro el obj
            $response = false;
        }
        return $response;
    }

    public function stockTotal($idproducto)
    {
        $idProducto['idproducto'] = $idproducto;
        $objetoProducto = new Producto();
        $busquedaProducto = $objetoProducto->buscar($idProducto);
        if ($busquedaProducto) {
            $cantStock = $objetoProducto->getProCantStock();
        }
        /*  $objetoProducto = $this->getObjProducto();
            $cicantidad = $objetitoProd->getProCantStock(); */
        return $cantStock;
    }

    public function cargarVentaDeProducto($idcompra, $idproducto, $cicantidad)
    {
        $objCompraItem = new CompraItem();
        //obtener producto
        $objProducto = new Producto();
        $arrPr['idproducto'] = $idproducto;
        $objProducto->buscar($arrPr);
        //obtener compra
        $objCompra = new Compra();
        $arrCr['idcompra'] = $idcompra;
        $objCompra->buscar($arrCr);
        $objCompraItem->cargar($objProducto, $objCompra, $cicantidad);
        $rt = $objCompraItem->insertar();
        if ($rt['respuesta']) {
            $response = true;
        } else {
            $response = false;
        }
        return $response;
    }

    /** Al comprar un producto se sumará la cantidad en el carrito 
     * @param string $idcompra
     * @param string $idproducto
     * @param int $cicantidad
     * @return bool
     */

    public function unirMismoProducto($idcompra, $idproducto, $cicantidad)
    {
        $arrayBusqueda = ['idcompra' => $idcompra, 'idproducto' => $idproducto];
        $objCompraItem = new Compraitem();
        $busquedaCompleta = $objCompraItem->buscar($arrayBusqueda);

        if ($busquedaCompleta['respuesta']) {
            $cicantidadActual = $objCompraItem->getCicantidad();
            $cicantidadTotal = $cicantidadActual + $cicantidad;
            $objCompraItem->setCicantidad($cicantidadTotal);
            $objCompraItem->modificar();
        }
        return $busquedaCompleta;
    }
    /*
        public function actualizarCantidad(){
            $cantidadTraida = $this->getCicantidad();

        }*/

    public function editarCantidad($idcompraitem, $idproducto, $cicantidad){
        $erspuesta = false;
        if ($idcompraitem != null) {
            //FUNCION EN CONTROLADOR PAR AQUE TRAIGA LA CANTIDAD DE PRODUCTO
            //FUNCION PARA COMPRAR 
            $cantTotal = $this->stockTotal($idproducto);
            if ($cantTotal >= $cicantidad) {
                $rta = $this->modificar($idcompraitem, $cicantidad);
            }
            if (!$rta) {
                $mensaje = "La accion no pudo concretarse";
            }else{
                $respuesta = true;
            }
        } else {
            $mensaje = 'No hay en stock esa cantidad';
            $rta = false;
        }
        $resp[0] = $rta;
        if(isset($mensaje)){
            $resp[1] = $mensaje;
        }
        return $resp;
    }
    
}
