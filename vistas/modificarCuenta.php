<!DOCTYPE html>
<?php 
include_once("../CRUD/CRUDCuenta.php");
include_once("../CRUD/CRUDSeccion.php");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
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
        $secciones = readAllSeccion();
        if (isset($_POST['btnActualizar'])){
//            METER LOS DATOS DE PEDRO
                 $cuenta = array(
            'id' => 2,
            'nombre' => $_POST['nombre'],
            'usuario' =>  $_POST['nombre'],
            'clave' =>  $_POST['nombre'],
            'email' =>  $_POST['nombre'],
         
        );
        
            if(updateCuenta($cuenta)){
                header('Location:cuenta.php');
            }else{
               echo "error al actualizar los datos";
            }
        }
        ?>
        <form action="#" method="POST">
            Nombre: <input type="text" name="nombre" value="<?php echo $datosPersonales['nombre'];?>"><br/>
            Usuario: <input type="text" name="usuario" value="<?php echo $datosPersonales['usuario'];?>"><br/>
            Clave: <input type="password" name="clave"><br/>
            Email: <input type="text" name="email" value ="<?php echo $datosPersonales['email'];?>"><br/>
            Gustos: <br/>
            <?php
            foreach ($secciones as $seccion) {
                echo $seccion['categoria'];?>
                <input type="checkbox" name="<?php echo $seccion['categoria'];?>" value="<?php echo $seccion['categoria'];?>"><br/>
                <?php
            }
            ?>
            Discapacidad visual: <input type="checkbox" name="Dv"><br/>
            <input type="submit" name="btnActualizar" value="Actualizar"><br/>           
            
            
        </form>
    </body>
</html>
