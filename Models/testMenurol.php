<?php
require_once('../config.php');

$menurol = new Menurol();
$menu = new Menu();
$rol = new Rol();
$busc = [];
$busc['idmenu'] = 18;
$rt = $menu->buscar($busc);



$busc1 = [];
$busc1['idrol'] = 2;
$rta = $rol->buscar($busc1);





//insertar FUNCA
/*
$cha = $menurol->insertar();
*/

//BUSCAR FUNCA
$busc2 = [];
$busc2['idmr'] = 3;
$cha = $menurol->buscar($busc2);
/*echo "<pre>";

var_dump($menurol);
echo "</pre>";
die();
*/
/*
$menurol->cargar($menu, $rol);


//MODIFICAR FUNCA
$cha = $menurol->modificar();

if($cha['respuesta']){
    echo "lala";
    //print_r($menurol);
}else{
    echo "papa";
    echo $cha['errorInfo'];
}*/

//ELIMINAR FUNCA
$fue = $menurol->eliminar();
if($fue){
    echo "se pudo guachin";
}else{
    echo "estudia mas, chabon";
}

