<?php

class MasterController {
    
    // Uso el trait de data
    use Data;

    // Traigo datos de get/post
    public function getDatos(){
        $datos = $this->data();
        return $datos;
    }

    //Funcion para buscar la key
    public function buscarKey( $key ){
        $datos = $this->getDatos();
        $post = $datos['POST'];
        $get = $datos['GET'];
        if( array_key_exists($key, $post) ){
            $respuesta = $post[$key];
        } elseif( array_key_exists($key, $get) ){
            $respuesta = $get[$key];
        } else {
            $respuesta = false;
        }
        return $respuesta;
    }


    public function comprobarMateria($usuario){
        $conn = new db();
        //busqueda en si
        $sql = "SELECT materia FROM profesor WHERE usuario = '$usuario'";
        $materiaDada = null;   
        if($conn->Iniciar()){
            $conn->Ejecutar($sql);
            if($row2 = $conn->Registro()){
                if($row2['materia'] != null && $row2['materia'] != ''){
                    $materiaDada = $row2['materia'];
                }
                
            }
        }
        $conn = null;
        return $materiaDada;
    }

    public function getSlashesImg() {
        if( isset($_POST) && count($_POST) >= 0 ){
            $imagen = $_FILES['foto']['tmp_name'];
            $foto = addslashes( file_get_contents($imagen) );
        }
        return $foto;
    }
}