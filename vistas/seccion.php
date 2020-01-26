<?php
include_once ('../CRUD/CRUDArticulo.php');
include_once ('../CRUD/CRUDSeccion.php');
include_once ('../CRUD/CRUDCuenta.php');

function mostrarArticulos($idSeccion) {
    $con = conexionBD();

    $query = "SELECT * FROM secciones WHERE idSeccion = '$idSeccion'";

    $result = $con->query($query);
    $articuloAux = $result->fetch_assoc();
    $articulos = leerArticulosDadaSeccion($articuloAux['idSeccion']);

    if ($articulos) {
        return $articulos;
    } else {
        return FALSE;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title classs="centrar"><?php
            $idSeccion = $_GET['idSeccion'];
            $seccion = readSeccionId($idSeccion);
            echo $seccion['categoria'];
            ?></title>
        <link href="css.css" rel="stylesheet" type="text/css"/>
        <meta http-equiv="X-UA-Compatible" content=="IE=edge"/>
        <meta name="google" value="notranslate"/>
        <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    </head>

    <body>
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

        $seccion = readSeccionId($idSeccion);
        ?>

        <aside>
            <!-- Anuncios -->
        </aside>
        <section class="categoriaSeccion">

            <h3>Section <?php echo $seccion['categoria']; ?></h3>


            <?php
            $articulos = mostrarArticulos($idSeccion);  //echo $articulo['titulo'];
            if ($articulos) {
                foreach ($articulos as $articulo) {
                    $autor = readCuenta($articulo['idCuenta']);
                    ?>

                    <a href="articulo.php?idArticulo=<?php echo $articulo['idArticulo']; ?>">
                        <article class="inner">

                            <h2><?php echo $articulo['titulo']; ?></h2>

                            <div class="image">
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

                            <form action="comentario.php" method="POST">
                                <input type="hidden" name="articulo" value="<?php echo $articulo['idArticulo']; ?>">
                                <input type="hidden" name="cuenta" value="<?php echo $idUsuario; ?>">
                                <input class="small" type="submit" name="comentar" value="Comment article">
                            </form>
                            <div class="comentariosArticulo">
                                <?php
                                $comentarios = readComentariosArticuloPortada($articulo['idArticulo']);
                                if ($comentarios) {
                                    foreach ($comentarios as $comentario) {
                                        ?>Autor: <?php
                                        $autor = cuentaDadoComentario($comentario['idCuenta']);
                                        echo $autor['nombre'];
                                        ?>
                                        <p><?php echo $comentario['texto']; ?></p>
                                        Rating: <?php echo $comentario['puntuacion']; ?>
                                        <?php
                                        if ($hayCuenta) {
                                            ?>
                                            <form action="comentario.php" method="POST">
                                                <input type="hidden" name="articulo" value="<?php echo $articulo['idArticulo']; ?>">
                                                <input type="hidden" name="cuenta" value="<?php echo $idUsuario; ?>">
                                                <input type="hidden" name="comentario" value="<?php echo $comentario['idComentario']; ?>">
                                                <input class="small" type="submit" name="responder" value="Reply comment">
                                            </form>
                                            <form action="#" method="POST">
                                                <input type="hidden" name="idComentario" value="<?php echo $comentario['idComentario']; ?>">
                                                <input class="small" type="submit" name="like" value="Like">
                                                <input class="small" type="submit" name="dislike" value="Dislike">
                                            </form>
                                            <?php
                                        }
                                        ?>
                                        <br/>
                                        <?php
                                    }
                                }
                            }
                        }
                        ?>
                    </div>
                </article> </a>
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
