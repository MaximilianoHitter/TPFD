<?php
require_once('../config.php');
$objMenuCon = new MenuController();
//prueba de menues por rol.. admin 
$rta = $objMenuCon->obtenerMenuesPorRol(1);
echo "<pre>";
var_dump($rta);
echo "</pre>";