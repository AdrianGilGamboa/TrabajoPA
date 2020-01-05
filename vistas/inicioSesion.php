<!DOCTYPE html>
<?php
include_once ('../CRUD/CRUDCuenta.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inicio de sesion</title>
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
            //header('Location: inicioSesion.php');
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
        <h1>Inicio Sesion</h1>
        <form action="#" method="POST">
            Usuario: <input type="text" name="usuario" value="<?php echo $nombre; ?>" /> <br>
            Clave: <input type="password" name="clave" /> <br><br>

            <input type="submit" name="btnLogin" value="Entrar"/>
            <input type="reset" name="btnCancelar" value="Cancelar"/> <br><br>                                
        </form>
        <form action="#" method="POST">
            <input type="submit" name="btnRegistro" value="Registro"/>                                
        </form>
    </body>
</html>
