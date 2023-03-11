<?php
//nueva sesion 
require_once('../../config.php');
 
$rta = $objSession->activa();
$roles = $objSession->obtenerRol();
$rolesArr = [];
foreach ($roles as $key => $value) {
    $rol = $value->getObjRol();
    $idrol = $rol->getIdrol();
    $rolStr = $rol->getRodescripcion();
    $rolesArr[$idrol] = $rolStr;
}
foreach ($rolesArr as $key => $value) {
    if (!isset($rolPrimo)) {
        $rolPrimo = $value;
        $rolPrimoId = $key;
    }
}
$objSession->setRolPrimo($rolPrimo, $rolPrimoId);
$menuesDelUsuario = $objSession->obtenerMenues();
$menuesTotales = $objSession->obtenerTodosMenues();
if($objSession->tienePermiso()){
    $_GET['error'] = 'permiso';
    header($PRINCIPAL."?error=permiso");
}
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BBusted</title>
        <link rel="icon" type="image/x-icon" href="../../Public/img/favicon.png">
        
        <!-- CSS -->
        <link rel="stylesheet" href="../../Public/cssPuro/newStyle.css">
        <!-- Fontawesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <!-- Swiper -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../../Public/bootstrap-5.2.2-dist/css/bootstrap.min.css">

        <link rel="stylesheet" href="../../Vendor/themes/black/easyui.css">
        <link rel="stylesheet" href="../../Vendor/themes/icon.css">
        <link rel="stylesheet" href="../../Vendor/themes/color.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>


    </head>

    <body>
        <!-- Header -->
        <header class="header">


            <div class="header-1">
            <a href="../home/index.php" class="logo" ><i class="fa fa-film" style="padding-top:5px;"></i><span style="color:red;">BlockBUSTED</span></a>

                <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
                    <li class="nav-item dropdown user">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <button class="btn btn-primary" type="button" style="font-size: 15px;"><?php echo ($objSession->getUsnombre()); ?> - <span><?php echo ($objSession->getRolPrimo()); ?></span></button>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../logs/logout.php" style="font-size: 15px;">Salir</a></li>
                        </ul>
                    </li>
                </div>

            </div>
            </nav>

        </header>

        <body>

            <!-- Mostrar los menues -->
            <div class="header-2">
                <nav class="navbar">
                    <?php
                    foreach ($menuesTotales as $key => $value) {
                        $menombre = $value['menombre'];
                        $melink = $value['medescripcion'];
                        foreach ($menuesDelUsuario as $llave => $valor) {
                            if ($valor == $menombre) {
                                echo "<a href=\"../../$melink\">$menombre</a>";
                            }
                        }
                    }

                    ?>
                </nav>
            </div>

        <?php //} ?>