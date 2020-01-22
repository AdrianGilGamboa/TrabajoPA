<?php
include_once ('../CRUD/CRUDArticulo.php');
include_once ('../CRUD/CRUDSeccion.php');
include_once ('../CRUD/CRUDCuenta.php');

function mostrarArticulos($idSeccion) {
    $con = conexionBD();
    echo "soy::::" . $idSeccion;
    $query = "SELECT * FROM secciones WHERE categoria = '$idSeccion' LIMIT 1";

    $result = $con->query($query);
    $articuloAux = $result->fetch_assoc();
    $articulos = leerArticulosDadaSeccion($articuloAux['idSeccion']);
    if ($articulos) {
        foreach ($articulos as $articulo) {
            // echo mysqli_error();
            //echo $valores['titulo'];
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
        $idSeccion = $_POST['seccion'];

        $seccion = readSeccion($idSeccion);
        echo $seccion['categoria'];
        ?></h3>
        </article>
        <?php mostrarArticulos($idSeccion);  //echo $articulo['titulo'];
        ?>

        <footer>

        </footer>
    </body>
</html>
