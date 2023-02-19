<?php
require_once( '../templates/header.php');

$objUsuario = new UsuarioController();
$objUsuarioRol = new UsuarioRolController();

$data = $objUsuario->getDatos();

$respuesta = $objUsuario->insertar();
if( $respuesta['respuesta'] ){
    echo('Usuario creado piolon');
    ?>
    <script>
        location.href = 'TPfinalDinamica/Views/logs/login.php';
    </script>
    <?php
} else {
    echo('Usuario creado pa la wea');
}