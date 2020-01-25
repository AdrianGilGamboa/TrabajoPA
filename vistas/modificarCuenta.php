<!DOCTYPE html>
<?php
include_once("../CRUD/CRUDCuenta.php");
include_once("../CRUD/CRUDSeccion.php");
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

        if (!isset($_SESSION['cuentaID'])) {
            header('Location:inicioSesion.php');
        }

        if (isset($_SESSION['cuentaID'])) {
            $nombreUsuario = $_SESSION['nombreUsuario'];
            $idUsuario = $_SESSION['cuentaID'];
        }
        
        include_once 'nav.php';
        
        $datosPersonales = readCuenta($idUsuario);
        $secciones = readAllSeccion();
        if (isset($_POST['btnActualizar'])) {
            $gustos = array();
            $filtros = array(
                'nombre' => FILTER_SANITIZE_MAGIC_QUOTES,
                'usuario' => FILTER_SANITIZE_MAGIC_QUOTES,
                'clave' => FILTER_SANITIZE_MAGIC_QUOTES,
                'email' => FILTER_SANITIZE_EMAIL
            );
            foreach ($secciones as $seccion) {
                $aux = $seccion['categoria'];
                if (isset($_POST[$aux])) {
                    array_push($gustos, $seccion['categoria']);
                }
            }
            $Dv = 0;
            if (isset($_POST['Dv'])) {
                $Dv = TRUE;
            }
            $entradas = filter_input_array(INPUT_POST, $filtros);
            $posible = true;
            if (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*[@]([a-zA-Z0-9])+[.]([a-zA-Z0-9\._-])+$/", $entradas['email'])) {
                $posible = false;
            }
            if ($posible) {
                $cuenta = array(
                    'idCuenta' => $idUsuario,
                    'nombre' => $entradas['nombre'],
                    'usuario' => $entradas['usuario'],
                    'clave' => $entradas['clave'],
                    'email' => $entradas['email'],
                    'formato' => $datosPersonales['formato'],
                    'tipo' => $datosPersonales['tipo'],
                    'Dv' => $Dv,
                    'gustos' => implode(',', $gustos)
                );

                if (updateCuenta($cuenta)) {
                    header('Location:cuenta.php');
                } else {
                    echo "error al actualizar los datos";
                }
            }
        }
        ?>
        <form action="#" method="POST">
            Nombre: <input type="text" name="nombre" value="<?php echo $datosPersonales['nombre']; ?>"><br/>
            Usuario: <input type="text" name="usuario" value="<?php echo $datosPersonales['usuario']; ?>"><br/>
            Clave: <input type="password" name="clave" value="<?php echo $datosPersonales['clave']; ?>"><br/>
            Email: <input type="text" name="email" value ="<?php echo $datosPersonales['email']; ?>"><br/>
            Gustos: <br/>
            <?php
            $misGustos = explode(",", $datosPersonales['gustos']);
            foreach ($secciones as $seccion) {
                echo $seccion['categoria'];
                ?>
                <input type="checkbox" name="<?php echo $seccion['categoria']; ?>" value="<?php echo $seccion['categoria']; ?>" <?php
                if (in_array($seccion['categoria'], $misGustos)) {
                    echo "checked";
                }
                ?>><br/>
                       <?php
                   }
                   ?>
            Discapacidad visual: <input type="checkbox" name="Dv" <?php
            if ($datosPersonales['Dv']) {
                echo "checked";
            }
                   ?>><br/>
            <input type="submit" name="btnActualizar" value="Actualizar"><br/>

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
