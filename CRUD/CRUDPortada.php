<?php

include_once "conexion.php";
//Devuelve True si ha creado o False si hay error
function create($portada) {
    $con = conexionBD();
    $res = FALSE;
    $fecha = $portada['fecha'];
    $query = "INSERT INTO portadas (fecha) VALUES ('$fecha')";
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
    $query = "SELECT * FROM portadas WHERE idPortada = $id";
    $result = $con->query($query);
    if ($result->num_rows !== 0) {
        $res = $result->fetch_assoc();
    }
    desconectar($con);
    return $res;
}

//Devuelve True si ha actualizado o False si hay error
function update($portada) {
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
function delete($id) {
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
function readAll() {
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
