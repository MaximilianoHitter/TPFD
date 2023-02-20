<?php
class ProductoController extends MasterController{
    use Errores;

    /* public function busqueda(){
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
    } */

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

    public function buscarId($idproducto){
        $respuesta['respuesta'] = false;
        $respuesta['obj'] = null;
        $respuesta['error'] = '';
        $arrayBusqueda = [];
        $arrayBusqueda['idproducto'] = $idproducto;
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

    public function insertar($data){
        //$data = $this->busqueda();
        $objProducto = new Producto();
        $objProducto->setProNombre( $data['pronombre'] );
        $objProducto->setSinopsis( $data['sinopsis'] );
        $objProducto->setProCantStock( $data['procantstock'] );
        $objProducto->setAutor( $data['autor'] );
        $objProducto->setPrecio( $data['precio'] );
        $objProducto->setIsbn( $data['isbn'] );
        $objProducto->setCategoria( $data['categoria'] );
        $objProducto->setFoto( $data['foto'] );
        
        $rta = $objProducto->insertar();
        return $rta;
    }

    public function modificar($idproducto, $valores){
        $rta = $this->buscarId($idproducto);
        //var_dump($rta);
        $response = false;
        if($rta['respuesta']){
            //puedo modificar con los valores
            //$valores = $this->busqueda();
            $objProducto = $rta['obj'];
            $valores['foto'] = '';
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

    public function eliminar($idproducto){
        $rta = $this->buscarId($idproducto);
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