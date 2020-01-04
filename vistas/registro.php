<!DOCTYPE html>
<?php
include_once ('../CRUD/CRUDCuenta.php');
include_once ('../CRUD/CRUDSeccion.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if (isset($_POST['btnRegistrar'])) {
            $filtros = Array(
                'nombre' => FILTER_SANITIZE_MAGIC_QUOTES,
                'usuario' => FILTER_SANITIZE_MAGIC_QUOTES,
                'clave' => FILTER_SANITIZE_MAGIC_QUOTES,
                'email' => FILTER_SANITIZE_EMAIL,
                'Dv' => FILTER_SANITIZE_MAGIC_QUOTES
            );
            
            $entradas = filter_input_array(INPUT_POST, $filtros);
            if (registrar($entradas['usuario'], $entradas['password'], $entradas['email'], $entradas['perfil'])) {
                header('Location: login.php');
            } else {
                echo "Datos no validos";
            }
        }
        ?>
        <h2>Registro de usuario</h2>
        <form action="#" method="POST">
            Nombre: <input type="text" name="nombre" value=""><br/>
            Usuario: <input type="text" name="usuario" value=""><br/>
            Clave: <input type="password" name="clave"><br/>
            Email: <input type="text" name="email"><br/>
            Gustos: <select name="perfil">
                //secciones
                <option value="P">Programador</option>
                <option value="AP">Analista-Programador</option>
                <option value="A">Analista</option>
            </select><br/>
            Discapacidad visual: <input type="checkbox" name="Dv"><br/>
            <input type="submit" name="btnRegistrar" value="Registrar"><br/>                                
        </form>
    </body>
</html>
