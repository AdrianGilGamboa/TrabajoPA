<?php
include_once ("../CRUD/CRUDArticulo.php");
include_once ("../CRUD/CRUDCuenta.php");
include_once ("../CRUD/CRUDSeccion.php");
include_once ("../CRUD/CRUDPortada.php");
include_once ("../CRUD/CRUDComentario.php");
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
        $anuncio = obtenerAnuncioDePortada($idPortada) ;
        
        
        ?>
        <aside>
            <img src="../anuncios/<?php echo $anuncio['imagen']; ?>"alt='<?php echo $anuncio['imagen']; ?>' >
            <?php echo $anuncio['descripcion'];?>
        </aside>
          

        <?php
        $articulos = readAllArticuloPorFecha();
        ?>
        <section>

            <?php
            if ($articulos) {
                foreach ($articulos as $articulo) {
                    $autor = readCuenta($articulo['idCuenta']);
                    ?>
                    <a href="articulo.php?idArticulo=<?php echo $articulo['idArticulo']; ?>"><article class="inner">

                            <h1><?php echo $articulo['titulo']; ?></h1>

                            <div class="image">
                                <a href="<?php
                                if ($articulo['imagen'] != NULL) {
                                    echo '../imagenes/' . $articulo['imagen'];
                                }
                                ?>"><img src="../imagenes/<?php echo $articulo['imagen']; ?>"alt='<?php echo $articulo['imagen']; ?>' ><?php
                                       if ($articulo['imagen'] != NULL) {
                                           echo $articulo['imagen'];
                                       }
                                       ?></a>
                            </div>
                            <div class="audioArticulo">
                                <?php if ($articulo['audio'] != NULL) { ?>
                                    <audio controls>
                                        <source src="<?php echo '../audios/' . $articulo['audio']; ?>" type="audio/mpeg">
                                    </audio>
                                <?php } ?>
                            </div>

                            <div >
                                <h3><?php echo $articulo['descripcion']; ?></h3> 
                            </div>
                            <div>
                                <p> <?php echo $articulo['texto']; ?></p>
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
                            <form class="inner" action="comentario.php" method="POST" >
                                <input type="hidden" name="articulo" value="<?php echo $articulo['idArticulo']; ?>">
                                <input type="hidden" name="cuenta" value="<?php echo $idUsuario; ?>">
                                <input class="button special fit small" type="submit" name="comentar" value="Comment article">
                            </form>
                            <div class="table-wrapper">
                                <?php
                                $comentarios = readComentariosArticuloPortada($articulo['idArticulo']);
                                if ($comentarios) {

                                    foreach ($comentarios as $comentario) {
                                        ?><table class="alt" style="margin-bottom: 20px;margin-top: 0px;" ><tr> <td> <?php
                                        $autor = cuentaDadoComentario($comentario['idCuenta']);
                                        ?>
                                                    <span style="color: <?php
                                                    if ($autor['formato'] === "gold") {
                                                        echo "gold";
                                                    } else if ($autor['formato'] === "silver") {
                                                        echo "silver";
                                                    } else if ($autor['formato'] === "bronze") {
                                                        echo "brown";
                                                    }
                                                    ?>"><?php
                                                              echo $autor['nombre'];
                                                              ?></span></td>

                                                <td><p style="padding-top: 0px;padding-left: 30px;padding-right: 30px;"><?php echo $comentario['texto']; ?></p></td>
                                                <td> <?php
                                                       $puntuacion = $comentario['puntuacion'];
                                                       for ($index = 0; $index < $puntuacion; $index++) {
                                                           ?>
                                                           <span style="font-size:33px; color: <?php
                                                           if ($autor['formato'] === "gold") {
                                                               echo "gold";
                                                           } else if ($autor['formato'] === "silver") {
                                                               echo "silver";
                                                           } else if ($autor['formato'] === "bronze") {
                                                               echo "brown";
                                                           }
                                                           ?>">☆</span>
                                                               <?php
                                                           }
                                                           ?>
                                                </td>
                                                <?php
                                                 if ($hayCuenta) {?>
                                                <td> <form action="#" method="POST" style="padding-left: 0px;margin-left: 0px;">
                                                        <ul class="actions vertical small">
                                                            <input type="hidden" name="idComentario" value="<?php echo $comentario['idComentario']; ?>">
                                                            <li>
                                                                <i class="fa fa-thumbs-o-up fa-lg" aria-hidden="true"></i>
                                                                  <input class="nav-text" type="submit" name="like" value="like" style="background-color: green">
                                                                
                                                            </li>
                                                            <li>
                                                                <i class="fa fa-thumbs-o-down fa-lg" aria-hidden="true" ></i>
                                                                <input class="nav-text" type="submit" name="dislike" value="dislike" style="background-color: red">
                                                            </li>
                                                        </ul>
                                                 </form></td> <?php }?>
                                            </tr></table>
                                        <?php
                                        if ($hayCuenta) {
                                            ?>

                                            <form action="comentario.php" method="POST" style="margin-top: 0px;padding-top: 10px;padding-bottom: 0px;padding-right: 0px;padding-left: 0px;margin-left: 0px;margin-bottom: 0px;">
                                                <input type="hidden" name="articulo" value="<?php echo $articulo['idArticulo']; ?>">
                                               <input type="hidden" name="cuenta" value="<?php echo $idUsuario; ?>">
                                                <input type="hidden" name="comentario" value="<?php echo $comentario['idComentario']; ?>">
                                                <input class="small" type="submit" name="responder" value="Reply comment">
                                            </form>

                                            <?php
                                        }

                                    }
                                }
                                ?>
                            </div>
                        </article> </a> <hr>
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
