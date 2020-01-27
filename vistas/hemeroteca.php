<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include_once ("../CRUD/CRUDArticulo.php");
include_once ("../CRUD/CRUDCuenta.php");
include_once ("../CRUD/CRUDSeccion.php");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content=="IE=edge"/>
        <meta name="google" value="notranslate"/>
        <link href="css.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <title>Newspaper archive</title>
    </head>
    <body>
        <?php
        if (isset($_POST['hemeroteca'])) {
            if ($_POST['tipo'] === "bronze") {
                $nombreUsuario = $_POST['nombre'];
                $gustos = $_POST['gustos'];
            } else {
                header('Location: cuenta.php');
            }
        } else {
            header('Location: cuenta.php');
        }
        $arrayGustos = explode(',', $gustos);
        $idSecciones = array();
        foreach ($arrayGustos as $categoria) {
            array_push($idSecciones, leerIdDadaCategoria($categoria));
        }
        $articulos = array();
        foreach ($idSecciones as $idSeccion) {
            array_push($articulos, leerArticulosDadaSeccion($idSeccion));
        }
        foreach ($articulos as $articuloAux) {
            if (gettype($articuloAux) !== "boolean") {
                foreach ($articuloAux as $articulo) {
                    $autor = readCuenta($articulo['idCuenta']);
                    ?>
                    <a href="articulo.php?idArticulo=<?php echo $articulo['idArticulo']; ?>"><article class="inner">

                            <h2><?php echo $articulo['titulo']; ?></h2>

                            <div class="image">
                                <a href="<?php
                                if ($articulo['imagen'] != NULL) {
                                    echo '../imagenes/' . $articulo['imagen'];
                                }
                                ?>"><img src="../imagenes/<?php echo $articulo['imagen']; ?>"alt='<?php echo $articulo['imagen']; ?>' width='300'><?php
                                       if ($articulo['imagen'] != NULL) {
                                           echo $articulo['imagen'];
                                       }
                                       ?></a>
                            </div>
                            <div class="audioArticulo">
                                <?php if ($articulo['audio'] != NULL) { ?>
                                    <audio controls>
                                        <source src="<?php echo '../audios/' . $articulo['audio']; ?>" type="audio/mpeg">
                                    </audio>
                                <?php } ?>
                            </div>

                            <div >
                                <h3><?php echo $articulo['descripcion']; ?></h3> 
                            </div>
                            <div>
                                <p> <?php echo $articulo['texto']; ?></p>
                            </div>
                            <div class="fechaArticulo">
                                <?php echo $articulo['fecha']; ?>
                            </div>
                            <div>
                                <h5><?php echo $autor['nombre']; ?></h5>
                            </div>
                            <div class="seccionArticulo">
                                <?php
                                $secciones = leerSeccionDadoArticulo($articulo['idArticulo']);

                                if ($secciones) {
                                    foreach ($secciones as $seccion) {
                                        ?>
                                        <a href="seccion.php?idSeccion=<?php echo $seccion['idSeccion']; ?>"><?php echo $seccion['categoria']; ?></a><?php
                                    }
                                }
                                ?>
                            </div>
                        </article> </a> <hr>
                    <?php
                }
            }
        }
        ?>
    </body>
</html>
