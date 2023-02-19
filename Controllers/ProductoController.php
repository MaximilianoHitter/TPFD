<?php
class ProductoController extends MasterController{
    use Errores;

    public function busqueda(){
        $arrayBusqueda = [];
        $idproducto = $this->buscarKey('idproducto');
        $pronombre = $this->buscarKey('pronombre');
        $sinopsis = $this->buscarKey('sinopsis');
        $procantstock = $this->buscarKey('procantstock');
        $autor = $this->buscarKey('autor');
        $precio = $this->buscarKey('precio');
        $isbn = $this->buscarKey('isbn');
        $categoria = $this->buscarKey('categoria');

        //$foto = $this->getSlashesImg();
        $foto = '';

        $prdeshabilitado = $this->buscarKey('prdeshabilitado');
        $arrayBusqueda = [
            'idproducto' => $idproducto,
            'pronombre' => $pronombre,
            'sinopsis' => $sinopsis,
            'procantstock' => $procantstock,
            'autor' => $autor,
            'precio' => $precio,
            'isbn' => $isbn,
            'categoria' => $categoria,
            'foto' => $foto,
            'prdeshabilitado' => $prdeshabilitado];
        return $arrayBusqueda;
    }

    public function listarTodo($array){
        //$arrayBusqueda = $this->busqueda();
        if(empty($array)){
            $arrayBusqueda = [];
            $arrayTotal = Producto::listar($arrayBusqueda);
            if(array_key_exists('array', $arrayTotal)){
                $array = $arrayTotal['array'];
            }else{
                $array = [];
            }
        }else{
            $arrayTotal = Producto::listar($array);
            if(array_key_exists('array', $arrayTotal)){
                $array = $arrayTotal['array'];
            }else{
                $array = [];
            }

        }
        
        //var_dump($array);
        return $array;        
    }

    public function buscarId(){
        $respuesta['respuesta'] = false;
        $respuesta['obj'] = null;
        $respuesta['error'] = '';
        $arrayBusqueda = [];
        $arrayBusqueda['idproducto'] = $this->buscarKey('idproducto');
        $objProducto = new Producto();
        $rta = $objProducto->buscar($arrayBusqueda);
        if($rta['respuesta']){
            $respuesta['respuesta'] = true;
            $respuesta['obj'] = $objProducto;
        }else{
            $respuesta['error'] = $rta;
        }
        return $respuesta;        
    }

    public function insertar(){
        $data = $this->busqueda();
        $objCompra = new Producto();
        $objCompra->setProNombre( $data['pronombre'] );
        $objCompra->setSinopsis( $data['sinopsis'] );
        $objCompra->setProCantStock( $data['procantstock'] );
        $objCompra->setAutor( $data['autor'] );
        $objCompra->setPrecio( $data['precio'] );
        $objCompra->setIsbn( $data['isbn'] );
        $objCompra->setCategoria( $data['categoria'] );
        $objCompra->setFoto( $data['foto'] );
        
        $rta = $objCompra->insertar();
        return $rta;
    }

    public function modificar(){
        $rta = $this->buscarId();
        //var_dump($rta);
        $response = false;
        if($rta['respuesta']){
            //puedo modificar con los valores
            $valores = $this->busqueda();
            $objProducto = $rta['obj'];
            $objProducto->cargar($valores['sinopsis'], $valores['pronombre'], $valores['procantstock'], $valores['autor'], $valores['precio'], $valores['isbn'], $valores['categoria'], $valores['foto']);
            $rsta = $objProducto->modificar();
            if($rsta['respuesta']){
                //todo gut
                $response = true;
            }
        }else{
            //no encontro el obj
            $response = false;
        }
        return $response;
    }

    public function eliminar(){
        $rta = $this->buscarId();
        $response = false;
        if($rta['respuesta']){
            $objProducto = $rta['obj'];
            $respEliminar = $objProducto->eliminar();
            if($respEliminar['respuesta']){
                $response = true;
            }
        }else{
            //no encontro el obj
            $response = false;
        }
        return $response;
    }

    public function obtenerStockPorId($idproducto){
        $arrBus = [];
        $arrBus['idproducto'] = $idproducto;
        $objProducto = new Producto();
        $rta = $objProducto->buscar($arrBus);
        if($rta['respuesta']){
            $respuesta = $objProducto->getProCantStock();
        }else{
            $respuesta = false;
        }
        return $respuesta;
    }
}