<!DOCTYPE html>
<?php
//include "conexion.php";
include "CRUD/CRUDCuenta.php";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //conexionBD();
        $cuenta = array(
            'id' => 2,
            'nombre' => "Pedro",
            'usuario' => "priscal",
            'clave' => "priscal",
            'email' => "pedrorisquez@hotmail.com",
            'formato' => "Esmeralda",
            'tipo' => "administrador"
        );
        
//        if(create($cuenta)){
//            echo "creado";
//        }else{
//            echo "error";
//        }
//        if(delete(1)){
//            echo "borrado";
//        }else{
//            echo "error";
//        }
//        if(($cuenta=read(2)) !== FALSE){
//            print_r($cuenta);
//        }else{
//            echo "error";
//        }
//        if(update($cuenta)){
//            echo "actualizado";
//        }else{
//            echo "error";
//        }
        ?>
    </body>
</html>
