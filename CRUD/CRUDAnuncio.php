<?php

include "conexion.php";
//Devuelve True si ha creado o False si hay error
function create($anuncio) {
    $con = conexionBD();
    $res = FALSE;
    $imagen = $anuncio['imagen'];
    $duracion = $anuncio['duracion'];
    $descripcion = $anuncio['descripcion'];
   
    $query = "INSERT INTO anuncios (imagen, duracion, descripcion) VALUES ('$imagen',$duracion,'$descripcion')";
    $result = $con->query($query);
    if($result){
        $res = TRUE;
    }
    desconectar($con);
    return $res;
}

//Devuelve False si no hay datos o un array con el datos
function read($id) {
    $con = conexionBD();
    $res = False;
    $query = "SELECT * FROM anuncios WHERE id = $id";
    $result = $con->query($query);
    if ($result->num_rows !== 0) {
        $res = $result->fetch_assoc();
    }
    desconectar($con);
    return $res;
}

//Devuelve True si ha actualizado o False si hay error
function update($anuncio) {
    $con = conexionBD();
    $res = FALSE;
    $id = $anuncio['id'];
    $imagen = $anuncio['imagen'];
    $duracion = $anuncio['duracion'];
    $descripcion = $anuncio['descripcion'];
    $query = "UPDATE anuncios SET imagen = '$imagen', duracion = $duracion, descripcion = '$descripcion' WHERE id = $id";
    $result = $con->query($query);
    if ($result) {
        $res = True;
    }
    desconectar($con);
    return $res;
}

//Devuelve True si se ha borrado o  False y hay error
function delete($id) {
    $con = conexionBD();
    $res = FALSE;
    $query = "DELETE FROM anuncios WHERE id = $id";
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
    $query = "SELECT * FROM anuncios";
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
