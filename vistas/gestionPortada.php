<!DOCTYPE html>
<?php
include ("../CRUD/CRUDSeccion.php");
include ("../CRUD/CRUDCuenta.php");
include ("../CRUD/CRUDArticulo.php");
include ("../CRUD/CRUDPortada.php");
include ("../CRUD/CRUDAnuncio.php");
?>
<style>

    form{
        text-align: center;
        margin-bottom:50px;

    }

    .wrong{
        text-align: center;
        color:red;
    }


</style>

<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content=="IE=edge"/>
        <meta name="google" value="notranslate"/>
        <link href="css.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <title></title>
        <script type="text/javascript">

        </script>
    </head>
    <body>


        <form action="#" method="POST">

            <input type="submit" name="creaPortada" value="Create Front Page">
            <input type="submit" name="modifPortada" value="Modify Front Page">
            <input type="submit" name="eliminaPortada" value="Delete Front Page">
            <input type="submit" name="listarPortada" value="View Front Pages">
        </form>
        <?php
        session_start();
//        if (!isset($_SESSION['cuentaID'])) {
//            header('Location: inicioSesion.php');
//
//        }
//
//        if (isset($_SESSION['cuentaID'])) {
//            if ($_SESSION['tipo'] === "administrador") {
//                $idCuenta = $_SESSION['cuentaID'];
//                $nombre = $_SESSION['nombreUsuario'];
//            } else {
//                header('Location: cuenta.php');
//            }
//        }

        include_once 'nav.php';

        $portadas = readAllPortada();
        $articulos = readAllArticulo();

        if (isset($_POST['añadeAnuncio'])) {
            $idPortada = $_POST['portada'];
            $portada = readPortada($idPortada);
            if (!tieneAnuncio($portada['idPortada'])) {

                $anuncioSinPortada = leerAnunciosSinPortada();
                if ($anuncioSinPortada) {
                    ?>
                    <form action="#" method="POST">
                        Date: <input type="date" name="fecha" value="<?php echo $portada['fecha']; ?>"><br/> 

                        <table border = "2">
                            <tr>
                                <th></th>
                                <th>Advertisements to add</th>
                            </tr>
                            <?php
                            foreach ($anuncioSinPortada as $anuncio) {
                                ?>
                                <tr>
                                    <td><input type="radio" name="anuncio" value="<?php echo $anuncio['idAnuncio']; ?>" required></td>
                                    <td><?php echo $anuncio['descripcion']; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                        <input type="submit" name="añadiendoAnuncio" value="Add advertisement" class="botonesGestionPortada">
                    </form>
                    <?php
                } else {
                    echo '<div class="wrong">No advertisement without associated fron pages</div>';
                }
            } else {
                echo '<div class="wrong">You already have an associated advertisement, you can modify it
</div>';
                $idPortada = $_POST['portada'];
                $portada = readPortada($idPortada);

                $anuncioSinPortada = leerAnunciosSinPortada();
                $anuncioActual = obtenerAnuncioDePortada($portada['idPortada']);
                if ($anuncioSinPortada) {
                    ?>
                    <form action="#" method="POST">

                        Date: <input type="date" name="fecha" value="<?php echo $portada['fecha']; ?>"><br/> 
                        Actual Advertisement: <?php echo $anuncioActual['descripcion']; ?>

                        <table border = "2">
                            <tr>
                                <th></th>
                                <th>Advertisements to change</th>
                            </tr>
                            <?php
                            foreach ($anuncioSinPortada as $anuncio) {
                                ?>
                                <tr>
                                    <td><input type="radio" name="anuncio" value="<?php echo $anuncio['idAnuncio']; ?>" required></td>
                                    <td><?php echo $anuncio['descripcion']; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                        <input type="submit" name="cambiandoAnuncio" value="Change advertisement" class="botonesGestionPortada">
                    </form>
                    <?php
                } else {
                    echo '<div class="wrong">No advertisement without associated fron pages</div>';
                }
            }
        }
        if (isset($_POST['cambiarAnuncio'])) {
            $idPortada = $_POST['portada'];
            $portada = readPortada($idPortada);
            if (tieneAnuncio($portada['idPortada'])) {
                $anuncioSinPortada = leerAnunciosSinPortada();
                $anuncioActual = obtenerAnuncioDePortada($portada['idPortada']);
                if ($anuncioSinPortada) {
                    ?>
                    <form action="#" method="POST">
                        Date: <input type="date" name="fecha" value="<?php echo $portada['fecha']; ?>"><br/> 
                        Actual Advertisement: <?php echo $anuncioActual['descripcion']; ?>
                        <table border = "2">
                            <tr>
                                <th></th>
                                <th>Advertisements to change</th>
                            </tr>
                            <?php
                            foreach ($anuncioSinPortada as $anuncio) {
                                ?>
                                <tr>
                                    <td><input type="radio" name="anuncio" value="<?php echo $anuncio['idAnuncio']; ?>" required></td>
                                    <td><?php echo $anuncio['descripcion']; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                        <input type="submit" name="cambiandoAnuncio" value="Change advertisement" class="botonesGestionPortada">
                    </form>
                    <?php
                } else {
                    echo '<div class="wrong">No advertisement without associated fron pages</div>';
                }
            } else {
                echo '<div class="wrong">You must first add an advertisement to modify it by another
</div>';
                $idPortada = $_POST['portada'];
                $portada = readPortada($idPortada);
                $anuncioSinPortada = leerAnunciosSinPortada();
                if ($anuncioSinPortada) {
                    ?>
                    <form action="#" method="POST">
                        Date: <input type="date" name="fecha" value="<?php echo $portada['fecha']; ?>"><br/> 

                        <table border = "2">
                            <tr>
                                <th></th>
                                <th>Advertisements to add</th>
                            </tr>
                            <?php
                            foreach ($anuncioSinPortada as $anuncio) {
                                ?>
                                <tr>
                                    <td><input type="radio" name="anuncio" value="<?php echo $anuncio['idAnuncio']; ?>" required></td>
                                    <td><?php echo $anuncio['descripcion']; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                        <input type="submit" name="añadiendoAnuncio" value="Add advertisement" class="botonesGestionPortada">
                    </form>
                    <?php
                } else {
                    echo '<div class="wrong">No advertisement without associated fron pages</div>';
                }
            }
        }

        if (isset($_POST['borraArticulo'])) {
            $idPortada = $_POST['portada'];
            $portada = readPortada($idPortada);


            $articulosEnPortada = leerArticulosDadaPortada($idPortada);
            if ($articulosEnPortada) {
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
                    <input type="submit" name="eliminandoArticulos" value="Delete articles" class="botonesGestionPortada">
                </form>
                <?php
            } else {
                echo '<div class="wrong">All items are associated with a front page
</div>';
            }
        }
        if (isset($_POST['añadeArticulo'])) {
            $idPortada = $_POST['portada'];
            $portada = readPortada($idPortada);


            $articulosSinPortada = leerArticulosSinPortada();
            if ($articulosSinPortada) {
                ?>
                <form action="#" method="POST">
                    Date: <input type="date" name="fecha" value="<?php echo $portada['fecha']; ?>"><br/> 

                    <table border = "2">
                        <tr>
                            <th></th>
                            <th>Articles to add</th>
                        </tr>
                        <?php
                        $j = 0;
                        foreach ($articulosSinPortada as $articulo) {
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
                    <input type="submit" name="añadiendoArticulos" value="Add articles" class="botonesGestionPortada">
                </form>
                <?php
            } else {
                echo '<div class="wrong">
There are no articles without front pages</div>';
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
            foreach ($borrar as $idPortada) {
                //$idPortada = obtenerIDPortada($fecha);
                if (quitarArticulosDePortada($idPortada)) {
                    deletePortada($idPortada);
                } else {
                    echo '<div class="wrong">
ERROR, the front page advertisement could not be removed</div>';
                }
            }
        } else if (isset($_POST['añadiendoArticulos'])) {
            $num = $_POST['numAr'];
            $fecha = $_POST['fecha'];
            $seleccionados = array();
            for ($i = 0; $i < $num; $i++) {
                if (isset($_POST[$i])) {
                    array_push($seleccionados, $_POST[$i]);
                }
            }
            $idPortada = obtenerIDPortada($fecha);
            $res = TRUE;
            foreach ($seleccionados as $idArticulo) {
                if (!asociarArticuloPortada($idArticulo, $idPortada)) {
                    $res = FALSE;
                }
            }
        } else if (isset($_POST['eliminandoArticulos'])) {
            $num = $_POST['numAr'];
            $fecha = $_POST['fecha'];
            $seleccionados = array();
            for ($i = 0; $i < $num; $i++) {
                if (isset($_POST[$i])) {
                    array_push($seleccionados, $_POST[$i]);
                }
            }
            $idPortada = obtenerIDPortada($fecha);
            $res = TRUE;
            foreach ($seleccionados as $idArticulo) {
                if (!quitarArticuloDePortada($idArticulo)) {
                    $res = FALSE;
                }
            }
        } else if (isset($_POST['añadiendoAnuncio'])) {
            //$num = $_POST['numAr'];
            $idAnuncio = $_POST['anuncio'];
            $fecha = $_POST['fecha'];
            $idPortada = obtenerIDPortada($fecha);
            echo $idPortada;
            $res = TRUE;

            if (!asociarAnuncioPortada($idAnuncio, $idPortada)) {
                $res = FALSE;
            }
        } else if (isset($_POST['cambiandoAnuncio'])) {
            $idAnuncio = $_POST['anuncio'];
            $fecha = $_POST['fecha'];
            $idPortada = obtenerIDPortada($fecha);
            quitarAnuncioDePortada($idPortada);
            $res = TRUE;

            if (!asociarAnuncioPortada($idAnuncio, $idPortada)) {
                $res = FALSE;
            }
        }
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
                asociarPortada($idCuenta, $idPortada);
                $res = TRUE;
                foreach ($seleccionados as $idArticulo) {
                    if (!asociarArticuloPortada($idArticulo, $idPortada)) {
                        $res = FALSE;
                    }
                }
            } else {
                echo '<div class="wrong">ERROR to create cover
</div>';
            }
        }
        if (isset($_POST['creaPortada'])) {
            ?>
            <form action="#" method="POST">
                Date: <input type="date" name="fecha" value="<?php echo date("Y-m-d"); ?>"><br/> 

                <table border = "2">
                    <tr>
                        <th></th>
                        <th>Articles to insert</th>
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
                <input type="submit" name="crea" value="Create Front Page" class="botonesGestionPortada">
            </form>
            <?php
        } else if (isset($_POST['modifPortada']) || isset($_POST['eliminandoArticulos']) || isset($_POST['añadiendoArticulos']) || isset($_POST['añadiendoAnuncio']) || isset($_POST['cambiandoAnuncio'])) {
            if ($portadas) {
                ?>
                
                <form action="#" method="POST">
                    <table border="2">
                        <tr>
                        <th>Fecha</th>
                        <th></th>
                        </tr>
                        <?php
                        foreach ($portadas as $portada) {
                            ?><tr>
                            <td><?php echo $portada['fecha']; ?></td><td><input type="radio" name="portada" value="<?php echo $portada['idPortada']; ?>" required></td>
                            </tr><?php
                        }
                        ?>
                    </table>
                    
                    <input type="submit" name="borraArticulo" value="Delete articles" class="botonesGestionPortada">
                    <input type="submit" name="añadeArticulo" value="Add articles" class="botonesGestionPortada">
                    <input type="submit" name="añadeAnuncio" value="Add advertisement" class="botonesGestionPortada">
                    <input type="submit" name="cambiarAnuncio" value="Change advertisement" class="botonesGestionPortada">
                </form>
                <?php
            } else {
                echo '<div class="wrong">No Front Pages created</div>';
            }
        } else if (isset($_POST['eliminaPortada'])) {
            if ($portadas) {
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
                    <input type="submit" name="borra" value="Delete front page" class="botonesGestionPortada">
                </form>
                <?php
            } else {
                echo '<div class="wrong">No Front Pages created</div>';
            }
        } else if (isset($_POST['listarPortada'])) {
            $portadas = readAllPortada();
            if ($portadas) {
                ?>
        
                <table border = "2" style="width:60%;">
                    <tr>

                        <th>Date</th>
                        <th>Author User</th>
                        <th>Author Name</th>
                        <th>Articles</th>
                        <th>Advertisement</th>

                    </tr>
                    <?php
                    foreach ($portadas as $portada) {
                        ?>
                        <tr>

                            <td><?php echo $portada['fecha']; ?></td>
                            <td><?php
                                $autor = readPortada($portada['idPortada']);
                                $autor2 = readCuenta($autor['idCuenta']);
                                echo $autor2['usuario'];
                                ?></td>
                            <td><?php
                                echo $autor2['nombre'];
                                ?></td>
                            <td>
                                <?php
                                $articulos = leerArticulosDadaPortada($portada['idPortada']);
                                if ($articulos) {
                                    ?>
                                    <ul>
                                        <?php
                                        foreach ($articulos as $articulo) {
                                            ?> <li> <?php echo $articulo['titulo']; ?> </li> <?php
                                        }
                                        ?>
                                    </ul>
                                <?php } ?>
                            </td>
                            <td>
                                <?php
                                if ($portada['idAnuncio']) {
                                    $anuncio = readAnuncio($portada['idAnuncio']);
                                    echo $anuncio['descripcion'];
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
        

                <?php
            } else {
                echo "No Front Pages created";
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
