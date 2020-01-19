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
                deleteArticulo($idArticulo);
            }
        } else if (isset($_POST['modifica'])) {
             $idAr = $_POST['modifica'];
             
          
        } else {
            if (isset($_POST['listarArt'])) {
                $articulosPorAutor = readArticulosFromID($idCuenta);
                ?>

                <table border = "2">
                    <tr>
                        <th></th>
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
                <form>
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
                    <input type="submit" name="borra" value="Borrar articulo">
                </form>

                <?php
            } else if (isset($_POST['modifArt'])) {
                $articulosPorAutor = readArticulosFromID($idCuenta);
                ?>
                <form>
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
                    <input type="submit" name="borra" value="Borrar articulo">
                </form>



                <?php
            } else if (isset($_POST['modifArt'])) {
                $articulosPorAutor = readArticulosFromID($idCuenta);
                ?>
                <form>
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
                                <td><input type="radio" name="articulo" value="<?php echo $articulo['idArticulo']; ?>"></td>
                                <td><?php echo $articulo['titulo']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                    <input type="hidden" name="numAr" value="<?php echo $j; ?>">
                    <input type="submit" name="modifica" value="Modificar articulo">
                </form>
                <?php
            }
        }
        ?>

    </body>
</html>
