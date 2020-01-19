<?php

include_once "conexion.php";

//Devuelve True si ha creado o False si hay error
function createSeccion($seccion) {
    $con = conexionBD();
    $res = FALSE;
    $categoria = $seccion['categoria'];
    $query = "INSERT INTO secciones (categoria) VALUES ('$categoria')";
    $result = $con->query($query);
    if ($result) {
        $res = TRUE;
    }
    desconectar($con);
    return $res;
}

//Devuelve False si no hay datos o un array con el datos
function readSeccion($id) {
    $con = conexionBD();
    $res = False;
    $query = "SELECT * FROM secciones WHERE idSeccion = $id";
    $result = $con->query($query);
    if ($result->num_rows !== 0) {
        $res = $result->fetch_assoc();
    }
    desconectar($con);
    return $res;
}

//Devuelve True si ha actualizado o False si hay error
function updateSeccion($seccion) {
    $con = conexionBD();
    $res = FALSE;
    $id = $seccion['id'];
    $categoria = $seccion['categoria'];
    $query = "UPDATE secciones SET categoria = '$categoria' WHERE idSeccion = $id";
    $result = $con->query($query);
    if ($result) {
        $res = True;
    }
    desconectar($con);
    return $res;
}

//Devuelve True si se ha borrado o  False y hay error
function deleteSeccion($id) {
    $con = conexionBD();
    $res = FALSE;
    $query = "DELETE FROM articulossecciones WHERE idSeccion = $id";
    $result = $con->query($query);
    $query = "DELETE FROM secciones WHERE idSeccion = $id";
    $result = $con->query($query);
    if ($result) {
        $res = TRUE;
    }
    desconectar($con);
    return $res;
}

//Devuelve False si hay fallo/no hay datos o un array con los datos
function readAllSeccion() {
    $con = conexionBD();
    $res = FALSE;
    $query = "SELECT * FROM secciones";
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

function obtenerID($categoria) {
    $con = conexionBD();
    $res = FALSE;
    $query = "SELECT * FROM secciones WHERE categoria = '$categoria' LIMIT 1";
    $result = $con->query($query);

    if ($result->num_rows !== 0) {
        $consulta = $result->fetch_assoc();

        $res = $consulta['idSeccion'];
    }

    desconectar($con);
    return $res;
}

function asociarSeccion($idCuenta, $idSeccion) {
    $con = conexionBD();
    $res = FALSE;

    $query = "UPDATE secciones SET idCuenta = $idCuenta WHERE idSeccion=$idSeccion";
    $result = $con->query($query);
    if ($result) {
        $res = TRUE;
    }
    desconectar($con);
    return $res;
}

function leerSeccionDadoArticulo($idArticulo){
    $con = conexionBD();
    $res = FALSE;
    $query = "SELECT * FROM articulossecciones WHERE idArticulo=$idArticulo";
    $result = $con->query($query);
    if ($result->num_rows !== 0) {
        $aux = array();
        for ($i = 0; $i < $result->num_rows; $i++) {
            array_push($aux, $result->fetch_assoc());
        }
        $res = array();
        foreach ($aux as $idSeccion) {
            array_push($res, readSeccion($idSeccion['idSeccion']));
        }
    }
    
    desconectar($con);
    return $res;
}
