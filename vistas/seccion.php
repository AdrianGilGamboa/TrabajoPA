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
        <title>section</title>
        <link href="css.css" rel="stylesheet" type="text/css"/>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content=="IE=edge"/>
        <meta name="google" value="notranslate"/>
        <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
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
