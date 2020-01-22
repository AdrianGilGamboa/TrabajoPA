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
        <title></title>
    </head>
    <body>
        <?php
        session_start();
//        $_SESSION['cuentaID'] = 1;
//        $_SESSION['nombreUsuario'] = "Pedro";
//        $_SESSION['tipo'] = "usuario";

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
                </body>
                <!--   boton  modificar cuenta.-->
                <footer id="footer">
                      <strong>Copyright Programaci&oacute;n Avanzada.</strong>
            <br>
            
                </footer>
                </html>

