<!DOCTYPE html>
<?php
include_once ('../CRUD/CRUDCuenta.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Log in</title>
        <meta charset="UTF-8">
        <title>section</title>
        <link href="css.css" rel="stylesheet" type="text/css"/>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content=="IE=edge"/>
        <meta name="google" value="notranslate"/>
        <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <script src="../js/scripts.js" type="text/javascript"></script>
    </head>
    <body>

        <?php
        session_start();
        if (isset($_SESSION['cuentaID'])) {
            header('Location: portada.php');
        }
        if (isset($_POST['btnLogin'])) {
            $filtros = Array(
                'usuario' => FILTER_SANITIZE_MAGIC_QUOTES,
                'clave' => FILTER_SANITIZE_MAGIC_QUOTES
            );
            $entradas = filter_input_array(INPUT_POST, $filtros);
            setcookie('nombre', $entradas['usuario'], time() + 3600 * 24 * 30);
            header('Location: inicioSesion.php');
            if (($cuenta = inicioDeSesionValido($entradas['usuario'], $entradas['clave'])) !== null) {
                session_start();
                $_SESSION['cuentaID'] = $cuenta['idCuenta'];
                $_SESSION['nombreUsuario'] = $cuenta['nombre'];
                $_SESSION['tipo'] = $cuenta['tipo'];
                header('Location: portada.php');
            } else {
                echo "No existe ningun usuario con esos datos";
            }
        } else if (isset($_POST['btnRegistro'])) {
            header('Location: registro.php');
        }
        if (isset($_COOKIE['nombre'])) {
            $nombre = $_COOKIE['nombre'];
        } else {
            $nombre = '';
        }
        ?>

       
        <form class= "inner" action="#" method="POST" onsubmit="return validaInicioSesion()">
             <h2 class="row uniform">Inicio Sesion</h2>
            <div class="row uniform">
                <div class="6u 12u/(xsmall)">
                    Usuario: <input type="text" name="usuario" value="<?php echo $nombre; ?>" placeholder="Name" /> <br>
                </div>
                <div class="centrar">
                    Clave: <input type="password" name="clave" placeholder="Password" /> <br><br>
                </div>
            </div>                   

            <div class="row uniform">
                <ul class="actions">
                    <li><input class="small"  type="submit" name="btnLogin" value="Entrar"/></li>
                    <li><input class="small" type="reset" name="btnCancelar" value="Cancelar"/></li>                    
                    <li><input class="small" type="reset" value="Reset" class="alt" /></li>
                </ul>

            </div>

        </form>
        <form action="#" method="POST">
            <input class="small" type="submit" name="btnRegistro" value="Registro" />
        </form>
        <footer id="footer">
            <div class="inner">
                <h2>Get In Touch</h2>
                <ul class="actions">
                    <li><i class="icon fa-phone"></i> <a href="#">(034)954 34 92 00</a></li>
                    <li><span class="icon fa-envelope"></span> <a href="#">moarneswspa@gmail.com</a></li>
                    <li><span class="icon fa-map-marker"></span> Ctra. de Utrera, 1, 41013 Sevilla </li>
                </ul>
            </div>
            <div class="copyright">
                &copy; Newspaper. MoarNews <a href="https://www.upo.es/portal/impe/web/portada/index.html">MoarNews</a>. Images <a href="../imagenes/logo.jpeg" alt="logo">MoarNews</a>.

            </div>
        </footer>
    </body>
</html>
