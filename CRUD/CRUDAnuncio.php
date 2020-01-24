<?php

include_once "conexion.php";

//Devuelve True si ha creado o False si hay error
function createAnuncio($anuncio) {
    $con = conexionBD();
    $res = FALSE;
    $imagen = $anuncio['imagen'];
    $duracion = $anuncio['duracion'];
    $descripcion = $anuncio['descripcion'];

    $query = "INSERT INTO anuncios (imagen, duracion, descripcion) VALUES ('$imagen',$duracion,'$descripcion')";
    $result = $con->query($query);
    if ($result) {
        $query = "SELECT * FROM anuncios WHERE descripcion = '$descripcion'";
        $result = $con->query($query);
        $aux = $result->fetch_assoc();
        $res = $aux['idAnuncio'];
    }
    desconectar($con);
    return $res;
}

//Devuelve False si no hay datos o un array con el datos
function readAnuncio($id) {
    $con = conexionBD();
    $res = False;
    $query = "SELECT * FROM anuncios WHERE idAnuncio = $id";
    $result = $con->query($query);
    if ($result->num_rows !== 0) {
        $res = $result->fetch_assoc();
    }
    desconectar($con);
    return $res;
}

//Devuelve True si ha actualizado o False si hay error
function updateAnuncio($anuncio) {
    $con = conexionBD();
    $res = FALSE;
    $id = $anuncio['idAnuncio'];
    $imagen = $anuncio['imagen'];
    $duracion = $anuncio['duracion'];
    $descripcion = $anuncio['descripcion'];
    $query = "UPDATE anuncios SET imagen = '$imagen', duracion = $duracion, descripcion = '$descripcion' WHERE idAnuncio = $id";
    $result = $con->query($query);
    if ($result) {
        $res = True;
    }
    desconectar($con);
    return $res;
}

//Devuelve True si se ha borrado o  False y hay error
function deleteAnuncio($id) {
    $con = conexionBD();
    $res = FALSE;
    $query = "DELETE FROM anuncios WHERE idAnuncio = $id";
    $result = $con->query($query);
    if ($result) {
        $res = TRUE;
    }
    desconectar($con);
    return $res;
}

//Devuelve False si hay fallo/no hay datos o un array con los datos
function readAllAnuncio() {
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

function leerAnunciosSinPortada() {
    $con = conexionBD();
    $res = False;
    $query = "SELECT * FROM anuncios WHERE idPortada is NULL";
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

function asociarAnuncioPortada($idAnuncio, $idPortada) {
    $con = conexionBD();
    $res = FALSE;

    $query = "UPDATE anuncios SET idPortada = $idPortada WHERE idAnuncio=$idAnuncio";
    $result = $con->query($query);
    if ($result) {
        $res = TRUE;
    }
    $query = "UPDATE portadas SET idAnuncio=$idAnuncio WHERE idPortada = $idPortada ";
    $result = $con->query($query);
    if ($result) {
        $res = TRUE;
    }
    desconectar($con);
    return $res;
}

function leerAnunciosSinArticulo() {
    $con = conexionBD();
    $res = False;
    $query = "SELECT * FROM anuncios WHERE idArticulo is NULL";
    $result = $con->query($query);
    if ($result) {
        if ($result->num_rows !== 0) {
            $res = array();
            for ($i = 0; $i < $result->num_rows; $i++) {
                array_push($res, $result->fetch_assoc());
            }
        }
    }

    desconectar($con);
    return $res;
}
function asociaAnuncio($idAnuncio,$idAnunciante){
    $con = conexionBD();
    $res = FALSE;

    $query = "UPDATE anuncios SET idAnunciante = $idAnunciante WHERE idAnuncio=$idAnuncio";
    $result = $con->query($query);
    if ($result) {
        $res = TRUE;
    }
    desconectar($con);
    return $res;
}
