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
        <title></title>
    </head>

    <body>
        <header>
            <h1>MoarNews</h1>
            <h2>The Digital Newspaper</h2>
        </header>
        <?php
        include_once 'nav.php';
        $idSeccion = $_GET['idSeccion'];
        $seccion = readSeccionId($idSeccion);
        ?>
        <aside>
            <!-- Anuncios -->
        </aside>
        <section class="categoriaSeccion">

            <h3>Section <?php echo $seccion['categoria'] ?></h3>

            <?php
            $articulos = mostrarArticulos($idSeccion);  //echo $articulo['titulo'];
            if ($articulos) {
                foreach ($articulos as $articulo) {
                    ?><article>
                        <div class="tituloSeccion">
                            <h2><?php echo $articulo['titulo']; ?></h2>
                        </div>
                        <div class="imagenSeccion">
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
                        <div class="audioSeccion">
                            <?php if ($articulo['audio'] != NULL) { ?>
                                <audio controls>
                                    <source src="<?php echo '../audios/' . $articulo['audio']; ?>" type="audio/mpeg">
                                </audio>
                            <?php } ?>
                        </div>
                        <div class="descripcionSeccion">
                            <?php echo $articulo['descripcion']; ?>
                        </div>
                        <div class="textoSeccion">
                            <?php echo $articulo['texto']; ?>
                        </div>
                        <div class="fechaSeccion">
                            <?php echo $articulo['fecha']; ?>
                        </div>
                        <div class="autorSeccion">
                            <?php
                            $autor = readCuenta($articulo['idCuenta']);
                            echo $autor['nombre'];
                            ?>
                        </div>
                    </article><?php
                }
            }
            ?>
        </section>>
        <footer>

        </footer>
    </body>
</html>
