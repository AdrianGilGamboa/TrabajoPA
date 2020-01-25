<!DOCTYPE html>
<?php
include_once("../CRUD/CRUDCuenta.php");
include_once("../CRUD/CRUDComentario.php");
include_once("../CRUD/CRUDArticulo.php");

function mediaPuntuacion($sumaTotal, $numComentarios) {
    return $res = $sumaTotal / $numComentarios;
}
?>
<html>
   <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content=="IE=edge"/>
        <meta name="google" value="notranslate"/>
        <link href="css.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <title>Count</title>
    </head>
    <body>
        <?php
        session_start();

        if (!isset($_SESSION['cuentaID'])) {
            header('Location:inicioSesion.php');
        }
        if (isset($_SESSION['cuentaID'])) {
            $nombreUsuario = $_SESSION['nombreUsuario'];
            $idUsuario = $_SESSION['cuentaID'];
        }
        $datosPersonales = readCuenta($idUsuario);
        ?>
        <!--datos usuario--> 
        <?php
        include_once 'nav.php';
        ?>
        
        <h1> Datos <?php echo $nombreUsuario; ?></h1>
        <table cellpadding="10" border="1">
            <tr>
                <th>Name</th>
                <th>User</th>
                <th>Password</th>
                <th>Email</th>
                <th>Formato</th>
                <th>Type</th>
                <th>Visual disability</th>
                <th>Preferences</th>

            </tr>
            <tr>
                <td align='center'><?php echo $datosPersonales['nombre']; ?></td>
                <td align='center'><?php echo $datosPersonales['usuario']; ?></td>
                <td align='center'><?php echo $datosPersonales['clave']; ?></td>
                <td align='center'><?php echo $datosPersonales['email']; ?></td>
                <td align='center'><?php echo $datosPersonales['formato']; ?></td>
                <td align='center'><?php echo $datosPersonales['tipo']; ?></td>
                <td align='center'><?php echo $datosPersonales['Dv']; ?></td>
                <?php $gustos = explode(";", $datosPersonales['gustos']); ?>
                <td align='center'>
                    <ul type="square">
                        <?php
                        for ($index = 0; $index < count($gustos); $index++) {
                            echo "<li> $gustos[$index] </li>";
                        }
                        ?>
                    </ul>
                </td>
            </tr> 
        </table>
        <?php
        if ($_SESSION['tipo'] === 'usuario') {
            $sumaTotal = 0;
            $comentarios = readAllComentariosFromID($idUsuario);
            ?>
            <table cellpadding="10" border="1">
                <tr>Comments: </tr>
                <!--                comprobar si es mayor que 0, osea que no este vacio-->

                <?php if ($comentarios) { ?>
                    <?php foreach ($comentarios as $comentario) { ?> 

                        <tr>
                            <th>identifier: </th>     
                            <th>text: </th>     
                            <th>puntuation: </th>     
                        </tr>
                        <tr>
                            <td align='center'><?php echo $comentario['idComentario']; ?></td>
                            <td align='center'><?php echo $comentario['texto']; ?></td>
                            <td align='center'><?php echo $comentario['puntuacion']; ?></td>


                            <!--falta hacer la media de la puntuación-->
                        </tr>

                        <?php $sumaTotal = $comentario['puntuacion'] + $sumaTotal;
                        ?>

                    <?php } $media = mediaPuntuacion($sumaTotal, count($comentarios)); ?>

                    <table cellpadding="10" border="1">
                        <tr>
                            <th>Average score comments: </th>     
                        </tr>
                        <tr>
                            <td align='center'><?php echo $media; ?></td>
                        </tr>

                        <!--                si autor, listado de articulos-->
                        <?php
                    } else {
                        echo "There is no comments associated to this account";
                    }
                    ?>
                    <?php
                } else if ($_SESSION['tipo'] === 'autor') {
                    $articulos = readArticulosFromID($idUsuario);
                    ?>
                    <table cellpadding="10" border="1">
                        <tr>Articles: </tr>
                        <?php foreach ($articulos as $articulo) { ?> 

                            <tr>
                                <td align='center'><?php echo $articulo['idArticulo']; ?></td>
                                <td align='center'><?php echo $articulo['fecha']; ?></td>
                                <td align='center'><?php echo $articulo['titulo']; ?></td>
                                <td align='center'><?php echo $articulo['descripcion']; ?></td>
                                <td align='center'><?php echo $articulo['imagen']; ?></td>
                                <td align='center'><?php echo $articulo['audio']; ?></td>
                            </tr>

                        <?php }
                        ?>
                    </table>
                    <div class="boton"><a href="gestionArticulo.php">Article management</a></div>
                <?php } else if ($_SESSION['tipo'] === 'administrador') { ?>

                    <div class="boton"><a href="gestionSeccion.php">Create section</a></div>

                    <div class="boton"><a href="gestionPortada.php">Create front page</a></div>

                    <div class="boton"><a href="gestionAnuncios.php">Advertisement management</a></div>


                <?php }
                ?>
                <div class="boton"><a href="modificarCuenta.php">Modify account</a></div>
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

