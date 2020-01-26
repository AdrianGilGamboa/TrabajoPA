<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include_once ("../CRUD/CRUDCuenta.php");
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
        session_start();
        $hayCuenta=FALSE;
        if (!isset($_SESSION['cuentaID'])) {
            header('Location: inicioSesion.php');
        }
        if (isset($_SESSION['cuentaID'])) {
            $nombreUsuario = $_SESSION['nombreUsuario'];
            $idUsuario = $_SESSION['cuentaID'];
            $hayCuenta = TRUE;
        }
        if (isset($_POST['oro'])) {
            formato("gold", $idUsuario);
            header('Location: portada.php');
        } else if (isset($_POST['plata'])) {
            formato("silver", $idUsuario);
            header('Location: portada.php');
        } else if (isset($_POST['bronce'])) {
            formato("bronze", $idUsuario);
            header('Location: portada.php');
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
        ?>
        <form action="#" method="POST">
            <input type="submit" name="oro" value="Gold">
            <input type="submit" name="plata" value="Silver">
            <input type="submit" name="bronce" value="Bronze">
        </form>
        <table>
            <tr>
                <th></th>
                <th>Access to the newspaper archive</th>
                <th>Colorfull coments</th>
                <th>Minigames</th>
                <th>Physical newspaper</th>
                <th>Email notification of personalized news</th>
            </tr>
            <tr>
                <th>Normal</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <th>Bronze</th>
                <th style="text-align: center;">X</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <th>Silver</th>
                <th></th>
                <th style="text-align: center;">X</th>
                <th style="text-align: center;">X</th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <th>Gold</th>
                <th></th>
                <th></th>
                <th></th>
                <th style="text-align: center;">X</th>
                <th style="text-align: center;">X</th>
            </tr>
        </table>
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
