<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
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
        <form action="#" method="POST">
            <input type="submit" name="oro" value="Gold"><br/>
            <input type="submit" name="plata" value="Silver"><br/>
            <input type="submit" name="bronce" value="Bronze">
        </form>
    </body>
</html>
