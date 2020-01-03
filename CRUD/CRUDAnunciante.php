<?php

include "conexion.php";
//Devuelve True si ha creado o False si hay error
function createAnunciante($anunciante) {
    $con = conexionBD();
    $res = FALSE;
    $nombre = $anunciante['nombre'];
    $tarifa = $anunciante['tarifa'];
    $query = "INSERT INTO anunciantes (nombre, tarifa) VALUES ('$nombre','$tarifa')";
    $result = $con->query($query);
    if($result){
        $res = TRUE;
    }
    desconectar($con);
    return $res;
}

//Devuelve False si no hay datos o un array con el datos
function readAnunciante($id) {
    $con = conexionBD();
    $res = False;
    $query = "SELECT * FROM anunciantes WHERE idAnunciante = $id";
    $result = $con->query($query);
    if ($result->num_rows !== 0) {
        $res = $result->fetch_assoc();
    }
    desconectar($con);
    return $res;
}

//Devuelve True si ha actualizado o False si hay error
function updateAnunciante($anunciante) {
    $con = conexionBD();
    $res = FALSE;
    $id = $anuncio['idAnunciante'];
    $nombre = $anunciante['nombre'];
    $tarifa = $anunciante['tarifa'];
    $query = "UPDATE anunciantes SET nombre = '$nombre', tarifa = '$tarifa' WHERE idAnunciante = $id";
    $result = $con->query($query);
    if ($result) {
        $res = True;
    }
    desconectar($con);
    return $res;
}

//Devuelve True si se ha borrado o  False y hay error
function deleteAnunciante($id) {
    $con = conexionBD();
    $res = FALSE;
    $query = "DELETE FROM anunciantes WHERE idAnunciante = $id";
    $result = $con->query($query);
    if ($result) {
        $res = TRUE;
    }
    desconectar($con);
    return $res;
}

//Devuelve False si hay fallo/no hay datos o un array con los datos
function readAllAnunciante() {
    $con = conexionBD();
    $res = FALSE;
    $query = "SELECT * FROM anunciantes";
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
