<?php
require_once('../config.php');
$compraestadotipo = new Compraestadotipo();
//insertar FUNCO
/* $compraestadotipo->cargar('', 'melapela', 'asdasdasd');
$rta = $compraestadotipo->insertar();
if($rta['respuesta']){
    echo "gut";
}else{
    var_dump($rta);
} */

//Buscar FUNCO
/* $arrayBusca['idcompraestadotipo'] = 5;
$rta = $compraestadotipo->buscar($arrayBusca);
if($rta['respuesta']){
    var_dump($compraestadotipo);
}else{
    var_dump($rta);
} */

//Modificar FUNCO
//$compraestadotipo->cargar('', 'bebe de mi copa', 'y seras eterno');
/* $compraestadotipo->setCetdescripcion('bebe de mi copa');
$compraestadotipo->setCetdetalle('y seras eterno');
$rta = $compraestadotipo->modificar();
if($rta['respuesta']){
    var_dump($compraestadotipo);
}else{
    var_dump($rta);
} */

/* $rta = $compraestadotipo->eliminar();
if($rta['respuesta']){
    var_dump($compraestadotipo);
}else{
    var_dump($rta);
} */
$arrayVcio = [];
$arrayVcio['idcompraestadotipo'] = 4;
$array = Compraestadotipo::listar($arrayVcio);
var_dump($array);