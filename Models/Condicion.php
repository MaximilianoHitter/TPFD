<?php
//HAY QUE CAMBIARLO
trait Condicion{

    //Metodo publico general
    public function SB($arrayBusqueda){
        $stringBusqueda = '';
        if(count($arrayBusqueda) > 0){
            foreach ($arrayBusqueda as $key => $value) {
                if($value != null || $key == 'usdeshabilitado' || $key == 'prdeshabilitado' || $key == 'medeshabilitado' || $key == 'cefechafin'){
                    if($key == 'usdeshabilitado' || $key == 'prdeshabilitado' || $key == 'medeshabilitado' || $key == 'cefechafin'){
                        $string = " $key IS NULL ";
                    }else{
                        $string = " $key = '$value' ";
                    }
                    if($stringBusqueda == ''){
                        $stringBusqueda.=$string;
                    }else{
                        $stringBusqueda.= ' and ';
                        $stringBusqueda.= $string;
                    }
                }
            }
        }        
        return $stringBusqueda;
    }

    //Metodo static general
    public static function SBS( $arrayBusqueda ){
        $stringBusqueda = '';
        if( is_countable($arrayBusqueda) > 0 ){
            if(!array_key_exists('sql', $arrayBusqueda)){
                foreach ($arrayBusqueda as $key => $value) {
                    if(($value != null && $value != '') || $key == 'usdeshabilitado' || $key == 'prdeshabilitado' || $key == 'medeshabilitado' || $key == 'cefechafin'){
                        if($key == 'usdeshabilitado' || $key == 'prdeshabilitado' || $key == 'medeshabilitado' || $key == 'cefechafin'){
                            $string = " $key IS NULL ";
                        }else{
                            $string = " $key = '$value' ";
                        }
                        if($stringBusqueda == ''){
                            $stringBusqueda.=$string;
                        }else{
                            $stringBusqueda.= ' and ';
                            $stringBusqueda.= $string;
                        }
                    }  
                }
            }else{
                $stringBusqueda = $arrayBusqueda['sql'];
            }
            
        }        
        return $stringBusqueda;
    }
    
    /* //Metodo publico de busqueda de compraestadotipo
    public function SBcompraestadotipo($arrayBusqueda){
        $stringBusqueda = '';
        if(array_key_exists('idcompraestadotipo', $arrayBusqueda) && $arrayBusqueda['idcompraestadotipo'] != null){
            //buscamos con idcompraestadotipo
            $idcompraestadotipo = $arrayBusqueda['idcompraestadotipo'];
            $string = " idcompraestadotipo = $idcompraestadotipo ";
            $stringBusqueda.=$string;
        }
        if(array_key_exists('cetdescripcion', $arrayBusqueda) && $arrayBusqueda['cetdescripcion'] != null){
            //buscamos con cetdescripcion
            $cetdescripcion = $arrayBusqueda['cetdescripcion'];
            $string = " cetdescripcion = '$cetdescripcion' ";
            if($stringBusqueda == ''){
                $stringBusqueda.=$string;
            }else{
                $stringBusqueda.= ' and ';
                $stringBusqueda.= $string;
            }
        }
        if(array_key_exists('cetdetalle', $arrayBusqueda) && $arrayBusqueda['cetdetalle'] != null){
            //buscamos con cetdetalle
            $cetdetalle = $arrayBusqueda['cetdetalle'];
            $string = " cetdetalle = '$cetdetalle' ";
            if($stringBusqueda == ''){
                $stringBusqueda.=$string;
            }else{
                $stringBusqueda.= ' and ';
                $stringBusqueda.= $string;
            }
        }
        return $stringBusqueda;
    }

    //Metodo statico de busqueda de compraestadotipo
    public static function SBScompraestadotipo($arrayBusqueda){
        $stringBusqueda = '';
        if(array_key_exists('idcompraestadotipo', $arrayBusqueda) && $arrayBusqueda['idcompraestadotipo'] != null){
            //buscamos con idcompraestadotipo
            $idcompraestadotipo = $arrayBusqueda['idcompraestadotipo'];
            $string = " idcompraestadotipo = $idcompraestadotipo ";
            $stringBusqueda.=$string;
        }
        if(array_key_exists('cetdescripcion', $arrayBusqueda) && $arrayBusqueda['cetdescripcion'] != null){
            //buscamos con cetdescripcion
            $cetdescripcion = $arrayBusqueda['cetdescripcion'];
            $string = " cetdescripcion = '$cetdescripcion' ";
            if($stringBusqueda == ''){
                $stringBusqueda.=$string;
            }else{
                $stringBusqueda.= ' and ';
                $stringBusqueda.= $string;
            }
        }
        if(array_key_exists('cetdetalle', $arrayBusqueda) && $arrayBusqueda['cetdetalle'] != null){
            //buscamos con cetdetalle
            $cetdetalle = $arrayBusqueda['cetdetalle'];
            $string = " cetdetalle = '$cetdetalle' ";
            if($stringBusqueda == ''){
                $stringBusqueda.=$string;
            }else{
                $stringBusqueda.= ' and ';
                $stringBusqueda.= $string;
            }
        }
        return $stringBusqueda;
    }

    //Metodo publico de busqueda de rol
    public function SBrol($arrayBusqueda){
        $stringBusqueda = '';
        if(array_key_exists('idrol', $arrayBusqueda) && $arrayBusqueda['idrol'] != null){
            //Busqueda por idrol
            $idRol = $arrayBusqueda['idrol'];
            $string = " idrol = $idRol ";
            $stringBusqueda.=$string;
        }
        if(array_key_exists('rodescripcion', $arrayBusqueda) && $arrayBusqueda['rodescripcion'] != null){
            //Busqueda por rodescripcion
            $rodescripcion = $arrayBusqueda['rodescripcion'];
            $string = " rodescripcion = '$rodescripcion' ";
            if($stringBusqueda == ''){
                $stringBusqueda.=$string;
            }else{
                $stringBusqueda.= ' and ';
                $stringBusqueda.= $string;
            }
        }
        return $stringBusqueda;
    }

    //Metodo static de busqueda de rol
    public static function SBSrol($arrayBusqueda){
        $stringBusqueda = '';
        if(array_key_exists('idrol', $arrayBusqueda) && $arrayBusqueda['idrol'] != null){
            //Busqueda por idrol
            $idRol = $arrayBusqueda['idrol'];
            $string = " idrol = $idRol ";
            $stringBusqueda.=$string;
        }
        if(array_key_exists('rodescripcion', $arrayBusqueda) && $arrayBusqueda['rodescripcion'] != null){
            //Busqueda por rodescripcion
            $rodescripcion = $arrayBusqueda['rodescripcion'];
            $string = " rodescripcion = '$rodescripcion' ";
            if($stringBusqueda == ''){
                $stringBusqueda.=$string;
            }else{
                $stringBusqueda.= ' and ';
                $stringBusqueda.= $string;
            }
        }
        return $stringBusqueda;
    }

    //Metodo publico de busqueda de usuario
    public function SBusuario($arrayBusqueda){
        $stringBusqueda = '';
        if(array_key_exists('idusuario', $arrayBusqueda) && $arrayBusqueda['idusuario'] != null){
            //Buscamos por idusuario
            $idusuario = $arrayBusqueda['idusuario'];
            $string = " idusuario = $idusuario ";
            $stringBusqueda.=$string;
        }
        if(array_key_exists('usnombre', $arrayBusqueda) && $arrayBusqueda['usnombre'] != null){
            //Buscamos por usnombre
            $usnombre = $arrayBusqueda['usnombre'];
            $string = " usnombre = '$usnombre' ";
            if($stringBusqueda == ''){
                $stringBusqueda.=$string;
            }else{
                $stringBusqueda.= ' and ';
                $stringBusqueda.= $string;
            }
        }
        if(array_key_exists('uspass', $arrayBusqueda) && $arrayBusqueda['uspass'] != null){
            //Buscamos por uspass
            $uspass = $arrayBusqueda['uspass'];
            $string = " uspass = '$uspass' ";
            if($stringBusqueda == ''){
                $stringBusqueda.=$string;
            }else{
                $stringBusqueda.= ' and ';
                $stringBusqueda.= $string;
            }
        }
        if(array_key_exists('usmail', $arrayBusqueda) && $arrayBusqueda['usmail'] != null){
            //Buscamos por usmail
            $usmail = $arrayBusqueda['usmail'];
            $string = " usmail = '$usmail' ";
            if($stringBusqueda == ''){
                $stringBusqueda.=$string;
            }else{
                $stringBusqueda.= ' and ';
                $stringBusqueda.= $string;
            }
        }
        if(array_key_exists('usdeshabilitado', $arrayBusqueda)){
            //Buscamos por usdeshabilitado
            $usdeshabilitado = $arrayBusqueda['usdeshabilitado'];
            if($usdeshabilitado == NULL){
                //Buscamos usuarios con null
                $string = " usdeshabilitado = NULL ";
            }else{
                $string = " usdeshabilitado != NULL ";
            }
            if($stringBusqueda == ''){
                $stringBusqueda.=$string;
            }else{
                $stringBusqueda.= ' and ';
                $stringBusqueda.= $string;
            }
        }
        return $stringBusqueda;
    }

    //Metodo static de busqueda de usuario
    public static function SBSusuario($arrayBusqueda){
        $stringBusqueda = '';
        if(array_key_exists('idusuario', $arrayBusqueda) && $arrayBusqueda['idusuario'] != null){
            //Buscamos por idusuario
            $idusuario = $arrayBusqueda['idusuario'];
            $string = " idusuario = $idusuario ";
            $stringBusqueda.=$string;
        }
        if(array_key_exists('usnombre', $arrayBusqueda) && $arrayBusqueda['usnombre'] != null){
            //Buscamos por usnombre
            $usnombre = $arrayBusqueda['usnombre'];
            $string = " usnombre = '$usnombre' ";
            if($stringBusqueda == ''){
                $stringBusqueda.=$string;
            }else{
                $stringBusqueda.= ' and ';
                $stringBusqueda.= $string;
            }
        }
        if(array_key_exists('uspass', $arrayBusqueda) && $arrayBusqueda['uspass'] != null){
            //Buscamos por uspass
            $uspass = $arrayBusqueda['uspass'];
            $string = " uspass = '$uspass' ";
            if($stringBusqueda == ''){
                $stringBusqueda.=$string;
            }else{
                $stringBusqueda.= ' and ';
                $stringBusqueda.= $string;
            }
        }
        if(array_key_exists('usmail', $arrayBusqueda) && $arrayBusqueda['usmail'] != null){
            //Buscamos por usmail
            $usmail = $arrayBusqueda['usmail'];
            $string = " usmail = '$usmail' ";
            if($stringBusqueda == ''){
                $stringBusqueda.=$string;
            }else{
                $stringBusqueda.= ' and ';
                $stringBusqueda.= $string;
            }
        }
        if(array_key_exists('usdeshabilitado', $arrayBusqueda)){
            //Buscamos por usdeshabilitado
            $usdeshabilitado = $arrayBusqueda['usdeshabilitado'];
            if($usdeshabilitado == NULL){
                //Buscamos usuarios con null
                $string = " usdeshabilitado = NULL ";
            }else{
                $string = " usdeshabilitado != NULL ";
            }
            if($stringBusqueda == ''){
                $stringBusqueda.=$string;
            }else{
                $stringBusqueda.= ' and ';
                $stringBusqueda.= $string;
            }
        }
        return $stringBusqueda;
    }
 */
}