<!DOCTYPE html>
<?php
include_once ("../CRUD/CRUDSeccion.php");
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
            <input type="submit" name="creaSect" value="Crear Seccion">
            <input type="submit" name="modifSect" value="Modificar Seccion">
            <input type="submit" name="eliminaSect" value="Eliminar Seccion">
        </form>
        <?php
        session_start();
//        if(!isset($_SESSION['cuentaID'])){
//            header('Location: inicioSesion.php');
//        }
        if (isset($_SESSION['cuentaID'])) {
            if ($_SESSION['tipo'] === "administrador") {
                $idCuenta = $_SESSION['cuentaID'];
                $nombre = $_SESSION['nombreUsuario'];
            } else {
                header('Location: cuenta.php');
            }
        }

        $articulos = readAllArticulo();
        $secciones = readAllSeccion();
        if(isset($_POST['actualiza'])){
            $idSeccion = $_POST['seccion'];
            $seccion = readSeccion($idSeccion);
            $articulosEnSeccion = leerArticulosDadaSeccion($idSeccion);
            ?>
                    <form action="#" method="POST">
                        Categor&iacute;a: <input type="text" name="categoria" value="<?php echo $seccion['categoria'];?>"><br/> 

                        <table border = "2">
                            <tr>
                                <th></th>
                                <th>Articulo a borrar</th>
                            </tr>
                            <?php
                            $j = 0;
                            foreach ($articulosEnSeccion as $articulo) {
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
                                <th>Articulo</th>
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
                                <th>Seccion</th>
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

    </body>
</html>
