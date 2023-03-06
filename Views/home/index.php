<?php
    require_once('../../config.php');
    require_once('../templates/preheader.php');
    $objProducto = new ProductoController();
    $arr = [];
    $listaProductos = $objProducto->listarTodo( $arr );
    //var_dump( $listaProductos );
?>
    
    
    <!-- Home -->
    <section class="home" id="home">
        <div class="row">
            <div class="col-md-6"></div>
            <div class="content col-md-6">
                <h3 style="color:white;">Con 100% de descuento.. o mas, ¿Quién sabe?</h3>
                <p style="color:white;">BlockBuster murió, somos BlockBUSTED, rematamos lo que quedo de ellos...</p>
                <a href="<?php echo $PROD ?>" class="btn btn-danger" style="font-size: 25px;">Comprar ya</a>
            </div>
        </div>
    </section>

    <!-- Iconcitos fachas -->
    <section class="icons-container">
        <div class="icons">
            <i class="fas fa-headset"></i>
            <div class="content">
                <h3 style="color:white;">Atención 24/7</h3>
                <p style="color:white;">Solo 24 minutos de atención por cada 7 días</p>
            </div>
        </div>
        <div class="icons">
            <i class="fas fa-lock"></i>
            <div class="content">
                <h3 style="color:white;">Pagos seguros</h3>
                <p style="color:white;">Si te cobramos mas... un impuesto lo hizo</p>
            </div>
        </div>
        <div class="icons">
            <i class="fas fa-plane"></i>
            <div class="content">
                <h3 style="color:white;">Envíos gratis a todo el país</h3>
                <p style="color:white;">En pedidos mayores a UN CHILION DE DOLARES</p>
            </div>
        </div>
        <div class="icons">
            <i class="fas fa-redo-alt"></i>
            <div class="content">
                <h3 style="color:white;">Reembolsos</h3>
                <p style="color:white;">Nop</p>
            </div>
        </div>
        
    </section>


   <!--  <section class="reviews" id="reviews">
        <h1 class="heading"><span>Reviews de clientes</span></h1>
        <div class="swiper reviews-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide box">
                    <img src="../../Public/img/pic-1.png" alt="">
                    <h3>John Salchichon</h3>
                    <p>Mi héroe siempre es y será.. Rambo, por eso me compre todas sus peliculas.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="swiper-slide box">
                    <img src="../../Public/img/pic-2.png" alt="">
                    <h3>John Snow</h3>
                    <p>El señor de los anillos no me sirvió contra los caminantes blancos</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="swiper-slide box">
                    <img src="../../Public/img/pic-3.png" alt="">
                    <h3>Susana Horia</h3>
                    <p>Lo que mejor aprendi de Rápido y Furioso es que la familia esta primero</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="swiper-slide box">
                    <img src="../../Public/img/pic-4.png" alt="">
                    <h3>Esteban Quito</h3>
                    <p>Tenian el comercial completo de la batamanta</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="swiper-slide box">
                    <img src="../../Public/img/pic-6.png" alt="">
                    <h3>Armando Paredes</h3>
                    <p>Bob el Constructor <i class="fas fa-heart"></i> </p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section> -->

    <?php
    require_once('../templates/footer.php');
    ?>