<?php
include_once ("../CRUD/CRUDArticulo.php");
include_once ("../CRUD/CRUDCuenta.php");
include_once ("../CRUD/CRUDSeccion.php");
include_once ("../CRUD/CRUDPortada.php");
include_once ("../CRUD/CRUDComentario.php");
?>
<!DOCTYPE html>
<style>
    hr{
        height: 10px;
        color:black;
    }
    section img{
        width:100%;
    }

    aside
    {
        position: sticky;
        position: -webkit-sticky;
        top: 200px;
        font: 45px 'Abril Fatface', sans-serif;
        color: #fff;
        text-align: center;
    }
    #imagenAnuncio{
        top:100px;
        margin-top:20px;
        width:90%;
    }
</style>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content=="IE=edge"/>
        <meta name="google" value="notranslate"/>
        <link href="css.css" rel="stylesheet" type="text/css"/>
        <script src="scripts/jquery-1.4.2.min.js" type="text/javascript"></script>
        <script src="scripts/jquery-scrolltofixed-min.js" type="text/javascript"></script>
        <script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
        <script src="../js/jquery.zoom.min.js" type="text/javascript"></script>
        <script src="../js/scripts.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <title>Cover of the day</title>
    </head>

    <body>
        <!--[if lt IE 7]>
           <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
       <![endif]-->

        <?php
        session_start();
        $hayCuenta = FALSE;
        if (isset($_SESSION['cuentaID'])) {
            $hayCuenta = TRUE;
            $nombreUsuario = $_SESSION['nombreUsuario'];
            $idUsuario = $_SESSION['cuentaID'];
            $datosPersonales = readCuenta($idUsuario);
        } else {
            $hayCuenta = FALSE;
        }
        if (isset($_POST['like'])) {
            $idComentario = $_POST['idComentario'];
            meGusta($idComentario);
        } else if (isset($_POST['dislike'])) {
            $idComentario = $_POST['idComentario'];
            noMeGusta($idComentario);
        }
        ?>
        <header id="header">

            <?php
            if ($hayCuenta) {
                ?>

                <nav class="left">
                    <a href="#" class="button alt" ><?php echo date("Y-m-d") ?> </a>
                </nav>

                <a href="portada.php" class="logo">MoarNews</a>
                <nav class="right">
                    <a href="suscripcion.php" class="button alt" >Suscribe</a>
                    <a href="cuenta.php" class="button alt"><?php echo $nombreUsuario; ?></a>  
                </nav>


                <?php
            }
            ?>
            <?php
            if (!$hayCuenta) {
                ?>
                <nav class="left">
                    <a href="#" class="button alt" ><?php echo date("Y-m-d") ?> </a>
                </nav>

                <a href="portada.php" class="logo">MoarNews</a>
                <nav class="right">
                    <a href="inicioSesion.php"class="button alt">Log in</a>
                    <a href="registro.php"  class="button alt">Register</a>
                </nav>
                <?php
            }
            ?>

        </header>
        <?php
        include_once 'nav.php';
        $idPortada = obtenerIDPortada(date("Y-m-d"));
        $anuncio = obtenerAnuncioDePortada($idPortada);
        ?>

        <aside style=" top:100px;">
            <img id="imagenAnuncio" src="../anuncios/<?php echo $anuncio['imagen']; ?>"alt='<?php echo $anuncio['imagen']; ?>' style="margin-left: 1.2%;">
            <span style="font-size: 100%"><?php echo $anuncio['descripcion']; ?></span>

        </aside>


        <?php
        $articulos = obtenerArticulosUltimaPortada();
        ?>
        <section class="inner">

            <?php
            if ($articulos) {
                foreach ($articulos as $articulo) {
                    $autor = readCuenta($articulo['idCuenta']);
                    ?>
                    <a href="articulo.php?idArticulo=<?php echo $articulo['idArticulo']; ?>">
                        <article>

                            <h1><?php echo $articulo['titulo']; ?></h1>

                            <div class="image">
                                <img class="imagenes" src="../imagenes/<?php echo $articulo['imagen']; ?>"alt='<?php echo $articulo['imagen']; ?>' >
                            </div>
                            <?php
                            if ($hayCuenta) {
                                if ($datosPersonales['Dv']) {
                                    ?>
                                    <div class="audioArticulo">
                                        <?php if ($articulo['audio'] != NULL) { ?>
                                            <audio controls>
                                                <source src="<?php echo '../audios/' . $articulo['audio']; ?>" type="audio/mpeg">
                                            </audio>
                                        <?php } ?>
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                            <div >
                                <h3><?php echo $articulo['descripcion']; ?></h3> 
                            </div>

                            <div class="fechaArticulo">
                                <?php echo $articulo['fecha']; ?>
                            </div>
                            <div>
                                <h5><?php echo $autor['nombre']; ?></h5>
                            </div>
                            <div class="seccionArticulo">
                                <?php
                                $secciones = leerSeccionDadoArticulo($articulo['idArticulo']);

                                if ($secciones) {
                                    foreach ($secciones as $seccion) {
                                        ?>
                                        <a href="seccion.php?idSeccion=<?php echo $seccion['idSeccion']; ?>"><?php echo $seccion['categoria']; ?></a><?php
                    }
                }
                                ?>
                            </div>

                            <hr>
                        </article>
                        <?php
                    }
                }
                ?>
        </section>
        <footer id="footer">
            <div class="inner">
                <h2>Get In Touch</h2>
                <ul class="actions">
                    <li><i class="icon fa-phone"></i> <a href="#">(034)954 34 92 00</a></li>
                    <li><span class="icon fa-envelope"></span> <a href="#">moarnewspa@gmail.com</a></li>
                    <li><span class="icon fa-map-marker"></span> Ctra. de Utrera, 1, 41013 Sevilla </li>
                </ul>
            </div>
            <div class="copyright">
                &copy; Newspaper. MoarNews <a href="https://www.upo.es/portal/impe/web/portada/index.html">MoarNews</a>. Images <a href="../imagenes/logo.jpeg" alt="logo">MoarNews</a>.

            </div>
        </footer>

    </body>
</html>