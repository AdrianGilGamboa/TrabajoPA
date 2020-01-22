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
        ?>
        <aside>
            <!-- Anuncios -->
        </aside>
        <article class="tituloSeccion">

            <h3>Section <?php
        $idSeccion = $_GET['idSeccion'];
        echo $idSeccion;

        $seccion = readSeccionId($idSeccion);
        echo $seccion['categoria'];
        ?></h3>
        </article>
        <?php
        $articulos = mostrarArticulos($idSeccion);  //echo $articulo['titulo'];
        if ($articulos) {
            foreach ($articulos as $articulo) {
                ?><article>
                    <div class="imagenSeccion">
                        <a href="<?php
                        if ($articulo['imagen'] != NULL) {
                            echo 'imagenes/' . $articulo['imagen'];
                        }
                        ?>"><?php
                               if ($articulo['imagen'] != NULL) {
                                   echo $articulo['imagen'];
                               }
                               ?></a>
                    </div>
                    <div class="tituloSeccion">
                        <h2><?php echo $articulo['titulo']; ?></h2>
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

        <footer>

        </footer>
    </body>
</html>
