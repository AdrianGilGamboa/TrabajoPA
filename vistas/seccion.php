<?php
include_once ('../CRUD/CRUDArticulo.php');
include_once ('../CRUD/CRUDSeccion.php');

function mostrarArticulos($idSeccion) {
    $con = conexionBD();
    $sql = "select * from articulos where idSeccion = $idSeccion";

    $result = mysqli_query($con, $sql);

    while ($articulo = mysqli_fetch_array($result)) {
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
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>

    <body>
        <header>
            <h1>MoarNews</h1>
            <h2>Tu peri&oacute;dico digital</h2>
        </header>
        <nav>
            <!-- Barra de navegacion -->
        </nav>
        <aside>
            <!-- Anuncios -->
        </aside>
        <article class="tituloSeccion">
            <h3>Seccion <?php $seccion = readSeccion(3); echo $seccion['categoria'];
                ?></h3>
        </article>
        <?php mostrarArticulos(3);  //echo $articulo['titulo'];
        ?>

        <footer>

        </footer>
    </body>
</html>
