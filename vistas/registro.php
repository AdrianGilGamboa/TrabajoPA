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
        $secciones = readAllSeccion();
        if (isset($_POST['btnRegistrar'])) {
            $gustos = array();
            $filtros = Array(
                'nombre' => FILTER_SANITIZE_MAGIC_QUOTES,
                'usuario' => FILTER_SANITIZE_MAGIC_QUOTES,
                'clave' => FILTER_SANITIZE_MAGIC_QUOTES,
                'email' => FILTER_SANITIZE_EMAIL
            );
            if(isset($_POST['Dv'])){
                $Dv = TRUE;
            }else{
                $Dv = FALSE;
            }
            foreach ($secciones as $seccion) {
                $aux = $seccion['categoria'];
                if(isset($_POST[$aux])){
                    array_push($gustos, $seccion['categoria']);
                }
            }
            $entradas = filter_input_array(INPUT_POST, $filtros);
            
            if (registrar($entradas['nombre'], $entradas['usuario'], $entradas['clave'], $entradas['email'],$Dv, implode(',', $gustos))) {
                header('Location: inicioSesion.php');
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
            Gustos: <br/>
            <?php
            foreach ($secciones as $seccion) {
                echo $seccion['categoria'];?>
                <input type="checkbox" name="<?php echo $seccion['categoria'];?>" value="<?php echo $seccion['categoria'];?>"><br/>
                <?php
            }
            ?>
            Discapacidad visual: <input type="checkbox" name="Dv"><br/>
            <input type="submit" name="btnRegistrar" value="Registrar"><br/>                                
        </form>
    </body>
</html>
