<?php

include "conexion.php";
//Devuelve True si ha creado o False si hay error
function create($articulo) {
    $con = conexionBD();
    $res = FALSE;
    $fecha = $articulo['texto'];
    $titulo = $articulo['titulo'];
    $descripcion = $articulo['descripcion'];
    $imagen = $articulo['imagen'];
    $audio = $articulo['audio'];
    $query = "INSERT INTO articulos (fecha, titulo, descripcion, imagen, audio) VALUES ('$fecha','$titulo','$descripcion','$imagen','$audio')";
    $result = $con->query($query);
    if($result){
        $res = TRUE;
    }
    desconectar($con);
    return $res;
}

//Devuelve False si no hay datos o un array con el datos
function read($idArticulo) {
    $con = conexionBD();
    $res = False;
    $query = "SELECT * FROM articulos WHERE idArticulo = $idArticulo";
    $result = $con->query($query);
    if ($result->num_rows !== 0) {
        $res = $result->fetch_assoc();
    }
    desconectar($con);
    return $res;
}

//Devuelve True si ha actualizado o False si hay error
function update($articulo) {
    $con = conexionBD();
    $res = FALSE;
    $idArticulo = $articulo['idArticulo'];
    $fecha = $articulo['texto'];
    $titulo = $articulo['titulo'];
    $descripcion = $articulo['descripcion'];
    $imagen = $articulo['imagen'];
    $audio = $articulo['audio'];
    $query = "UPDATE articulos SET fecha = '$fecha', titulo = '$titulo', descripcion = '$descripcion', imagen = '$imagen', audio = '$audio' WHERE idArticulo = $idArticulo";
    $result = $con->query($query);
    if ($result) {
        $res = True;
    }
    desconectar($con);
    return $res;
}

//Devuelve True si se ha borrado o  False y hay error
function delete($idArticulo) {
    $con = conexionBD();
    $res = FALSE;
    $query = "DELETE FROM articulos WHERE idArticulo = $idArticulo";
    $result = $con->query($query);
    if ($result) {
        $res = TRUE;
    }
    desconectar($con);
    return $res;
}

//Devuelve False si hay fallo/no hay datos o un array con los datos
function readAll() {
    $con = conexionBD();
    $res = FALSE;
    $query = "SELECT * FROM articulos";
    $result = $con->query($query);
    if ($result->num_rows !== 0) {
        $res = array();
        for ($i = 0; $i < $result->num_rows; $i++) {
            array_push($res, $result->fetch_assoc());
        }
    }

    desconectar($con);
    return $res;
}