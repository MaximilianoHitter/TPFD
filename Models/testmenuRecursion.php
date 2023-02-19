<?php
require_once('../config.php');
/*$menuPadre = new Menu();
$menuPadre->cargar('', 'Padre', 'Pa ver si recursiona', NULL, NULL);
$rta = $menuPadre->insertar();
if($rta['respuesta']){
    echo "Funco el padre";
}else{
    var_dump($rta['errorInfo']);
} */

/* $menuPadre = new Menu();
$arrayBus['idmenu'] = 12;
$menuPadre->buscar($arrayBus);

$menuConPadre = new Menu ();
$menuConPadre->cargar('', 'Hijo', 'Es el hijo', $menuPadre, NULL);
$rta = $menuConPadre->insertar();
if($rta['respuesta']){
    echo "funco hijo";
}else{
    var_dump($rta['errorInfo']);
} */

$menuPadre = new Menu();
$arrayBus['idmenu'] = 12;
$menuPadre->buscar($arrayBus);
echo "\nMENU PADRE\n";
var_dump($menuPadre);

$menuConPadre = new Menu ();
$arrayBus['idmenu'] = 13;
$menuConPadre->buscar($arrayBus);
echo "\nMENU HIJO\n";
var_dump($menuConPadre);

$menuNieto = new Menu();
//$menuNieto->cargar('', 'Nieto', 'El hijo del hijo del padre', $menuConPadre, NULL);
$arrayBus['idmenu'] = 14;
$menuNieto->buscar($arrayBus);
//$menuNieto->insertar();
echo "\nMENU NIETO\n";
var_dump($menuNieto);

/* $arrayBus = [];
$rta = Menu::listar($arrayBus);
if($rta['respuesta']){
    var_dump($rta['array'][8]);
}else{
    var_dump($rta['errorInfo']);
} */