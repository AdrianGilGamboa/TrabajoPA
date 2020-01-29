<?php
include_once ('../CRUD/CRUDArticulo.php');
include_once ('../CRUD/CRUDSeccion.php');
include_once ('../CRUD/CRUDCuenta.php');
include_once ('../CRUD/CRUDAnuncio.php');
include_once ('../CRUD/CRUDComentario.php');
session_start();


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title classs="centrar"><?php
            $idSeccion = $_GET['idSeccion'];
            $seccion = readSeccionId($idSeccion);
            echo $seccion['categoria'];
            ?></title>
        <link href="css.css" rel="stylesheet" type="text/css"/>
        <meta http-equiv="X-UA-Compatible" content=="IE=edge"/>
        <meta name="google" value="notranslate"/>
        <script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
        <script src="../js/jquery.zoom.min.js" type="text/javascript"></script>
        <script src="../js/scripts.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <style>
            aside
            {

                position: sticky;
                position: -webkit-sticky;
                top: 100px;
                font: 45px 'Abril Fatface', sans-serif;
                color: #fff;
                text-align: center;
            }
            aside img{

                top: 100px;
                margin-top: 20px;
                width: 90%;
            }

            table{
                border-collapse: collapse;
            }

        </style>

        <script type="text/javascript">
            <!--
            var imagenes;
            var timeout;

            function init() {

                n = 0;
                imagenes = new Array();
            <?php
            $articulos = mostrarArticulos($idSeccion);
            if ($articulos) {
                foreach ($articulos as $articulo) {
                    ?>
                        imagenes[n] = new Array();
                    <?php
                    $anuncio = leerAnuncioDadoArticulo($articulo['idArticulo']);
                    ?>
                        imagenes[n][0] = "<img src='../anuncios/<?php echo $anuncio['imagen']; ?>'>";
                        imagenes[n][1] ="<?php echo $anuncio['descripcion']; ?>";
                        imagenes[n][2]="<?php  echo $anuncio['duracion']; ?>";
                        n++;
                    <?php
                }
            }
            ?>
                              

                generarVistaImagenes(imagenes[0], 0);
                }    

            function generarVistaImagenes(imagenSelected, j) {
                var imagenCompleta = document.getElementById("imagen_completa");
                //var listaImagenesMini = document.getElementById("listado_otras_imagenes");

                while (imagenCompleta.firstChild) {

                    imagenCompleta.removeChild(imagenCompleta.firstChild);
                }

                // while (listaImagenesMini.firstChild) {

                //     listaImagenesMini.removeChild(listaImagenesMini.firstChild);
                // }

                var imagen = document.createElement("div");
                imagen.innerHTML = imagenSelected[0];

                var tituloImagen = document.createElement("span");
                tituloImagen.innerText = imagenSelected[1];


                imagenCompleta.appendChild(imagen);
                imagenCompleta.appendChild(tituloImagen);

                var lista = document.createElement("UL");
                for (var i = 0; i < imagenes.length; i++) {

                    var imagenAux = imagenes[i];
                    var li = document.createElement("LI");
                    li.setAttribute("onclick", "verImagen(this)");
                    li.setAttribute("id", "imagen_" + i);
                    li.innerHTML = imagenAux[0];
                    lista.appendChild(li);
                }

                //listaImagenesMini.appendChild(lista);

                timeout = setTimeout(function () {
                    j++;

                    generarVistaImagenes(imagenes[j % n], (j % n));
                }, imagenSelected[2]*1000);
            }

            function verImagen(imagen) {

                clearTimeout(timeout);

                var index = imagen.getAttribute("id").split("_")[1];
                var imagenSelected = imagenes[index];
                imagenes.toString();

                generarVistaImagenes(imagenSelected, index + 1);
            }
            //-->
        </script>


    </head>

    <body onload="init();">
            <?php
            $hayCuenta = FALSE;
            if (isset($_SESSION['cuentaID'])) {
                $hayCuenta = TRUE;
                $nombreUsuario = $_SESSION['nombreUsuario'];
                $idUsuario = $_SESSION['cuentaID'];
                $datosPersonales = readCuenta($idUsuario);
            } else {
                $hayCuenta = FALSE;
            }
            if (isset($_POST['like'])) {
                $idComentario = $_POST['idComentario'];
                meGusta($idComentario);
            } else if (isset($_POST['dislike'])) {
                $idComentario = $_POST['idComentario'];
                noMeGusta($idComentario);
            }
            ?>
        <header id="header">

            <?php
            if ($hayCuenta) {
                ?>

                <nav class="left">
                    <a href="#" class="button alt" ><?php echo date("Y-m-d") ?> </a>
                </nav>

                <a href="portada.php" class="logo">MoarNews</a>
                <nav class="right">
                    <a href="suscripcion.php" class="button alt" >Suscribe</a>
                    <a href="cuenta.php" class="button alt"><?php echo $nombreUsuario; ?></a>  
                </nav>


                <?php
            }
            ?>
            <?php
            if (!$hayCuenta) {
                ?>
                <nav class="left">
                    <a href="#" class="button alt" ><?php echo date("Y-m-d") ?> </a>
                </nav>

                <a href="portada.php" class="logo">MoarNews</a>
                <nav class="right">
                    <a href="inicioSesion.php"class="button alt">Log in</a>
                    <a href="registro.php"  class="button alt">Register</a>
                </nav>
                <?php
            }
            ?>

        </header>
        <?php
        include_once 'nav.php';

        $seccion = readSeccionId($idSeccion);
        
        ?>

        <aside id="imagen_completa">
        </aside>
        <div id="listado_otras_imagenes">
        </div>
        <section class="inner">

            <h3>Section <?php echo $seccion['categoria']; ?></h3>


            <?php
            //echo $articulo['titulo'];
            if ($articulos) {
                foreach ($articulos as $articulo) {
                    $autor = readCuenta($articulo['idCuenta']);
                    ?>



                    
                        <article>

                            <a href="articulo.php?idArticulo=<?php echo $articulo['idArticulo']; ?>"><h1><?php echo $articulo['titulo']; ?></h1></a>

                            <div class="image">

                                <img class="imagenes" src="../imagenes/<?php echo $articulo['imagen']; ?>"alt='<?php echo $articulo['imagen']; ?>' >

                            </div>
                            <?php
                            if ($hayCuenta) {
                                if ($datosPersonales['Dv']) {
                                    ?>
                                    <div class="audioArticulo">
                                        <?php if ($articulo['audio'] != NULL) { ?>
                                            <audio controls>
                                                <source src="<?php echo '../audios/' . $articulo['audio']; ?>" type="audio/mpeg">
                                            </audio>
                                        <?php } ?>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                            <div >
                                <h3><?php echo $articulo['descripcion']; ?></h3> 
                            </div>
                            <div>
                                <p> <?php echo $articulo['texto']; ?></p>
                            </div>
                            <div class="fechaArticulo">
                                <?php echo $articulo['fecha']; ?>
                            </div>
                            <div>
                                <h5><?php echo $autor['nombre']; ?></h5>
                            </div>
                            <div class="seccionArticulo">
                                <?php
                                $secciones = leerSeccionDadoArticulo($articulo['idArticulo']);

                                if ($secciones) {
                                    foreach ($secciones as $seccion) {
                                        ?>
                                        <a href="seccion.php?idSeccion=<?php echo $seccion['idSeccion']; ?>"><?php echo $seccion['categoria']; ?></a><?php
                                    }
                                }
                                ?>
                            </div>
                            <form  action="comentario.php" method="POST" style="margin-left: 0px; margin-top:20px;margin-bottom:20px;">
                                <input type="hidden" name="articulo" value="<?php echo $articulo['idArticulo']; ?>">
                                <input type="hidden" name="cuenta" value="<?php echo $idUsuario; ?>">
                                <input class="button special fit small" type="submit" name="comentar" value="Comment article">
                            </form>
                        </article>
                        <article>
                            <div class="table-wrapper" style="width:auto">
                                <?php
                                $comentarios = readComentariosArticuloPortada($articulo['idArticulo']);
                                if ($comentarios) {

                                    foreach ($comentarios as $comentario) {
                                        ?><table style="margin-bottom: 0px;margin-top: 0px; width:100%"><tr>

                                                <td> <?php
                                                    $autor = cuentaDadoComentario($comentario['idCuenta']);
                                                    ?>
                                                    <span style="color: <?php
                                                    if ($autor['formato'] === "gold") {
                                                        echo "gold";
                                                    } else if ($autor['formato'] === "silver") {
                                                        echo "silver";
                                                    } else if ($autor['formato'] === "bronze") {
                                                        echo "brown";
                                                    }
                                                    ?>">

                                                        <?php echo $comentario['texto']; ?><br> </span>
                                                    <p style="text-align: right; margin:0px"><?php echo $autor['nombre']; ?></p></td>
                                                <td> <?php
                                                    $puntuacion = $comentario['puntuacion'];
                                                    ?>
                                                    <span style=" color: <?php
                                                    if ($autor['formato'] === "gold") {
                                                        echo "gold";
                                                    } else if ($autor['formato'] === "silver") {
                                                        echo "silver";
                                                    } else if ($autor['formato'] === "bronze") {
                                                        echo "brown";
                                                    }
                                                    ?>">Likes: <?php echo $puntuacion; ?></span><br>
                                                          <?php
                                                          $puntuacionNegativa = $comentario['puntuacionNegativa'];
                                                          ?>
                                                    <span style=" color: <?php
                                                    if ($autor['formato'] === "gold") {
                                                        echo "gold";
                                                    } else if ($autor['formato'] === "silver") {
                                                        echo "silver";
                                                    } else if ($autor['formato'] === "bronze") {
                                                        echo "brown";
                                                    }
                                                    ?>">Dislikes: <?php echo $puntuacionNegativa; ?></span>

                                                </td>
                                                <?php if ($hayCuenta) { ?>
                                                    <td> <form action="#" method="POST" style="padding: 0px;margin: 0px;">
                                                            <ul class="actions vertical small">
                                                                <input type="hidden" name="idComentario" value="<?php echo $comentario['idComentario']; ?>">
                                                                <li>
                                                                    <i class="fa fa-thumbs-o-up fa-lg" aria-hidden="true"></i>
                                                                    <input class="nav-text" type="submit" name="like" value="like" style="background-color: green">

                                                                </li>
                                                                <li>
                                                                    <i class="fa fa-thumbs-o-down fa-lg" aria-hidden="true" ></i>
                                                                    <input class="nav-text" type="submit" name="dislike" value="dislike" style="background-color: red">
                                                                </li>
                                                            </ul>
                                                        </form></td> <?php } ?>

                                            </tr></table>
                                        <?php
                                        if ($hayCuenta) {
                                            ?>


                                            <form action="comentario.php" method="POST" style="margin-top: 0px;padding-top: 0px;padding-bottom: 0px;margin-left: 0px;margin-bottom: 20px;">

                                                <input type="hidden" name="articulo" value="<?php echo $articulo['idArticulo']; ?>">
                                                <input type="hidden" name="cuenta" value="<?php echo $idUsuario; ?>">
                                                <input type="hidden" name="comentario" value="<?php echo $comentario['idComentario']; ?>">
                                                <input class="small" type="submit" name="responder" value="Reply comment">
                                            </form>

                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </article> <hr>
                    <?php
                }
            }
            ?>

        </section> </a>
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
