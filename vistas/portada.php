<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Portada del dia</title>
    </head>
    <body>
        <?php
        session_start();
        $hayCuenta = FALSE;
        if (isset($_SESSION['cuentaID'])) {
            $hayCuenta = TRUE;
            $nombreUsuario = $_SESSION['nombreUsuario'];
            $idUsuario = $_SESSION['cuentaID'];
        }
        ?>
        <header>
            <a href="inicioSesion.php">Inciar Sesion</a>
            <a href="registro.php">Registrarse</a>
            <?php
            if ($hayCuenta) {
                ?>
                <a href="cuenta.php"><?php echo $nombreUsuario;?></a>
                <?php
            }
            ?>

        </header>
        <nav>

        </nav>
        <footer>

        </footer>

    </body>
</html>
