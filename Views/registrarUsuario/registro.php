<?php
    require_once('../templates/header.php');
    require_once('../../Models/conector/db.php');
?>

<div class= "yo">
            
        <form class= "registracion" action="" method="">
                <h3>Formulario de Registración</h3><br><br>
                <span>Usuario</span><br>
                <input type="text" name="usuario" class="box1" placeholder="Usuario" id="">
                <br>
                <span>Contraseña</span><br>
                <input type="password" name="contrasenia" class="box1" placeholder="Contraseña" id="">
                <br>
                <span>Email</span><br>
                <input type="email" name="email" class="box1" placeholder="Email" id="">
                <br>
                <input type="submit" value="Finalizar registro" class="btn">
        </form>
</div>










<?php
    require_once('../templates/footer.php');
?>