<!DOCTYPE html>
<?php
include_once ("../CRUD/CRUDAnuncio.php");
include_once ("../CRUD/CRUDAnunciante.php");
?>
<html>
    <head>
        <meta charset="UTF-8">
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
            if ($descripcion === "" or ! preg_match('/^[[:alpha:]]+$/', $descripcion)) {
                $insertar = False; //hacer con JS
                echo "DESCRIPCION erronea";
            }
            $duracion = $_POST['duracion'];
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
                if (createAnuncio($anuncio)) {
                    move_uploaded_file($imagen['tmp_name'], '../anuncios/' . $nombreImagen);
                    echo "Article created";
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
                unlink("../anuncios/".$anuncio['imagen']);
                deleteAnuncio($idAnuncio);
            }
        } else if (isset($_POST['creaAn'])) {
            
        } else if (isset($_POST['borraAn'])) {
            
        } else {
            if (isset($_POST['creaAnuncio'])) {
                ?>
                <form action="#" method="POST" enctype="multipart/form-data">
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
                        <input type="submit" name="creaA" value="Create advertisement">
                    </table>
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
                        foreach ($anuncios as $anuncio) {
                            ?>
                            <tr>
                                <td><input type="checkbox" name="<?php echo $j++; ?>" value="<?php echo $anuncio['idAnuncio']; ?>"></td>
                                <td><?php echo $anuncio['descripcion']; ?></td>
                                <td><img src="../anuncios/<?php echo $anuncio['imagen']; ?>" alt='<?php echo $anuncio['imagen']; ?>' width='100'></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                    <input type="hidden" name="numA" value="<?php echo $j; ?>">
                    <input type="submit" name="borraA" value="Delete advertisement">
                </form>
                <?php
            } else if (isset($_POST['creaAnunciante'])) {
                
            } else if (isset($_POST['borraAnunciante'])) {
                
            }
        }
        ?>
    </body>
</html>
