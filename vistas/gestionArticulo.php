<!DOCTYPE html>
<?php
include_once ("../CRUD/CRUDComentario.php");
include_once ("../CRUD/CRUDCuenta.php");
include_once ("../CRUD/CRUDArticulo.php");
include_once ("../CRUD/CRUDAnuncio.php");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="#" method="POST">
            <input type="submit" name="creaArt" value="Create article">
            <input type="submit" name="modifArt" value="Modifiy article">
            <input type="submit" name="eliminaArt" value="Delete article">
            <input type="submit" name="listarArt" value="List all the articles">
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
        if (isset($_POST['actualiza'])) {
            $idArticulo = $_POST['idArticulo'];
            $articulo = readArticulo($idArticulo);
            $actualizar = TRUE;
            $titulo = filter_var(trim($_POST['titulo']), FILTER_SANITIZE_MAGIC_QUOTES);
            if ($titulo === "" or ! preg_match('/^[[:alpha:]]+$/', $titulo)) {
                $actualizar = False; //hacer con JS
                echo "wrong title";
            }
            $descripcion = filter_var(trim($_POST['descripcion']), FILTER_SANITIZE_MAGIC_QUOTES);
            if ($descripcion === "") {
                $actualizar = False; //hacer con JS
                echo "wrong description";
            }
            $texto = filter_var(trim($_POST['texto']), FILTER_SANITIZE_MAGIC_QUOTES);
            if ($texto === "") {
                $actualizar = False; //hacer con JS
                echo "wrong text";
            }
            $fecha = $_POST['fecha'];
            $idAnuncio = $_POST['anuncio'];
            if (!empty($_FILES['imagen']["name"])) {
                $imagen = $_FILES['imagen'];
                if ($imagen['type'] !== 'image/png') {
                    echo "wrong format of image";
                    $actualizar = False;
                } else {
                    $nombreImagen = $imagen['name'];
                    unlink("../imagenes/".$articulo['imagen']);
                }
            } else {
                $nombreImagen = $articulo['imagen'];
                
            }
            if (!empty($_FILES['audio']["name"])) {
                $audio = $_FILES['audio'];
                if ($audio['type'] !== 'audio/mpeg') {
                    echo "wrong format of audio";
                    $actualizar = False;
                } else {
                    unlink("../audio/".$articulo['audio']);
                    $nombreAudio = $audio['name'];
                }
            } else {
                $nombreAudio = $articulo['audio'];
                
            }
            if ($actualizar) {
                $articulo = array(
                    'idArticulo' => $idArticulo,
                    'titulo' => $titulo,
                    'descripcion' => $descripcion,
                    'texto' => $texto,
                    'fecha' => $fecha,
                    'imagen' => $nombreImagen,
                    'audio' => $nombreAudio
                );
                if (updateArticulo($articulo)) {
                    asociarArticuloAnuncio($idArticulo, $idAnuncio);   
                    if (!empty($_FILES['audio']["name"])) {
                        move_uploaded_file($audio['tmp_name'], '../audios/' . $nombreAudio);
                    }
                    if (!empty($_FILES['imagen']["name"])) {
                        move_uploaded_file($imagen['tmp_name'], '../imagenes/' . $nombreImagen);
                    }
                    
                    
                    echo "Article created";
                } else {
                    echo "Error creating";
                }
            }
        }
        if (isset($_POST['borra'])) {
            $num = $_POST['numAr'];
            if ($idAr === NULL) {
                header('Location: gestionArticulo.php');
            }
            $borrar = array();
            for ($i = 0; $i < $num; $i++) {
                if (isset($_POST[$i])) {
                    array_push($borrar, $_POST[$i]);
                }
            }
            foreach ($borrar as $idArticulo) {
                $articulo = readArticulo($idArticulo);
                unlink("../imagenes/" . $articulo['imagen']);
                unlink("../anuncios/" . $articulo['audio']);
                deleteArticulo($idArticulo);
            }
        } else if (isset($_POST['modifica'])) {
            $idAr = $_POST['articulo'];
            if ($idAr === NULL) {
                header('Location: gestionArticulo.php');
            }
            $articulo = readArticulo($idAr);
            ?>
            <form action="#" method="POST" enctype="multipart/form-data">
                Title of the article:  <input type="text" name="titulo" value="<?php echo $articulo['titulo']; ?>"><br/>
                Date of the article: <input type="date" name="fecha" value="<?php echo $articulo['fecha']; ?>"><br/>
                Description of the article:<input type="text" name="descripcion" value="<?php echo $articulo['descripcion']; ?>"><br/>
                Text of the article: <input type="text" name="texto" value="<?php echo $articulo['texto']; ?>"><br/>
                Image: <input type="file" name="imagen" value="<?php echo $articulo['imagen']; ?>"><br/>
                Audio: <input type="file" name="audio" value="<?php echo $articulo['audio']; ?>"><br/>
                Anuncio asociado al articulo: 

                <?php
                $anuncios = readAllAnuncio();
                if (!empty($anuncios)) {
                    foreach ($anuncios as $anuncio) {
                        echo $anuncio['descripcion'];
                        echo $anuncio['imagen'];
                        ?>
                        <input type="radio" name="anuncio" value="<?php echo $anuncio['idAnuncio']; ?>" <?php
                        if ($idAr === $anuncio['idArticulo']) {
                            echo "checked";
                        }
                        ?>> 

                        <?php
                    }
                } else {
                    echo "There are no ads available to modify this article";
                }
                ?>

                <input type ="hidden" name ="idArticulo"  value ="<?php echo $idAr; ?>">
                <input type="submit" name="actualiza" value="Actualizar"><br/>
            </form>

            }
            <?php
        } else if (isset($_POST['crea'])) {
            $insertar = TRUE;
            $titulo = filter_var(trim($_POST['titulo']), FILTER_SANITIZE_MAGIC_QUOTES);
            if ($titulo === "" or ! preg_match('/^[[:alpha:]]+$/', $titulo)) {
                $insertar = False; //hacer con JS
                echo "TITULO erroneo";
            }
            $descripcion = filter_var(trim($_POST['descripcion']), FILTER_SANITIZE_MAGIC_QUOTES);
            if ($descripcion === "") {
                $insertar = False; //hacer con JS
                echo "DESCRIPCION erronea";
            }
            $texto = filter_var(trim($_POST['texto']), FILTER_SANITIZE_MAGIC_QUOTES);
            if ($texto === "") {
                $insertar = False; //hacer con JS
                echo "TEXTO erroneo";
            }
            $fecha = $_POST['fecha'];
            $idAnuncio = $_POST['anuncio'];
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
                if (($idArticulo = createArticulo($articulo)) !== FALSE) {
                    asociarArticuloAnuncio($idArticulo, $idAnuncio);
                    asociarArticuloAutor($idArticulo, $idCuenta);
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
                            <th>Articles</th>
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
                        <tr>
                            <?php
                            $anuncios = leerAnunciosSinArticulo();
                            if (!empty($anuncios)) {
                                foreach ($anuncios as $anuncio) {
                                    ?><td><?php
                                        echo $anuncio['descripcion'];
                                        echo $anuncio['imagen'];
                                        ?>
                                        <input type="radio" name="anuncio" value="<?php echo $anuncio['idAnuncio']; ?>"></td> 

                                    <?php
                                }
                            } else {
                                echo "There are no ads available to modify this article";
                            }
                            ?>
                        </tr> 
                    </table>
                    <input type="submit" name="crea" value="Create article">
                </form>
                <?php
            }
        }
        ?>
    </body>
</html>
