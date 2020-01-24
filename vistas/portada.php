<?php
include_once ("../CRUD/CRUDArticulo.php");
include_once ("../CRUD/CRUDCuenta.php");
include_once ("../CRUD/CRUDSeccion.php");
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content=="IE=edge"/>
        <meta name="google" value="notranslate"/>

        <link href="css.css" rel="stylesheet" type="text/css"/>
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
        } else {
            $hayCuenta = FALSE;
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
        ?>


        <?php
        $articulos = readAllArticuloPorFecha();
        foreach ($articulos as $articulo) {
            $autor = readCuenta($articulo['idCuenta']);
            ?>
            <article>
                <div class="imagenArticulo">
                    <a href="<?php
                    if ($articulo['imagen'] != NULL) {
                        echo '../imagenes/' . $articulo['imagen'];
                    }
                    ?>"><img src="../imagenes/<?php echo $articulo['imagen']; ?>"alt='<?php echo $articulo['imagen']; ?>' width='300'><?php
                           if ($articulo['imagen'] != NULL) {
                               echo $articulo['imagen'];
                           }
                           ?></a>
                </div>
                <div class="audioArticulo">
                    <a href="<?php
                    if ($articulo['audio'] != NULL) {
                        echo '../audios/' . $articulo['audio'];
                    }
                    ?>"><?php
                           if ($articulo['audio'] != NULL) {
                               echo $articulo['audio'];
                           }
                           ?></a>
                </div>
                <div class="tituloArticulo">
                    <h2><?php echo $articulo['titulo']; ?></h2>
                </div>
                <div class="descripcionArticulo">
                    <?php echo $articulo['descripcion']; ?>
                </div>
                <div class="fechaArticulo">
                    <?php echo $articulo['fecha']; ?>
                </div>
                <div class="autorArticulo">
                    <?php echo $autor['nombre']; ?>
                </div>
                <div class="comentariosArticulo">
                    <?php
                    $comentarios = readComentariosArticuloPortada($articulo['idArticulo']);
                    if ($comentarios) {
                        foreach ($comentarios as $comentario) {
                            ?>
                            <p><?php echo $comentario['texto']; ?></p>
                            <strong><?php echo $comentario['puntuacion']; ?></strong>
                            <?php
                            if ($hayCuenta) {
                                ?>
                                <button>Comment</button>
                                <?php
                            }
                            ?>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="seccionArticulo">
                    <?php
                    $secciones = leerSeccionDadoArticulo($articulo['idArticulo']);
                    //print_r($secciones);
                    if ($secciones) {
                        foreach ($secciones as $seccion) {
                            echo $seccion['categoria'];
                        }
                    }
                    ?>
                </div>
            </article>
            <?php
        }
        ?>
        <footer id="footer">
            <div class="inner">
                <h2>Get In Touch</h2>
                <ul class="actions">
                    <li><i class="icon fa-phone"></i> <a href="#">(034)954 34 92 00</a></li>
                    <li><span class="icon fa-envelope"></span> <a href="#">moarNesws@gmail.com</a></li>
                    <li><span class="icon fa-map-marker"></span> Ctra. de Utrera, 1, 41013 Sevilla </li>
                </ul>
            </div>
            <div class="copyright">
                &copy; Newspaper. MoarNews <a href="https://www.upo.es/portal/impe/web/portada/index.html">MoarNews</a>. Images <a href="../imagenes/logo.jpeg" alt="logo">MoarNews</a>.

            </div>
        </footer>

    </body>
</html>
