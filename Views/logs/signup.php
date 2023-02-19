<?php
    require_once('../templates/header.php');
    require_once('../../Models/conector/db.php');

    /* if( isset($_SESSION['user_id']) ){
        header('Location: ../home/index.php');
    } */
    /* if( $session->activa() ){
        header( 'Location: ../home/newIndex.php' );
    } */

    /* $conn = new db();
    $profesor = new ProfesorController();
    $data = $profesor->getDatos();
    //var_dump($data);
    $message = '';
    if(isset($_POST) OR isset($_GET)){
        if( !empty($data['POST']['usuario']) && !empty($data['POST']['contrasenia']) && !empty($data['POST']['mail']) && !empty($data['POST']['materia']) ){
            $sql = "INSERT INTO profesor (usuario, contrasenia, mailInstitucional, materia) VALUES (:usuario, :contrasenia, :mailInstitucional, :materia)";
            $statement = $conn->prepare( $sql );
            $statement->bindParam( ':usuario', $data['POST']['usuario'] );
            $contrasenia = password_hash( $data['POST']['contrasenia'], PASSWORD_BCRYPT );
            $statement->bindParam( ':contrasenia', $contrasenia );
            $statement->bindParam( ':mailInstitucional', $data['POST']['mail'] );
            $statement->bindParam( ':materia', $data['POST']['materia'] );
            //var_dump($statement->execute());
            if( $statement->execute() ){
                $message = 'Usuario creado piolon';
            } else {
                $message = 'Error';
            }
        }
    } */

    
?>


<div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
            <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-5">
                    <div class="row justify-content-center">
                        <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                            <?php if( !empty($message) ): ?>
                            <p class="border border-2 border-danger p-2 mb-2 rounded-pill d-flex justify-content-center"><?php echo $message ?></p>
                            <?php endif; ?>

                            <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Registro</p>
                            
                            <form class="mx-1 mx-md-4" action="../accion/accionSignup.php" method="POST" id="form">
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <label class="form-label" for="usnombre">Su usuario</label>
                                        <input type="text" name="usnombre" id="usnombre" class="form-control"/>
                                    </div>
                                </div>
                                
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <label class="form-label" for="mail">Su mail institucional</label>
                                        <input type="email" name="usmail" id="mail" class="form-control"/>
                                    </div>
                                </div>
                                
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <label class="form-label" for="contrasenia">Contraseña</label>
                                        <input type="password" name="uspass" id="uspass" class="form-control"/>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                    <button class="btn btn-primary btn-lg" type="submit" id="submit">Registrarse</button>
                                </div>
                            
                            </form>
                            
                            <div class="mt-3">
                                <p class="mb-0  text-center">Ya posee una cuenta?
                                    <a href="login.php" class="text-primary fw-bold">Inicie sesión aquí</a>
                                </p>
                            </div>

                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../../Public/jsPuro/registro.js"></script>

<?php
    require_once('../templates/footer.php');
?>