<!DOCTYPE html>
<?php
include_once ("../CRUD/CRUDAnuncio.php");
include_once ("../CRUD/CRUDAnunciante.php");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content=="IE=edge"/>
        <meta name="google" value="notranslate"/>
        <link href="css.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <script src="../js/scripts.js" type="text/javascript"></script>
        <title></title>
    </head>
    <body>
        <?php
        session_start();
        if (!isset($_SESSION['cuentaID'])) {
            header('Location:inicioSesion.php');
        }
        if (isset($_SESSION['cuentaID'])) {
            if ($_SESSION['tipo'] === 'administrador') {
                $nombreUsuario = $_SESSION['nombreUsuario'];
                $idUsuario = $_SESSION['cuentaID'];
            } else {
                header('Location:cuenta.php');
            }
        }
        
        include_once 'nav.php';
        ?>
          
        <form action="#" method="POST">
            <input type="submit" value="Create advertisement" name="creaAnuncio">
            <input type="submit" value="Delete advertisement" name="borraAnuncio">
            <input type="submit" value="Create advertiser" name="creaAnunciante">
            <input type="submit" value="Delete advertiser" name="borraAnunciante">
        </form>
        <?php
        if (isset($_POST['creaA'])) {
            $insertar = TRUE;
            $descripcion = filter_var(trim($_POST['descripcion']), FILTER_SANITIZE_MAGIC_QUOTES);
            if ($descripcion === "") {
                $insertar = False; //hacer con JS
                echo "DESCRIPCION erronea";
            }
            $duracion = $_POST['duracion'];
            $idAnunciante = $_POST['anunuciante'];
            if (isset($_FILES['imagen'])) {
                $imagen = $_FILES['imagen'];
                if ($imagen['type'] !== 'image/png') {
                    echo "formato de imagen incorrecto";
                    $insertar = False;
                } else {
                    $nombreImagen = $imagen['name'];
                }
            }
            if ($insertar) {
                $anuncio = array(
                    'descripcion' => $descripcion,
                    'duracion' => $duracion,
                    'imagen' => $nombreImagen
                );
                if (($idArticulo = createAnuncio($anuncio)) !== FALSE) {
                    asociaAnuncio($idArticulo, $idAnunciante);
                    move_uploaded_file($imagen['tmp_name'], '../anuncios/' . $nombreImagen);
                    echo "Advertisement created";
                } else {
                    echo "Error creating";
                }
            }
        } else if (isset($_POST['borraA'])) {
            $numA = $_POST['numA'];
            $borrar = array();
            for ($i = 0; $i < $numA; $i++) {
                if (isset($_POST[$i])) {
                    array_push($borrar, $_POST[$i]);
                }
            }
            foreach ($borrar as $idAnuncio) {
                $anuncio = readAnuncio($idAnuncio);
                unlink("../anuncios/" . $anuncio['imagen']);
                deleteAnuncio($idAnuncio);
            }
        } else if (isset($_POST['creaAn'])) {
            $insertar = TRUE;
            $nombre = filter_var(trim($_POST['nombre']), FILTER_SANITIZE_MAGIC_QUOTES);
            if ($nombre === "") {
                $insertar = False; //hacer con JS
                echo "Nombre erroneo";
            }
            $tarifa = filter_var(trim($_POST['tarifa']), FILTER_SANITIZE_MAGIC_QUOTES);
            if ($tarifa === "") {
                $insertar = False; //hacer con JS
                echo "tarifa erroneo";
            }
            if ($insertar) {
                $anunciante = array(
                    'nombre' => $nombre,
                    'tarifa' => $tarifa
                );
                if (createAnunciante($anunciante)) {
                    echo "Anunciante creado";
                } else {
                    echo "Fallo al crear";
                }
            }
        } else if (isset($_POST['borraAn'])) {
            $numA = $_POST['numA'];
            $borrar = array();
            for ($i = 0; $i < $numA; $i++) {
                if (isset($_POST[$i])) {
                    array_push($borrar, $_POST[$i]);
                }
            }
            foreach ($borrar as $idAnunciante) {
                deleteAnunciante($idAnunciante);
            }
        } else {
            if (isset($_POST['creaAnuncio'])) {
                $anunciantes = readAllAnunciante();
                ?>
        <form action="#" method="POST" onsubmit="return validaAnuncio()" enctype="multipart/form-data">
                    <table>
                        <tr>

                            <td>Description of the advertisement: </td>
                            <td><input type="text" name="descripcion"></td>
                        </tr>
                        <tr>
                            <td>Duration: </td>
                            <td><input type="number" name="duracion"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="file" name="imagen"></td>
                        </tr>                  

                    </table>
                    <?php
                    foreach ($anunciantes as $anunciante) {
                        echo $anunciante['nombre'];
                        ?>                   
                        <input type="radio" name="anunuciante" value="<?php echo $anunciante['idAnunciante']; ?>" />
                    <?php }
                    ?><br/>
                    <input type="submit" name="creaA" value="Create advertisement">
                </form>
                <?php
            } else if (isset($_POST['borraAnuncio'])) {
                $anuncios = readAllAnuncio();
                ?>
                <form action="#" method="POST">
                    <table border = "2">
                        <tr>
                            <th></th>
                            <th>Advertisement</th>
                            <th>Image</th>
                        </tr>
                        <?php
                        $j = 0;
                        if ($anuncios) {
                            foreach ($anuncios as $anuncio) {
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="<?php echo $j++; ?>" value="<?php echo $anuncio['idAnuncio']; ?>"></td>
                                    <td><?php echo $anuncio['descripcion']; ?></td>
                                    <td><img src="../anuncios/<?php echo $anuncio['imagen']; ?>" alt='<?php echo $anuncio['imagen']; ?>' width='100'></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </table>
                    <input type="hidden" name="numA" value="<?php echo $j; ?>">
                    <input type="submit" name="borraA" value="Delete advertisement">
                </form>
                <?php
            } else if (isset($_POST['creaAnunciante'])) {
                ?>
        <form action="#" method="POST" onsubmit="return validaAnunciante()" >
                    <table>
                        <tr>
                            <td>Name of the advertiser: </td>
                            <td><input type="text" name="nombre"></td>
                        </tr>
                        <tr>
                            <td>Rate: </td>
                            <td><input type="text" name="tarifa"></td>
                        </tr>
                    </table>
                    <input type="submit" name="creaAn" value="Create advertser">
                </form>
                <?php
            } else if (isset($_POST['borraAnunciante'])) {
                $anunciantes = readAllAnunciante();
                ?>
                <form action="#" method="POST">
                    <table border = "2">
                        <tr>
                            <th></th>
                            <th>Advertiser</th>
                            <th>Rate</th>
                        </tr>
                        <?php
                        $j = 0;
                        if($anunciantes){
                        foreach ($anunciantes as $anunciante) {
                            ?>
                            <tr>
                                <td><input type="checkbox" name="<?php echo $j++; ?>" value="<?php echo $anunciante['idAnunciante']; ?>"></td>
                                <td><?php echo $anunciante['nombre']; ?></td>
                                <td><?php echo $anunciante['tarifa']; ?></td>
                            </tr>
                            <?php
                        }
                        }
                        ?>
                    </table>
                    <input type="hidden" name="numA" value="<?php echo $j; ?>">
                    <input type="submit" name="borraAn" value="Delete advertiser">
                </form>
                <?php
            }
        }
        ?>
        <footer id="footer">
            <div class="inner">
                <h2>Get In Touch</h2>
                <ul class="actions">
                    <li><i class="icon fa-phone"></i> <a href="#">(034)954 34 92 00</a></li>
                    <li><span class="icon fa-envelope"></span> <a href="#">moarnewspa@gmail.com</a></li>
                    <li><span class="icon fa-map-marker"></span> Ctra. de Utrera, 1, 41013 Sevilla </li>
                </ul>
            </div>
            <div class="copyright">
                &copy; Newspaper. MoarNews <a href="https://www.upo.es/portal/impe/web/portada/index.html">MoarNews</a>. Images <a href="../imagenes/logo.jpeg" alt="logo">MoarNews</a>.

            </div>
        </footer>
    </body>
</html>
