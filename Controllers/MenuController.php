<?php
class MenuController extends MasterController
{
    use Errores;

    public function listarTodo($arralgo = NULL)
    {
        if ($arralgo == NULL) {
            $arrBu = [];
        } else {
            $arrBu = $arralgo;
        }
        //$arrayBus['medeshabilitado'] = NULL;
        $arrayTotal = Menu::listar($arrBu);
        if (array_key_exists('array', $arrayTotal)) {
            $array = $arrayTotal['array'];
        } else {
            $array = [];
        }
        return $array;
    }

    public function listar_menu_padre()
    {
        $idmenu = Data::buscarKey('idmenu');
        $array = Menu::darMenuesSinMenu($idmenu);
        return $array;
    }

    /*  public function busqueda(){
        $arrayBusqueda = [];
        $idmenu = $this->buscarKey('idmenu');
        $menombre = $this->buscarKey('menombre');
        $medescripcion = $this->buscarKey('medescripcion');
        $idpadre = $this->buscarKey('idpadre');
        $medeshabilitado = $this->buscarKey('medeshabilitado');
        $arrayBusqueda = ['idmenu' => $idmenu,
                          'menombre' => $menombre,
                          'medescripcion' => $medescripcion,
                          'idpadre' => $idpadre,
                          'medeshabilitado' => $medeshabilitado];
        //var_dump($arrayBusqueda);
        return $arrayBusqueda;
    } */

    public function insertar($data)
    {
        //$data = $this->busqueda();
        $objMenu = new Menu();
        $objMenu->setIdmenu(NULL);
        $objMenu->setMenombre($data['menombre']);
        $objMenu->setMedescripcion($data['medescripcion']);
        $objPadre = new Menu();
        $arrayBus['idmenu'] = $data['idpadre'];
        $objPadre->buscar($arrayBus);
        $objMenu->setObjPadre($objPadre);
        $objMenu->setMedeshabilitado(NULL);
        //var_dump($objMenu);
        $rta = $objMenu->insertar();
        //var_dump($rta);
        return $rta;
    }

    public function modificar($idmenu, $valores)
    {
        $rta = $this->buscarId($idmenu);
        $response = false;
        if ($rta['respuesta']) {
            //puedo modificar con los valores
            //$valores = $this->busqueda();
            $objMenu = $rta['obj'];
            $objMenu->cargar($valores['menombre'], $valores['medescripcion'], $valores['idpadre']);
            $rsta = $objMenu->modificar();
            if ($rsta['respuesta']) {
                //todo gut
                $response = true;
            }
        }
        return $response;
    }

    public function buscarId($idmenu)
    {
        $respuesta['respuesta'] = false;
        $respuesta['obj'] = null;
        $respuesta['error'] = '';
        $arrayBusqueda = [];
        $arrayBusqueda['idmenu'] = $idmenu;
        $objMenu = new Menu();
        $rta = $objMenu->buscar($arrayBusqueda);
        if ($rta['respuesta']) {
            $respuesta['respuesta'] = true;
            $respuesta['obj'] = $objMenu;
        } else {
            $respuesta['error'] = $rta;
        }
        return $respuesta;
    }

    public function eliminar($idmenu)
    {
        $rta = $this->buscarId($idmenu);
        $response = false;
        if ($rta['respuesta']) {
            $objMenu = $rta['obj'];
            $respEliminar = $objMenu->eliminar();
            if ($respEliminar['respuesta']) {
                $response = true;
            }
        } else {
            //no encontro el obj
            $response = false;
        }
        return $response;
    }

    public function Noeliminar($idmenu)
    {
        $rta = $this->buscarId($idmenu);
        $response = false;
        if ($rta['respuesta']) {
            $objMenu = $rta['obj'];
            $respEliminar = $objMenu->Noeliminar();
            if ($respEliminar['respuesta']) {
                $response = true;
            }
        } else {
            //no encontro el obj
            $response = false;
        }
        return $response;
    }

    public function getRoles()
    {
        $arrayBus = [];
        $listaRoles = Rol::listar($arrayBus);
        return $listaRoles['array'];
    }

    public function obtenerMenuesPorRol($idrol)
    {
        $arrayBu['idrol'] = $idrol;
        $arrayMenues = Menurol::listar($arrayBu);
        $arrayRepasado = [];
        foreach ($arrayMenues['array'] as $key => $value) {
            $objMenurol = $value;
            $datos = $objMenurol->dameDatosMenues();
            array_push($arrayRepasado, $datos);
        }
        //return $arrayRepasado;

        $arrayRta = [];
        $arrayRta['Home'] = [];
        $arrayPadres = [];
        $arrayHijos = [];
        foreach ($arrayRepasado as $key => $value) {
            $datosMenu = $value['idmenu'];
            $idpadre = $datosMenu['idpadre'];
            if ($idpadre != 0) {
                $nombreMenu = $datosMenu['menombre'];
                if (!isset($arrayHijos[$idpadre])) {
                    $arrayHijos[$idpadre] = [];
                    array_push($arrayHijos[$idpadre], $nombreMenu);
                } else {
                    array_push($arrayHijos[$idpadre], $nombreMenu);
                }
            }
        }
        //return $arrayHijos;
        foreach ($arrayRepasado as $key => $value) {
            $datosMenu = $value['idmenu'];
            $idpadre = $datosMenu['idpadre'];
            $idmenu = $datosMenu['idmenu'];
            if ($idpadre == 0) {
                $nombreMenu = $datosMenu['menombre'];
                array_push($arrayPadres, $nombreMenu);
                if (array_key_exists($idmenu, $arrayHijos)) {
                    $hijos = $arrayHijos[$idmenu];
                    if (!isset($arrayPadres[$nombreMenu])) {
                        $arrayPadres[$nombreMenu] = $hijos;
                    } else {
                        array_push($arrayPadres[$nombreMenu], $hijos);
                    }
                } else {
                    $arr = [];
                    $arrayPadres[$nombreMenu] = $arr;
                    //array_push($arrayPadres[$nombreMenu], $arr);
                }
            }
        }

        return $arrayPadres;
        foreach ($arrayPadres as $key => $value) {
            array_push($arrayRta['Home'], $value);
        }

        return $arrayRta;




        //return $arrayMenues;
        //var_dump($arrayMenues['array']);
        //convertir y traer todos los menues
        if (array_key_exists('array', $arrayMenues)) {
            $arrayRta = [];
            $arrayRta['Home'] = [];
            foreach ($arrayMenues['array'] as $key => $value) {
                $objMenu = $value->getObjMenu();
                $PadreObj = $objMenu->getObjPadre();
                if ($PadreObj == NULL || $PadreObj->getIdmenu() == 0) {
                    $nombreMenu = $objMenu->getMenombre();
                    $arr = [];
                    $arr[$nombreMenu] = [];
                    //var_dump($objMenu);
                    array_push($arrayRta['Home'], $arr);
                }
            }
            //var_dump($arrayRta);
            //return $arrayRta;
            //hasta aca funca

            foreach ($arrayRta['Home'] as $key => $value) {
                $arrPadrito = $value;
                foreach ($arrPadrito as $llave => $valor) {
                    $nombrePadre = $valor;
                    foreach ($arrayMenues['array'] as $key => $value) {
                        $objMenu = $value->getObjMenu();
                        $objPadre = $objMenu->getObjpadre();
                        try {
                            $nombrePapa = $objPadre->getMenombre();
                        } catch (\Throwable $th) {
                            $nombrePapa = 0;
                        }
                        if ($nombrePapa != 0) {
                            if ($nombrePadre == $nombrePapa) {
                                $nombreMenu = $objMenu->getMenombre();
                                array_push($arrayRta['Home'][$nombrePadre], $nombreMenu);
                            }
                        }
                    }
                }
            }
        } else {
            $arrayRta = ['nada'];
        }
        return $arrayRta;
    }

    public function getLink($paramMeNombre)
    {
        $objMenu = new Menu();
        $link = $objMenu->buscar($paramMeNombre['menombre']);
        return $link;
    }

    public function temaRoles($idmenu)
    {
        if ($idmenu != null) {
            $arraybus['idmenu'] = $idmenu;
            $rolesDeMenu = Menurol::listar($arraybus);
            if ($rolesDeMenu['respuesta']) {
                if (count($rolesDeMenu['array']) > 0) {
                    foreach ($rolesDeMenu['array'] as $key => $value) {
                        $arrBus['idmr'] = $value->getIdmr();
                        $objMenurol = new Menurol();
                        $objMenurol->buscar($arrBus);
                        $objMenurol->eliminar();
                        $objMenurol = null;
                    }
                }
            }
            //cargar objeto de menu
            $objMenu = new Menu();
            $arrayDeBus['idmenu'] = $idmenu;
            $objMenu->buscar($arrayDeBus);
            //obtener los nuevos roles
            $arrayRoles = $this->getRoles();
            $rolesNuevos = [];
            $rolesSimple = [];
            if (count($arrayRoles) > 0) {
                foreach ($arrayRoles as $key => $value) {
                    $data = $value->dameDatos();
                    $idrol = $data['idrol'];
                    //$rolesSimple[$data['idrol']] = false;
                    //$guardarDato = $objMenuCon->buscarKey(("rol$idrol"));
                    $guardarDato = Data::buscarKey(("rol$idrol"));
                    //var_dump($guardarDato);
                    if ($guardarDato != null && $guardarDato == 'on') {
                        $rolesNuevos[$idrol] = $guardarDato;
                    }
                }
                //var_dump($rolesNuevos);
                //cargar los nuevos roles
                foreach ($rolesNuevos as $key => $value) {
                    $aBus['idrol'] = $key;
                    if ($value == 'on') {
                        $objRol = new Rol();
                        $objRol->buscar($aBus);
                        $objMenurol = new Menurol();
                        $objMenurol->cargar($objMenu, $objRol);
                        $objMenurol->insertar();
                        $objRol = null;
                        $objMenurol = null;
                    }
                }
                $respuesta = true;
            } else {
                $respuesta = false;
                $mensaje = 'No hay roles cargados';
            }
        } else {
            $respuesta = false;
            $mensaje = 'No se ha podido realizar la operacion';
        }
        $retorno[0] = $respuesta;
        if(isset($mensaje)){
            $retorno[1] = $mensaje;
        }
        return $retorno;
    }

    public function revisarMenuesHabilitados($menu){
        $menuAComprobar = $menu;
        $respuesta = true;
        $objMenu = new Menu();
        $objMenu->buscar(array('menombre'=>$menu));
        if($objMenu->getMedeshabilitado() != NULL ){
            $respuesta = false;
        }
        return $respuesta;
    }
}
