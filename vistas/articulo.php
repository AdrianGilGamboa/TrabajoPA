<?php
include_once ('../CRUD/CRUDArticulo.php');
include_once ('../CRUD/CRUDCuenta.php');
include_once ('../CRUD/CRUDComentario.php');

function readComentariosArticulo($idArticulo) {
    $con = conexionBD();
    $res = False;
    $query = "SELECT * FROM comentarios WHERE idArticulo = $idArticulo and idRespuesta is NULL";
    $result = $con->query($query);
    ?>
    <ul>
        <?php
        while ($comentario = mysqli_fetch_array($result)) {
            ?><li><?php echo $comentario['texto']; ?></li><?php
            ?><?php
            hiloComentario($comentario);
        }
        ?>
    </ul>
    <?php
    desconectar($con);
    return $res;
}

function hiloComentario($respuesta) {
    $con = conexionBD();
    $idComentario = $respuesta['idComentario'];
    ?>
    <ul>
        <?php
        $query = "SELECT * FROM comentarios WHERE idRespuesta = $idComentario";
        $result = $con->query($query);
        while ($respuesta = mysqli_fetch_array($result)) {
            ?><li><?php echo $respuesta['texto']; ?></li><?php
            hiloComentario($respuesta);
        }
        ?>
    </ul><?php
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content=="IE=edge"/>
        <meta name="google" value="notranslate"/>
        <link href="css.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <title><?php $idArticulo = $_GET['idArticulo'];
        $articulo = readArticulo($idArticulo);echo $articulo['titulo']; ?></title>

    </head>
    <style>

    </style>
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
        <?php

        
        $autor = readCuenta($articulo['idCuenta']);
        ?>
        <article>
            <div class="tituloArticulo">
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
            <div class="audioArticulo">
                <?php if ($articulo['audio'] != NULL) { ?>
                    <audio controls>
                        <source src="<?php echo '../audios/' . $articulo['audio']; ?>" type="audio/mpeg">
                    </audio>
                <?php } ?>
            </div>
            <div class="descripcionArticulo">

                <?php echo $articulo['descripcion']; ?>

            </div>
            <div class="textoArticulo">
                <?php echo $articulo['texto']; ?>
            </div>
            <div class="fechaArticulo">
<?php echo $articulo['fecha']; ?>
            </div>
            <div class="autorArticulo">

                <?php echo $autor['nombre']; ?>

            </div>
            <div class="comentariosArticulo">
<?php readComentariosArticulo($articulo['idArticulo']); ?>
            </div>
        </article>
        <footer>

        </footer>
    </body>
</html>
