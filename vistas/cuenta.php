<!DOCTYPE html>
<?php
include("../CRUD/CRUDCuenta.php");
include("../CRUD/CRUDComentario.php");

function mediaPuntuacion($sumaTotal,$numComentarios){
    $res=$sumaTotal/$numComentarios;
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
        $_SESSION['cuentaID'] = 1;
        $_SESSION['nombreUsuario'] = "Pedro";

        if (!isset($_SESSION['cuentaID'])) {
            header('Location:inicioSesion.php');
        }
        if (isset($_SESSION['cuentaID'])) {
            $nombreUsuario = $_SESSION['nombreUsuario'];
            $idUsuario = $_SESSION['cuentaID'];
        }
        $datosPersonales = read($idUsuario);
        ?>
        <!--datos usuario--> 
        <h1> Datos <?php echo $nombreUsuario; ?></h1>
        <table cellpadding="10" border="1">
            <tr>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Clave</th>
                <th>Email</th>
                <th>Formato</th>
                <th>Tipo</th>
                <th>Discapacidad Visual</th>
                <th>Gustos</th>

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
        <?php if ($_SESSION['tipo'] === 'Usuario') {
            $comentarios = readAllComentariosFromID($idCuenta);
            ?>
            <table cellpadding="10" border="1">
                <tr>Comentario: </tr>
    <?php foreach ($comentarios as $comentario) { ?> 

                    <tr>
                        <td align='center'><?php echo $comentario['idComentario']; ?></td>
                        <td align='center'><?php echo $comentario['texto']; ?></td>
                        <td align='center'><?php echo $comentario['puntuacion']; ?></td>

                        <!--falta hacer la media de la puntuación-->
                    </tr>

                    <?php $sumaTotal= $comentario['puntuacion'] + $sumaTotal;
                          $numComentarios=$numComentarios+1; ?>

                <?php } $media=mediaPuntuacion($sumaTotal,$numComentarios); ?>
                    
                 <table cellpadding="10" border="1">
            <tr>
                <th>Nombre</th>     
                    
                <!--                si autor, listado de articulos-->
            <?php } else if ($_SESSION['tipo'] === 'autor') {
                $articulos = readArticulosFromID($idCuenta);
                ?>
                <table cellpadding="10" border="1">
                    <tr>Comentario: </tr>
    <?php foreach ($articulos as $articulo) { ?> 

                        <tr>
                            <td align='center'><?php echo $articulo['idArticulo']; ?></td>
                            <td align='center'><?php echo $articulo['fecha']; ?></td>
                            <td align='center'><?php echo $articulo['titulo']; ?></td>
                            <td align='center'><?php echo $articulo['descripcion']; ?></td>
                            <td align='center'><?php echo $articulo['imagen']; ?></td>
                            <td align='center'><?php echo $articulo['audio']; ?></td>
                            <td align='center'><?php echo $articulo['idSeccion']; ?></td>
                            <td align='center'><?php echo $articulo['idPortada']; ?></td>


                        </tr>
    <?php } ?>
<?php } else if ($_SESSION['tipo'] === 'administrador') { ?>

                    <div class="boton"><a href="gestionSeccion.php">Crear sección</a></div>
                    <div class="boton"><a href="gestionPortada.php">Crear portada</a></div>


<?php } ?>
                </body>
                </html>
