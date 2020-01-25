<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
        if(!isset($_SESSION['cuentaID'])){
            header('Location: inicioSesion.php');
        }
        if (isset($_SESSION['cuentaID'])) {
            $nombreUsuario = $_SESSION['nombreUsuario'];
            $idUsuario = $_SESSION['cuentaID'];
        }
        if(isset($_POST['oro'])){
            
        }else if(isset($_POST['plata'])){
            
        }else if(isset($_POST['bronce'])){
            
        }
        ?>
        <?php
        include_once 'nav.php';
        ?>
        <form action="#" method="POST">
            <input type="submit" name="oro" value="Gold"><br/>
            <input type="submit" name="plata" value="Silver"><br/>
            <input type="submit" name="bronce" value="Bronze">
        </form>
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
