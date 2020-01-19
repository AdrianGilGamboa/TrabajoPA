<?php
include_once ("../CRUD/CRUDArticulo.php");
include_once ("../CRUD/CRUDCuenta.php");
include_once ("../CRUD/CRUDSeccion.php");
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Portada del dia</title>
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
        <header>
            <?php
            include_once 'nav.php';
            ?>
            <?php
            if ($hayCuenta) {
                ?>
            <a href="suscripcion.php">Suscribe</a>
                <?php
            }
            ?>
            <?php
            if (!$hayCuenta) {
                ?>
                <a href="inicioSesion.php">Login</a>
                <a href="registro.php">Register</a>
                <?php
            }
            ?>
            <?php
            if ($hayCuenta) {
                ?>
                <a href="cuenta.php"><?php echo $nombreUsuario; ?></a>
                <a href="logout.php">Logout</a>
                <?php
            }
            ?>
        </header>
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
                    ?>"><img src="../imagenes/<?php echo $articulo['imagen']; ?>"alt='<?php echo $articulo['nombre'];?>' width='300'><?php
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
        <footer>

        </footer>

    </body>
</html>
