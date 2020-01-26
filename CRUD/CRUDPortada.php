<?php

include_once "conexion.php";
include_once ("../CRUD/CRUDArticulo.php");

//Devuelve True si ha creado o False si hay error
function createPortada($portada) {
    $con = conexionBD();
    $res = FALSE;
    $fecha = $portada['fecha'];
    $query = "INSERT INTO portadas (fecha) VALUES ('$fecha')";
    $result = $con->query($query);
    if ($result) {
        $res = TRUE;
    }
    desconectar($con);
    return $res;
}

//Devuelve False si no hay datos o un array con el datos
function readPortada($id) {
    $con = conexionBD();
    $res = False;
    $query = "SELECT * FROM portadas WHERE idPortada = $id";
    $result = $con->query($query);
    if ($result->num_rows !== 0) {
        $res = $result->fetch_assoc();
    }
    desconectar($con);
    return $res;
}

//Devuelve True si ha actualizado o False si hay error
function updatePortada($portada) {
    $con = conexionBD();
    $res = FALSE;
    $id = $portada['idPortada'];
    $fecha = $portada['fecha'];
    $query = "UPDATE portadas SET fecha = '$fecha' WHERE idPortada = $id";
    $result = $con->query($query);
    if ($result) {
        $res = True;
    }
    desconectar($con);
    return $res;
}

//Devuelve True si se ha borrado o  False y hay error
function deletePortada($id) {
    $con = conexionBD();
    $res = FALSE;
    $query = "DELETE FROM portadas WHERE idPortada = $id";
    $result = $con->query($query);
    if ($result) {
        $res = TRUE;
    }
    desconectar($con);
    return $res;
}

//Devuelve False si hay fallo/no hay datos o un array con los datos
function readAllPortada() {
    $con = conexionBD();
    $res = FALSE;
    $query = "SELECT * FROM portadas";
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

function asociarPortada($idCuenta, $idPortada) {
    $con = conexionBD();
    $res = FALSE;

    $query = "UPDATE portadas SET idCuenta = $idCuenta WHERE idPortada=$idPortada";
    $result = $con->query($query);
    if ($result) {
        $res = TRUE;
    }
    desconectar($con);
    return $res;
}

function obtenerIDPortada($fecha) {
    $con = conexionBD();
    $res = FALSE;

    $query = "SELECT * from portadas where fecha='$fecha'";
    $result = $con->query($query);
    if ($result->num_rows !== 0) {
        $res = $result->fetch_assoc();
    }
    desconectar($con);
    return $res['idPortada'];
}

function quitarArticulosDePortada($idPortada) {

    $con = conexionBD();
    $res = FALSE;
    $query = "UPDATE articulos set idPortada=NULL where idPortada=$idPortada";
    if ($con->query($query)) {
        $res = TRUE;
    }

    desconectar($con);
    return $res;
}

function tieneAnuncio($idPortada) {
    $con = conexionBD();
    $res = true;
    $query = "SELECT idAnuncio FROM portadas WHERE idPortada = $idPortada";
    $result = $con->query($query);
    if ($result->num_rows !== 0) {
        $valores = $result->fetch_assoc();
    }
    if (($valores['idAnuncio']) == NULL) {
        $res = false;
    }
    desconectar($con);
    return $res;
}

function obtenerAnuncioDePortada($idPortada) {
    $con = conexionBD();
    $query = "SELECT * FROM anuncios WHERE idPortada = $idPortada";
    $result = $con->query($query);
    if ($result->num_rows !== 0) {
        $valores = $result->fetch_assoc();
    }

    desconectar($con);
    return $valores;
}

function quitarAnuncioDePortada($idPortada) {
    $con = conexionBD();
    $res = FALSE;
    $query = "UPDATE anuncios set idPortada=NULL where idPortada=$idPortada";
    echo $query;
    if ($con->query($query)) {
        $res = TRUE;
    }

    desconectar($con);
    return $res;
}

function obtenerArticulosUltimaPortada() {
    $con = conexionBD();
    $res = FALSE;
    $query = "SELECT * FROM portadas WHERE fecha = CURRENT_DATE LIMIT 1";
    $result = $con->query($query);
    if ($result) {
        $aux = $result->fetch_assoc();
        $idPortada = $aux['idPortada'];
        $res = leerArticulosDadaPortada($idPortada);
    }
    desconectar($con);
    return $res;
}
