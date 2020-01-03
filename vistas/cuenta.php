<!DOCTYPE html>
<?php

include("../CRUD/CRUDCuenta.php");?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_start();
        $_SESSION['cuentaID']=1;
        $_SESSION['nombreUsuario']="Pedro";
        
        if (!isset($_SESSION['cuentaID'])) {
            header('Location:inicioSesion.php');
        }
        if (isset($_SESSION['cuentaID'])) {
            $nombreUsuario = $_SESSION['nombreUsuario'];
            $idUsuario = $_SESSION['cuentaID'];
        }
        $datosPersonales = read($idUsuario);
        ?>
        //datos usuario 
        <h1> Datos usuario <?php echo $nombreUsuario; ?></h1>
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

    </body>
</html>
