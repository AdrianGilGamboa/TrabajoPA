<!DOCTYPE html>
<?php
include_once ("../CRUD/CRUDSeccion.php");
include_once ("../CRUD/CRUDCuenta.php");
include_once ("../CRUD/CRUDArticulo.php");

function tiene($misArticulos, $articulo) {
    $resul = FALSE;
    if (!($misArticulos)) {
        return FALSE;
    }
    foreach ($misArticulos as $value) {
        if ($value['idArticulo'] === $articulo) {
            $resul = TRUE;
        }
    }
    return $resul;
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content=="IE=edge"/>
        <meta name="google" value="notranslate"/>
        <link href="css.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <title></title>
    </head>
    <body class="inner">
        <form  class="actions" action="#" method="POST">
            <input class="button special fit small"  type="submit" name="creaSect" value="Create Section">
            <input class="button special fit small"type="submit" name="modifSect" value="Modify Section">
            <input class="button special fit small" type="submit" name="eliminaSect" value="Delete Section">
        </form>


        <?php
        session_start();
        if (!isset($_SESSION['cuentaID'])) {
            header('Location: inicioSesion.php');
        }
        if (isset($_SESSION['cuentaID'])) {
            if ($_SESSION['tipo'] === "administrador") {
                $idCuenta = $_SESSION['cuentaID'];
                $nombre = $_SESSION['nombreUsuario'];
            } else {
                header('Location: cuenta.php');
            }
        }

        include_once 'nav.php';

        $secciones = readAllSeccion();
        $articulos = readAllArticulo();
        if (isset($_POST['confirmar'])) {
            $idSecction = $_POST['idSec'];
            if (isset($_POST['numAr'])) {
                $numAr = $_POST['numAr'];
                $borrar = array();
                for ($i = 0; $i < $numAr; $i++) {
                    if (isset($_POST[$i])) {
                        array_push($borrar, $_POST[$i]);
                    }
                }
                foreach ($borrar as $id) {
                    borraSeccionDeArticulo($id);
                }
            }


            echo "Seccion actualizada";
        }
        if (isset($_POST['confirmar2'])) {
            $idSecction = $_POST['idSec'];
            if (isset($_POST['numAr2'])) {
                $numAr2 = $_POST['numAr2'];
                $actualizar = array();
                for ($i = 0; $i < $numAr2; $i++) {
                    if (isset($_POST[$i])) {
                        array_push($actualizar, $_POST[$i]);
                    }
                }
                foreach ($actualizar as $id) {

                    asociarArticulo($id, $idSecction);
                }
            }


            echo "Seccion actualizada";
        }
        if (isset($_POST['actualiza'])) {
            $idSeccion = $_POST['seccion'];
            $seccion = readSeccion($idSeccion);
            $articulosEnSeccion = leerArticulosDadaSeccion($idSeccion);
            ?>
            <form action="#" method="POST">
                <table border = "2" >
                    <caption>Articles to delete</caption>
                    <tr>
                        <th></th>
                        <th>Articles</th>
                    </tr>
                    <?php
                    $j = 0;
                    if ($articulosEnSeccion) {
                        foreach ($articulosEnSeccion as $articulo) {
                            ?>
                            <tr>
                                <td><input type="checkbox" name="<?php echo $j++; ?>" value="<?php echo $articulo['idArticulo']; ?>"></td>
                                <td><?php echo $articulo['titulo']; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
                <input type="hidden" name="numAr" value="<?php echo $j; ?>">              
                <input type="hidden" name="idSec" value="<?php echo $idSeccion; ?>">
                <input type="submit" name="confirmar" value="Delete">
            </form>
            <form action="#" method="POST">
                <table border = "2">
                    <caption>Articles to add</caption>
                    <tr>
                        <th></th>
                        <th>Articles</th>
                    </tr>
                    <?php
                    $i = 0;
                    foreach ($articulos as $articulo) {
                        if (!tiene($articulosEnSeccion, $articulo['idArticulo'])) {
                            ?>
                            <tr>
                                <td><input type="checkbox" name="<?php echo $i++; ?>" value="<?php echo $articulo['idArticulo']; ?>"></td>
                                <td><?php echo $articulo['titulo']; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
                <input type="hidden" name="numAr2" value="<?php echo $i; ?>">
                <input type="hidden" name="idSec" value="<?php echo $idSeccion; ?>">
                <input type="submit" name="confirmar2" value="Add">
            </form>
            <?php
        }
        if (isset($_POST['borra'])) {
            $num = $_POST['numAr'];
            $borrar = array();
            for ($i = 0; $i < $num; $i++) {
                if (isset($_POST[$i])) {
                    array_push($borrar, $_POST[$i]);
                }
            }
            foreach ($borrar as $idSeccion) {
                deleteSeccion($idSeccion);
            }
        } else {
            if (isset($_POST['crea'])) {
                $num = $_POST['numAr'];
                $nomCat = $_POST['categoria'];
                $seleccionados = array();
                for ($i = 0; $i < $num; $i++) {
                    if (isset($_POST[$i])) {
                        array_push($seleccionados, $_POST[$i]);
                    }
                }
                $seccion = array(
                    'categoria' => $nomCat
                );
                if (createSeccion($seccion)) {
                    $idSeccion = obtenerID($nomCat);
                    asociarSeccion($idCuenta, $idSeccion);
                    $res = TRUE;
                    foreach ($seleccionados as $idArticulo) {
                        if (!asociarArticulo($idArticulo, $idSeccion)) {
                            $res = FALSE;
                        }
                    }
                    if ($res) {
                        echo "Bien";
                    } else {
                        echo "Mal";
                    }
                } else {
                    echo "Error al crear seccion";
                }
            } else {
                if (isset($_POST['creaSect'])) {
                    ?>
                    <form action="#" method="POST">
                        Categor&iacute;a: <input type="text" name="categoria"><br/> 

                        <table border = "2">
                            <tr>
                                <th></th>
                                <th>Articles</th>
                            </tr>
                            <?php
                            $j = 0;
                            foreach ($articulos as $articulo) {
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
                        <input type="submit" name="crea" value="Crear Seccion">
                    </form>
                    <?php
                } else if (isset($_POST['modifSect'])) {
                    ?>
                    <form action="#" method="POST">
                        <?php
                        foreach ($secciones as $seccion) {
                            ?>
                            <?php echo $seccion['categoria']; ?><input type="radio" name="seccion" value="<?php echo $seccion['idSeccion']; ?>"><br/>
                            <?php
                        }
                        ?>
                        <input type="submit" name="actualiza" value="Actualizar Seccion">
                    </form>
                    <?php
                } else if (isset($_POST['eliminaSect'])) {
                    ?>
                    <form action="#" method="POST">
                        <table border = "2">
                            <tr>
                                <th></th>
                                <th>Section</th>
                            </tr>
                            <?php
                            $i = 0;
                            foreach ($secciones as $seccion) {
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="<?php echo $i++; ?>" value="<?php echo $seccion['idSeccion']; ?>"></td>
                                    <td><?php echo $seccion['categoria']; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                        <input type="hidden" name="numAr" value="<?php echo $i; ?>">
                        <input type="submit" name="borra" value="Borrar Seccion">
                    </form>
                    <?php
                }
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
