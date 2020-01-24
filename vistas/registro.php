<!DOCTYPE html>
<?php
include_once ('../CRUD/CRUDCuenta.php');
include_once ('../CRUD/CRUDSeccion.php');
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
        $secciones = readAllSeccion();
        if (isset($_POST['btnRegistrar'])) {
            $gustos = array();
            $filtros = Array(
                'nombre' => FILTER_SANITIZE_MAGIC_QUOTES,
                'usuario' => FILTER_SANITIZE_MAGIC_QUOTES,
                'clave' => FILTER_SANITIZE_MAGIC_QUOTES,
                'email' => FILTER_SANITIZE_EMAIL
            );
            if (isset($_POST['Dv'])) {
                $Dv = TRUE;
            } else {
                $Dv = FALSE;
            }
            foreach ($secciones as $seccion) {
                $aux = $seccion['categoria'];
                if (isset($_POST[$aux])) {
                    array_push($gustos, $seccion['categoria']);
                }
            }
            $entradas = filter_input_array(INPUT_POST, $filtros);

            $posible = true;
            if (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*[@]([a-zA-Z0-9])+[.]([a-zA-Z0-9\._-])+$/", $entradas['email'])) {
                $posible = false;
            }
            if (!preg_match("/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$Dv/", $entradas['clave'])) {
                $posible = false;
            }
            if ($posible) {
                if (registrar($entradas['nombre'], $entradas['usuario'], $entradas['clave'], $entradas['email'], $Dv, implode(',', $gustos))) {
                    header('Location: inicioSesion.php');
                } else {
                    echo "Datos no validos";
                }

            }
        }
        ?>
        <h2>Registro de usuario</h2>
        <form action="#" method="POST">
            Nombre: <input type="text" name="nombre" value=""><br/>
            Usuario: <input type="text" name="usuario" value=""><br/>
            Clave: <input type="password" name="clave"><br/>
            Email: <input type="text" name="email"><br/>
            Gustos: <br/>
            <?php
            foreach ($secciones as $seccion) {
                echo $seccion['categoria'];
                ?>
                <input type="checkbox" name="<?php echo $seccion['categoria']; ?>" value="<?php echo $seccion['categoria']; ?>"><br/>
                <?php
            }
            ?>
            Discapacidad visual: <input type="checkbox" name="Dv"><br/>
            <input type="submit" name="btnRegistrar" value="Registrar"><br/>                                
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
