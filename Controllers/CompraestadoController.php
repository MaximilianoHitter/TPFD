<?php
//NO USARLO PORQUE STA AL PEDO
class CompraestadoController extends MasterController
{
    use Errores;

    //crea array para la busqueda
    /* public function busqueda(){
        $arrayBusqueda = [];
        $idcompraestado = $this->buscarKey('idcompraestado');
        $idcompra = $this->buscarKey('idcompra');
        $idcompraestadotipo = $this->buscarKey('idcompraestadotipo');
        $cefechaini = $this->buscarKey('cefechaini');
        /* $cefechafin = $this->buscarKey('cefechafin'); */
    /*$arrayBusqueda = ['idcompraestado' => $idcompraestado,
                          'idcompra' => $idcompra,
                          'idcompraestadotipo' => $idcompraestadotipo,
                          'cefechaini' => $cefechaini,
                          ];
        return $arrayBusqueda;
    } */

    public function listarTodo($arrayBusqueda)
    {
        //$arrayBusqueda = $this->busqueda();
        //$arrayBusqueda['cefechafin'] = NULL;
        $arrayTotal = Compraestado::listar($arrayBusqueda);
        if (array_key_exists('array', $arrayTotal)) {
            $array = $arrayTotal['array'];
        } else {
            $array = [];
        }

        //var_dump($array);
        return $array;
    }

    public function buscarId($idcompraestado)
    {
        $respuesta['respuesta'] = false;
        $respuesta['obj'] = null;
        $respuesta['error'] = '';
        $arrayBusqueda = [];
        $arrayBusqueda['idcompraestado'] = $idcompraestado;
        $objCompraestado = new Compraestado();
        $rta = $objCompraestado->buscar($arrayBusqueda);
        //var_dump($objCompraestado);
        if ($rta['respuesta']) {
            $respuesta['respuesta'] = true;
            $respuesta['obj'] = $objCompraestado;
        } else {
            $respuesta['error'] = $rta;
        }
        return $respuesta;
    }

    public function insertarCompraEstadoNueva($idcompra)
    {
        $objCompraEstado = new Compraestado();
        //generar objeto de compraestadotipo
        $arrBusCET['idcompraestadotipo'] = 1;
        $objCompraEstadoTipo = new Compraestadotipo();
        $objCompraEstadoTipo->buscar($arrBusCET);
        //generar objeto de compra 
        $arrBusC['idcompra'] = $idcompra;
        $objCompra = new Compra();
        $objCompra->buscar($arrBusC);
        $objCompraEstado->cargar($objCompra, $objCompraEstadoTipo);
        $rsta = $objCompraEstado->insertar();
        if ($rsta['respuesta']) {
            $response = true;
        } else {
            $response = false;
        }
        return $response;
    }


    //
    /* public function insertar(){
        $data = $this->busqueda();
        $objCompraestado = new Compraestado();
        $objCompraestado->setIdcompraestado($data['idcompraestado']);
        $objCompra = new Compra();
        $objCompra->buscar($data['idcompra']);
        $objCompraestado->setObjCompra($objCompra);
        $objCompraestadotipo = new Compraestado();
        $objCompraestadotipo->buscar($data['idcompraestadotipo']);
        $objCompraestado->setObjCompraestadotipo($objCompraestadotipo);
        $objCompraestado->setCefechaini($data['cefechaini']);
        $objCompraestado->setCefechafin($data['cefechafin']);
        $rta = $objCompraestado->insertar();
        return $rta;
    } */



    /* public function modificar(){
        $rta = $this->buscarId();
        $response = false;
        if($rta['respuesta']){
            //puedo modificar con los valores
            $valores = $this->busqueda();
            
            $objCompraestado = $rta['obj'];
            /* $objCompraestado->cargar($valores['idcompraestado'], $valores['idcompra'], $valores['idcompraestadotipo'], $valores['cefechaini'], $valores['cefechafin']); */

    /* $objCompra = new Compra();
            $arridcompra = ['idcompra' => $valores['idcompra']];
            $objCompra->buscar($arridcompra);
            $objCompraestado->setObjCompra($objCompra);

            $objCompraestadotipo = new Compraestadotipo();
            $arridcompraestadotpo = ['idcompraestadotipo' => $valores['idcompraestadotipo']]; */
    /* var_dump($arridcompraestadotpo);
            die(); */
    /*  $objCompraestadotipo->buscar($arridcompraestadotpo);
            $objCompraestado->setObjCompraestadotipo($objCompraestadotipo);

            $rsta = $objCompraestado->modificar();
            if($rsta['respuesta']){
                //todo gut
                $response = true;
            }
        }else{
            //no encontro el obj
            $response = false;
        }
        return $response;
    }  */


    public function eliminar($idcompraestado)
    {
        $rta = $this->buscarId($idcompraestado);
        $response = false;
        if ($rta['respuesta']) {
            $objProducto = $rta['obj'];
            $respEliminar = $objProducto->eliminar();
            if ($respEliminar['respuesta']) {
                $response = true;
            }
        } else {
            //no encontro el obj
            $response = false;
        }
        return $response;
    }

    public function obtenerCompraActivaPorId($idcompra)
    {
        $arrBus = [];
        $arrBus['idcompra'] = $idcompra;
        $arrBus['idcompraestadotipo'] = 1;
        $arrBus['cefechafin'] = NULL;
        $objCompraEstado = new Compraestado();
        $rta = $objCompraEstado->buscar($arrBus);
        $respuesta = false;
        if ($rta['respuesta']) {
            //salio bien la query
            $objCompra = new Compra();
            $objCompra = $objCompraEstado->getObjCompra();
            $idcompra = $objCompra->getIdcompra();
            //$objCompraEstado->getObjCompra()->getIdcompra() != NULL
            if ($idcompra != NULL) {
                //hay una compra activa
                //$respuesta = $objCompraEstado->getObjCompra()->getIdcompra();
                $respuesta = $idcompra;
            }
        }
        return $respuesta;
    }

    //ponemos la fecha de hoy para el cambio de estado
    /* public function setearfecha(){
        $rta = $this->buscarId();
        $sepudo = [];
        $hoy = date("Y-m-d H:i:s");
        if(!is_null($rta['obj'])){
            $objetoCompraestado = $rta['obj'];
            $objetoCompraestado->setCefechafin($hoy);
            $sepudo['respuesta'] = true;
            $sepudo['objmodif'] = $objetoCompraestado;
        }else{
            $sepudo['respuesta'] = false;
            
        }
        return $sepudo;
        
    } */

    //para modificar la fecha y modificarla en la base de datos
    /* public function modificarFechafin(){
        $arrayCompraestado = $this->buscarId();
        $objCompraestado = $arrayCompraestado['obj'];
        $fechafin = date("Y-m-d H:i:s");
        $objCompraestado->setCefechafin($fechafin);
        $rta = $objCompraestado->modificar();
        if($rta['respuesta']){
            $respuesta = true;
        }else{
            $respuesta  = false;
        }
        return $respuesta;
        
        
    } */

    /* public function crearNuevoestadoElegido(){
        $array = [];
        $objCompraestado = new Compraestado();
        //tengo objeto compra
        $array ['idcompra'] = $this->buscarKey('idcompra');
        $objCompra = new Compra();
        $objCompra->buscar($array);
        //tengo objeto compraestadotipo
        $arrayBusquedasT = [];
        $arrayBusquedasT ['idcompraestadotipo'] = $this->buscarKey('idcompraestadotipo');
        $objCompraestadotipo = new Compraestadotipo();
        $objCompraestadotipo->buscar($arrayBusquedasT);
        //cargo el nuevo compraestado con el estadotipo nuevo
        $objCompraestado->cargar($objCompra, $objCompraestadotipo);
        $rta = $objCompraestado->insertar();
        if($rta){
            $respuesta ['respuesta'] = true;
        }else{
            $respuesta ['respuesta'] = false;
        }
        
        return $respuesta;
    } */


    //HACER FUNCION PARA RESTAR LA CANTIDAD DE PRODUCTOS.
    //tengo que traer la compra, el compraitem y producto
    public function cambiarStocksegunEstado($objCompraestado)
    {
        //buscar el valor de la key enviada cmo compraestadotipo
        $data = Data::buscarKey('idcompraestadotipo');
        //obtengo el obj compra que tiene el objeto
        $objCompra = $objCompraestado->getObjCompra();
        //obtengo el obj estadotipo que tiene sin el cambio
        //$estadotipoObj = $objCompraestado->getObjCompraestadotipo();
        //obtengo el id de la compra
        $idCompra = $objCompra->getIdcompra();
        //hacemos bandera
        $respuesta = [];
        //creo un array para realizar la bsuqueda de eso en el parametro en compraitem
        $array = [];
        $array['idcompra'] = $idCompra;
        //$objCompraitem = new Compraitem();
        $arraycompraitem = Compraitem::listar($array);
        if (array_key_exists('array', $arraycompraitem)) {
            $listaCompraitem = $arraycompraitem['array'];
            foreach ($listaCompraitem as $key => $value) {
                $objCompraitem = $value;
                $cantidadComprada = $objCompraitem->getCicantidad();
                $producto = $objCompraitem->getObjProducto();
                $cantidadtotal = $producto->getProCantStock();
                if ($data == "2") {
                    if ($cantidadtotal > $cantidadComprada) {
                        $totalyn = $cantidadtotal - $cantidadComprada;
                        $producto->setProCantStock($totalyn);
                        $respuesta['respuesta'] = true;
                    } else {
                        $mensaje = "Tiene stock insuficiente";
                        $respuesta['mensaje'] = $mensaje;
                        $respuesta['respuesta'] = false;
                    }
                } elseif ($data == 4) {
                    //hacer que vuelva a sumar el stock
                    $totalito = $cantidadtotal + $cantidadComprada;
                    $producto->setProCantStock($totalito);
                    $respuesta['respuesta'] = true;
                } elseif ($data == 3) {
                    //se deja igual el stock pero se envia true para que siga el proceso
                    $respuesta['respuesta'] = true;
                } else {
                    $mensaje = "Debe cambiar el estado tipo";
                    $respuesta['mensaje'] = $mensaje;
                    $respuesta['respuesta'] = false;
                }
            }
        } else {
            $respuesta['respuesta'] = false;
            $respuesta['mensaje'] = "No existen items en su compra";
        }
        return $respuesta;
    }

    public function modificarEstado($idcompraestado, $idcompraestadotipo)
    {

        $objCompraEstado = new Compraestado();
        $arrBusCompraEstado['idcompraestado'] = $idcompraestado;
        $rta = $objCompraEstado->buscar($arrBusCompraEstado);
        if ($rta['respuesta']) {
            //cambio de estado
            $objCompraestadotipo = new Compraestadotipo();
            $arrB['idcompraestadotipo'] = $idcompraestadotipo;
            $objCompraestadotipo->buscar($arrB);
            //$objCompraEstado->setObjCompraestadotipo($objCompraestadotipo);
            $bandera = $objCompraEstado->modificar();
            if ($bandera['respuesta']) {
                $respuesta = true;
                $objCompraEstado->setObjCompraestadotipo($objCompraestadotipo);
                $objCompraEstado->insertar();
            } else {
                $respuesta = false;
            }
        } else {
            $respuesta = false;
        }
        return $respuesta;
    }

    public function verificar($idCompraEstado, $idCompraEstadoTipoPorParametro)
    {
        if ($idCompraEstado != NULL || $idCompraEstado != false) {
            $rta = $this->buscarId($idCompraEstado);
            if (array_key_exists('obj', $rta)) {
                $objCompraEstado = $rta['obj'];
                if ($objCompraEstado->getCefechafin() == 'NULL' || $objCompraEstado->getCefechafin() == NULL) {
                    $objCompraEstadoTipoActual = $objCompraEstado->getObjCompraestadotipo();
                    $idCompraEstadoTipoActual = $objCompraEstadoTipoActual->getIdcompraestadotipo();
                    if ($idCompraEstadoTipoActual != $idCompraEstadoTipoPorParametro) {
                        if ($idCompraEstadoTipoPorParametro == '2' || $idCompraEstadoTipoPorParametro == 2) {
                            $objCompra = $objCompraEstado->getObjCompra();
                            $idCompra = $objCompra->getIdcompra();
                            $objUsuario = $objCompra->getObjUsuario();
                            $mail = $objUsuario->getUsmail();
                            $objCompraItemCon = new CompraitemController();
                            $arrBusIdCompra['idcompra'] = $idCompra;
                            $listaCarrito = $objCompraItemCon->listarTodo($arrBusIdCompra);
                            $banderaSePuedeDescontar = false;
                            foreach ($listaCarrito as $key => $value) {
                                $cicantidad = $value->getCicantidad();
                                $objProducto = $value->getObjproducto();
                                $stock = $objProducto->getProCantStock();
                                if ($cicantidad > $stock) {
                                    $banderaSePuedeDescontar = true;
                                }
                            }
                            if (!$banderaSePuedeDescontar) {
                                // A descontar stock
                                foreach ($listaCarrito as $key => $value) {
                                    $cicantidad = $value->getCicantidad();
                                    $objProducto = $value->getObjProducto();
                                    $stock = $objProducto->getProCantStock();
                                    $nuevoStock = $stock - $cicantidad;
                                    $rta = $objProducto->setProCantStock($nuevoStock);
                                    $rta = $objProducto->modificar(); // no lo modifica - sql error
                                }
                                $idcompraestadotipo = 2;
                                $rta = $this->modificarEstado($idCompraEstado, $idcompraestadotipo);
                                if ($rta) {
                                    $respuesta = true;
                                    Mail::enviarMail($mail, 'Su compra ha pasado al estado de "Aceptada".');
                                } else {
                                    $respuesta = false;
                                }
                            } else {
                                $respuesta = false;
                                $mensaje = 'Un producto supera el stock';
                            }
                        } elseif ($idCompraEstadoTipoPorParametro == '4' || $idCompraEstadoTipoPorParametro == 4 || $idCompraEstadoTipoPorParametro == '1' || $idCompraEstadoTipoPorParametro == 1) {
                            // Cancelada, devuelve stock.
                            $objCompra = $objCompraEstado->getObjCompra();
                            $idCompra = $objCompra->getIdcompra();
                            $objUsuario = $objCompra->getObjUsuario();
                            $mail = $objUsuario->getUsmail();
                            $objCompraItemCon = new CompraitemController();
                            $arrBusIdCompra['idcompra'] = $idCompra;
                            $listaCarrito = $objCompraItemCon->listarTodo($arrBusIdCompra);
                            $banderaSePuedeSumar = false;
                            foreach ($listaCarrito as $key => $value) {
                                $cicantidad = $value->getCicantidad();
                                $objProducto = $value->getObjproducto();
                                $stock = $objProducto->getProCantStock();
                                if ($cicantidad < $stock) {
                                    $banderaSePuedeSumar = true;
                                }
                            }
                            if ($banderaSePuedeSumar) {
                                // A sumar stock
                                foreach ($listaCarrito as $key => $value) {
                                    $cicantidad = $value->getCicantidad();

                                    $objProducto = $value->getObjProducto();
                                    $stock = $objProducto->getProCantStock();

                                    /* if( $stock >= $cicantidad ){
                                    $nuevoStock = $stock;
                                 } else { */
                                    $nuevoStock = $stock + $cicantidad;
                                    //}
                                    $objProducto->setProCantStock($nuevoStock);
                                    $rta = $objProducto->modificar(); // no lo modifica - sql error
                                }
                                // Cambiar estado tupla y generar una nueva de compraestado; 5
                                if ($idCompraEstadoTipoPorParametro == '4' || $idCompraEstadoTipoPorParametro == 4) {
                                    $idcompraestadotipo = 4;
                                    $contenido = 'Su compra ha pasado al estado de "Cancelada".';
                                } else {
                                    $idcompraestadotipo = 1;
                                    $contenido = 'Su compra ha pasado al estado de "Iniciada",';
                                }
                                //$idCompraEstado = $objCompraEstadoCon->buscarKey( 'idcompraestado' );
                                $idCompraEstado = Data::buscarKey('idcompraestado');
                                $rta = $this->modificarEstado($idCompraEstado, $idcompraestadotipo);
                                if ($rta) {
                                    $respuesta = true;
                                    //envio de mail
                                    Mail::enviarMail($mail, $contenido);
                                } else {
                                    $respuesta = false;
                                }
                            } else {
                                $respuesta = false;
                                $mensaje = 'Ha ocurrido un error.';
                            }
                        } else {
                            //cambio de estado solamente 5
                            if ($idCompraEstadoTipoPorParametro == 3) {
                                //$idcompraestado = $this->getIdcompraestado();
                                $objCompra = $objCompraEstado->getObjCompra();
                                $idCompra = $objCompra->getIdcompra();
                                $objUsuario = $objCompra->getObjUsuario();
                                $mail = $objUsuario->getUsmail();
                                $idcompraestadotipo = 3;
                                $rsss = $this->modificarEstado($idCompraEstado, $idcompraestadotipo);
                                //envio de mail
                                Mail::enviarMail($mail, 'Su compra ha pasado al estado de "Enviada".');
                                $respuesta = true;
                            }/*elseif($idCompraEstadoTipoPorParametro == 4){
                            $idcompraestado = $objCompraEstado->getIdcompraestado();
                            $idcompraestadotipo = 4;
                            $objCompra = new Compra();
                            $objCompra->buscar(array('idcompra' => $idcompraestado));
                            $objUsuario = $objCompra->getObjUsuario();
                            $mail = $objUsuario->getUsmail();
                            $rsss = $this->modificarEstado($idCompraestado, $idcompraestadotipo);
                            //envio de mail
                        }*/
                        }
                    }else{
                        $respuesta = false;
                        $mensaje = 'La compra ya posee ese estado';
                    }
                    
                } else {
                        $respuesta = false;
                        $mensaje = 'Solo se puede actualizar seleccionando una compra sin fecha fin';
                }
            } else {
                $respuesta = false;
                $mensaje = 'No se encontro el obj compra estado';
            }
        } else {
            $respuesta = false;
            $mensaje = 'No se encontro el obj compra estado';
        }
            $retorno[0] = $respuesta;
            if (isset($mensaje)) {
                $retorno[1] = $mensaje;
            }
            return $retorno;
    }
    
}
