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
        <h2 class="">Inicio Sesion</h2>
        <form  class="" action="#" method="POST">
            <div class="">
            Usuario: <input type="text" name="usuario" value="<?php echo $nombre; ?>" /> <br>
            Clave: <input type="password" name="clave" /> <br><br>
            </div>
            <input class=""  type="submit" name="btnLogin" value="Entrar"/>
            <input class="" type="reset" name="btnCancelar" value="Cancelar"/> <br><br>                                
        </form>
        <form class="" action="#" method="POST">
            <input type="submit" name="btnRegistro" value="Registro"/>                                
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
