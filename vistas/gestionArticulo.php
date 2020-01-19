<!DOCTYPE html>
<?php
include_once ("../CRUD/CRUDComentario.php");
include_once ("../CRUD/CRUDCuenta.php");
include_once ("../CRUD/CRUDArticulo.php");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="#" method="POST">
            <input type="submit" name="creaArt" value="Crear Artículo">
            <input type="submit" name="modifArt" value="Modificar Artículo">
            <input type="submit" name="eliminaArt" value="Eliminar Artículo">
            <input type="submit" name="listarArt" value="Listar Artículo">
        </form>
        <?php
        session_start();
        if (!isset($_SESSION['cuentaID'])) {
            header('Location: inicioSesion.php');
        }
        if (isset($_SESSION['cuentaID'])) {
            if ($_SESSION['tipo'] === "autor") {
                $idCuenta = $_SESSION['cuentaID'];
                $nombre = $_SESSION['nombreUsuario'];
            } else {
                header('Location: portada.php');
            }
        }

        if (isset($_POST['borra'])) {
            $num = $_POST['numAr'];
            $borrar = array();
            for ($i = 0; $i < $num; $i++) {
                if (isset($_POST[$i])) {
                    array_push($borrar, $_POST[$i]);
                }
            }
            foreach ($borrar as $idArticulo) {
                $articulo = readArticulo($idArticulo);
                unlink("../imagenes/".$articulo['imagen']);
                unlink("../anuncios/".$articulo['audio']);
                deleteArticulo($idArticulo);
            }
        } else if (isset($_POST['modifica'])) {
            $idAr = $_POST['articulo'];
            $articulo = readArticulo($idAr);
            ?>
            <form action="#" method="POST">
                <table cellpadding="10" border="1">
                    <tr>
                        <th>titulo</th>
                        <th>fecha</th>
                        <th>descripcion</th>
                        <th>texto</th>
                        <th>imagen</th>
                        <th>audio</th>
                        <th>Anuncio asociado al articulo</th>

                    </tr>
                    <tr>
                        <td align='center'><?php echo $articulo['titulo']; ?></td>
                        <td align='center'><?php echo $articulo['fecha']; ?></td>
                        <td align='center'><?php echo $articulo['descripcion']; ?></td>
                        <td align='center'><?php echo $articulo['texto']; ?></td>
                        <td align='center'><?php echo $articulo['imagen']; ?></td>
                        <td align='center'><?php echo $articulo['audio']; ?></td>
                        <td align='center'><?php echo $articulo['idAnuncio']; ?></td> //como cojo el anuncio
                    </tr>
                </table>
            </form>


            <?php
        } else if (isset($_POST['crea'])) {
            $insertar = TRUE;
            $titulo = filter_var(trim($_POST['titulo']), FILTER_SANITIZE_MAGIC_QUOTES);
            if ($titulo === "" or ! preg_match('/^[[:alpha:]]+$/', $titulo)) {
                $insertar = False; //hacer con JS
                echo "TITULO erroneo";
            }
            $descripcion = filter_var(trim($_POST['descripcion']), FILTER_SANITIZE_MAGIC_QUOTES);
            if ($descripcion === "" or ! preg_match('/^[[:alpha:]]+$/', $descripcion)) {
                $insertar = False; //hacer con JS
                echo "DESCRIPCION erronea";
            }
            $texto = filter_var(trim($_POST['texto']), FILTER_SANITIZE_MAGIC_QUOTES);
            if ($texto === "") {
                $insertar = False; //hacer con JS
                echo "TEXTO erroneo";
            }
            $fecha = $_POST['fecha'];
            if (isset($_FILES['imagen'])) {
                $imagen = $_FILES['imagen'];
                if ($imagen['type'] !== 'image/png') {
                    echo "formato de imagen incorrecto";
                    $insertar = False;
                } else {
                    $nombreImagen = $imagen['name'];
                }
            }
            if (isset($_FILES['audio'])) {
                $audio = $_FILES['audio'];
                if ($audio['type'] !== 'audio/mpeg') {
                    echo "formato de audio incorrecto";
                    $insertar = False;
                } else {
                    $nombreAudio = $audio['name'];
                }
            }
            if ($insertar) {
                $articulo = array(
                    'titulo' => $titulo,
                    'descripcion' => $descripcion,
                    'texto' => $texto,
                    'fecha' => $fecha,
                    'imagen' => $nombreImagen,
                    'audio' => $nombreAudio
                );
                if (($idArticulo=createArticulo($articulo))!==FALSE) {
                    asociarArticuloAutor($idArticulo,$idCuenta);
                    move_uploaded_file($imagen['tmp_name'], '../imagenes/' . $nombreImagen);
                    move_uploaded_file($audio['tmp_name'], '../audios/' . $nombreAudio);
                    echo "Article created";
                } else {
                    echo "Error creating";
                }
            }
        } else {
            if (isset($_POST['listarArt'])) {
                $articulosPorAutor = readArticulosFromID($idCuenta);
                ?>

                <table border = "2">
                    <tr>
                        <th>Articulos</th>
                    </tr>
                    <?php
                    foreach ($articulosPorAutor as $articulo) {
                        ?>
                        <tr>
                            <td><?php echo $articulo['titulo']; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>

                <?php
            } else if (isset($_POST['eliminaArt'])) {

                $articulosPorAutor = readArticulosFromID($idCuenta);
                ?>
                <form action="#" method="POST">
                    <table border = "2">
                        <tr>
                            <th></th>
                            <th>Articulos</th>
                        </tr>
                        <?php
                        $j = 0;
                        foreach ($articulosPorAutor as $articulo) {
                            ?>
                            <tr>
                                <td><input type="checkbox" name="<?php echo $j++; ?>" value="<?php echo $articulo['idArticulo']; ?>"></td>
                                <td><?php echo $articulo['titulo']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                    <input type="hidden" name="numAr" value="<?php echo $j; ?>">
                    <input type="submit" name="borra" value="Delete article">
                </form>

                <?php
            } else if (isset($_POST['modifArt'])) {
                $articulosPorAutor = readArticulosFromID($idCuenta);
                ?>
                <form action="#" method="POST">
                    <table border = "2">
                        <tr>
                            <th></th>
                            <th>Articulos</th>
                        </tr>
                        <?php
                        foreach ($articulosPorAutor as $articulo) {
                            ?>
                            <tr>
                                <td><input type="radio" name="articulo" value="<?php echo $articulo['idArticulo']; ?>"></td>
                                <td><?php echo $articulo['titulo']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>

                    <input type="submit" name="modifica" value="Modify article">
                </form>
                <?php
            } else if (isset($_POST['creaArt'])) {
                ?>
                <form action="#" method="POST" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td>Title of the article: </td>
                            <td><input type="text" name="titulo"></td>
                        </tr>
                        <tr>
                            <td>Description of the article: </td>
                            <td><input type="text" name="descripcion"></td>
                        </tr>
                        <tr>
                            <td>Text of the article: </td>
                            <td><input type="text" name="texto"></td>
                        </tr>
                        <tr>
                            <td>Date of the article: </td>
                            <td><input type="date" name="fecha"></td>
                        </tr>
                        <tr>
                            <td>Image: </td>
                            <td><input type="file" name="imagen" /></td>
                        </tr>
                        <tr>
                            <td>Audio: </td>
                            <td><input type="file" name="audio" /></td>
                        </tr>
                        <input type="submit" name="crea" value="Create article">
                    </table>
                </form>
                <?php
            }
        }
        ?>

    </body>
</html>
