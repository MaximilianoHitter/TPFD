<?php
    require_once('../templates/header2.php');

    // session_start();
    /* if( $session->activa() ){
        header( 'Location: ../home/newIndex.php' );
    } */

    /* $conn = new db();
    $profesor = new ProfesorController();
    $data = $profesor->getDatos();

    if (!empty($data['POST']['usuario']) && !empty($data['POST']['contrasenia'])) {
        $records = $conn->prepare('SELECT usuario, contrasenia, mailInstitucional, materia FROM profesor WHERE usuario = :usuario');
        $records->bindParam(':usuario', $data['POST']['usuario']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        if(is_array($results)){
            $message = '';
            if (count($results) > 0 && password_verify($data['POST']['contrasenia'], $results['contrasenia'])) {
                $_SESSION['user_id'] = $results['usuario'];
                header("Location: /tpExcel");
            } else {
                $message = 'Intente nuevamente, las credenciales no coinciden';
            }
        }else{
            $message = 'Intente nuevamente, las credenciales no coinciden';
        }
        
    } */
?>

<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-center align-items-center m-3">
        <div class="col-md-6 p-5 shadow-sm border rounded-3">

            <?php if( !empty($message) ): ?>
            <p class="border border-2 border-danger p-2 mb-2 rounded-pill d-flex justify-content-center"><?php echo $message ?></p>
            <?php endif; ?>

            <form action="../accion/accionLogin.php" method="post">
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" name="usnombre" id="usnombre" class="form-control border border-primary">
                </div>
                <div class="mb-3">
                    <label for="contrasenia" class="form-label">Contraseña</label>
                    <input type="password" name="uspass" id="uspass" class="form-control border border-primary">
                </div>
                <p class="small"><a class="text-primary" href="forget-pass.php">Olvidaste tu contraseña?</a></p>
                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button class="btn btn-primary btn-lg" type="submit">Iniciar sesión</button>
                </div>
            </form>

            <div class="mt-3">
                <p class="mb-0  text-center">No posee una cuenta?
                    <a href="signup.php" class="text-primary fw-bold">Registrese aquí</a>
                </p>
            </div>

        </div>
    </div>
</div>

<?php
    require_once('../templates/footer.php');
?>