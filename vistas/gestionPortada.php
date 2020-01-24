<!DOCTYPE html>
<?php
include ("../CRUD/CRUDSeccion.php");
include ("../CRUD/CRUDCuenta.php");
include ("../CRUD/CRUDArticulo.php");
include ("../CRUD/CRUDPortada.php");
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
    <body>
        <?php
        include_once 'nav.php';
        ?>
       
        <form action="#" method="POST">
            <input type="submit" name="creaPortada" value="Create Front Page">
            <input type="submit" name="modifPortada" value="Modify Front Page">
            <input type="submit" name="eliminaPortada" value="Delete Front Page">
        </form>
        <?php
        //      session_start();
        //     if(!isset($_SESSION['cuentaID'])){
        //         header('Location: inicioSesion.php');
        //     }
        if (isset($_SESSION['cuentaID'])) {
            if ($_SESSION['tipo'] === "administrador") {
                $idCuenta = $_SESSION['cuentaID'];
                $nombre = $_SESSION['nombreUsuario'];
            } else {
                header('Location: cuenta.php');
            }
        }

        $portadas = readAllPortada();
        $articulos = readAllArticulo();
        $secciones = readAllSeccion();
        if (isset($_POST['actualiza'])) {
            $idPortada = $_POST['portada'];
            $portada = readPortada($idPortada);


            $articulosEnPortada = leerArticulosDadaPortada($idPortada);
            ?>
            <form action="#" method="POST">
                Date: <input type="text" name="fecha" value="<?php echo $portada['fecha']; ?>"><br/> 

                <table border = "2">
                    <tr>
                        <th></th>
                        <th>Article to remove</th>
                    </tr>
                    <?php
                    $j = 0;
                    foreach ($articulosEnPortada as $articulo) {
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
                <input type="submit" name="crea" value="Create front page">
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
            foreach ($borrar as $idPortada) {
                deletePortada($idPortada);
            }
        } else {
            if (isset($_POST['crea'])) {
                $num = $_POST['numAr'];
                $fecha = $_POST['fecha'];
                $seleccionados = array();
                for ($i = 0; $i < $num; $i++) {
                    if (isset($_POST[$i])) {
                        array_push($seleccionados, $_POST[$i]);
                    }
                }
                $portada = array(
                    'fecha' => $fecha
                );
                if (createPortada($portada)) {
                    $idPortada = obtenerIDPortada($fecha);
                    echo $idPortada;
                    //asociarPortada($idCuenta, $idPortada);
                    $res = TRUE;
                    foreach ($seleccionados as $idArticulo) {
                        if (!asociarArticuloPortada($idArticulo, $idPortada)) {
                            $res = FALSE;
                        }
                    }
                    if ($res) {
                        echo "Bien";
                    } else {
                        echo "Mal";
                    }
                } else {
                    echo "Error al crear la portada";
                }
            } else {
                if (isset($_POST['creaPortada'])) {
                    ?>
                    <form action="#" method="POST">
                        Date: <input type="date" name="fecha" value="<?php echo date("Y-m-d"); ?>"><br/> 

                        <table border = "2">
                            <tr>
                                <th></th>
                                <th>Portada</th>
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
                        <input type="submit" name="crea" value="Create Front Page">
                    </form>
                    <?php
                } else if (isset($_POST['modifPortada'])) {
                    ?>
                    <form action="#" method="POST">
                        <?php
                        foreach ($portadas as $portada) {
                            ?>
                            <?php echo $portada['fecha']; ?><input type="radio" name="portada" value="<?php echo $portada['idPortada']; ?>"><br/>
                            <?php
                        }
                        ?>
                        <input type="submit" name="actualiza" value="Update Front Page">
                    </form>
                    <?php
                } else if (isset($_POST['eliminaPortada'])) {
                    ?>
                    <form action="#" method="POST">
                        <table border = "2">
                            <tr>
                                <th></th>
                                <th>Portada</th>
                            </tr>
                            <?php
                            $i = 0;
                            foreach ($portadas as $portada) {
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="<?php echo $i++; ?>" value="<?php echo $portada['idPortada']; ?>"></td>
                                    <td><?php echo $portada['fecha']; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                        <input type="hidden" name="numAr" value="<?php echo $i; ?>">
                        <input type="submit" name="borra" value="Delete front page">
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
