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
        <script src="../js/scripts.js" type="text/javascript"></script>
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

        

        $datosPersonales = readCuenta($idUsuario);
        $secciones = readAllSeccion();
        if (isset($_POST['btnActualizar'])) {
            $gustos = array();
            $filtros = array(
                'nombre' => FILTER_SANITIZE_MAGIC_QUOTES,
                'usuario' => FILTER_SANITIZE_MAGIC_QUOTES,
                'claveantigua' => FILTER_SANITIZE_MAGIC_QUOTES,
                'clavenueva' => FILTER_SANITIZE_MAGIC_QUOTES,
                'clavenuevarepetida' => FILTER_SANITIZE_MAGIC_QUOTES,
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
            if ($entradas['clavenueva'] === $entradas['clavenuevarepetida']) {
                if (!password_verify($entradas['claveantigua'], $datosPersonales['clave'])) {
                    $posible = FALSE;
                }
            } else {
                $posible = FALSE;
            }
            if ($posible) {
                $cuenta = array(
                    'idCuenta' => $idUsuario,
                    'nombre' => $entradas['nombre'],
                    'usuario' => $entradas['usuario'],
                    'clave' => $entradas['clavenueva'],
                    'email' => $entradas['email'],
                    'formato' => $datosPersonales['formato'],
                    'tipo' => $datosPersonales['tipo'],
                    'Dv' => $Dv,
                    'gustos' => implode(',', $gustos)
                );

                if (updateCuenta($cuenta)) {
                    header('Location:cuenta.php');
                } else {
                    echo "<h3 class='centrar'> error al actualizar los datos</h3>";
                }
            } else {
                echo "<h3 class='centrar'>error al actualizar los datos</h3>";
            }
        }
        include_once 'nav.php';
        ?>
        <form action="#" method="POST" style="padding-right: 25%;padding-left: 25%;padding-top: 2px;margin-top: 20px;">
            Name: <input type="text" name="nombre" value="<?php echo $datosPersonales['nombre']; ?>"><br/>
            User: <input type="text" name="usuario" value="<?php echo $datosPersonales['usuario']; ?>"><br/>
            Old password: <input type="password" name="claveantigua" value=""><br/>
            New password: <input type="password" name="clavenueva" value="" onchange="validaClavesIguales()"><br/>
            Repeat new password: <input type="password" name="clavenuevarepetida" value="" onchange="validaClavesIguales()"><br/>
            Email: <input type="text" name="email" value ="<?php echo $datosPersonales['email']; ?>"><br/>
            Preferences: <br/>
            <?php
            $misGustos = explode(",", $datosPersonales['gustos']);
            ?>
            <table > 
                <?php
                foreach ($secciones as $seccion) {
                    ?> <tr><td>  <?php echo $seccion['categoria']; ?></td>

                        <td> <input type="checkbox" name="<?php echo $seccion['categoria']; ?>" value="<?php echo $seccion['categoria']; ?>" <?php
                            if (in_array($seccion['categoria'], $misGustos)) {
                                echo "checked";
                            }
                            ?>></td></tr>
                        <?php
                    }
                    ?>
            </table>

            Visual disability: <input type="checkbox" name="Dv" <?php
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
                    <li><span class="icon fa-envelope"></span> <a href="#">moarnewspa@gmail.com</a></li>
                    <li><span class="icon fa-map-marker"></span> Ctra. de Utrera, 1, 41013 Sevilla </li>
                </ul>
            </div>
            <div class="copyright">
                &copy; Newspaper. MoarNews <a href="https://www.upo.es/portal/impe/web/portada/index.html">MoarNews</a>. Images <a href="../imagenes/logo.jpeg" alt="logo">MoarNews</a>.

            </div>
        </footer>
    </body>
</html>
