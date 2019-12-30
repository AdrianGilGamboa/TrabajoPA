<?php

include "conexion.php";
//Devuelve True si ha creado o False si hay error
function create($seccion) {
    $con = conexionBD();
    $res = FALSE;
    $categoria = $seccion['categoria'];
    $query = "INSERT INTO secciones (categoria) VALUES ('$categoria')";
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
    $query = "SELECT * FROM secciones WHERE id = $id";
    $result = $con->query($query);
    if ($result->num_rows !== 0) {
        $res = $result->fetch_assoc();
    }
    desconectar($con);
    return $res;
}

//Devuelve True si ha actualizado o False si hay error
function update($seccion) {
    $con = conexionBD();
    $res = FALSE;
    $id = $seccion['id'];
    $categoria = $seccion['categoria'];
    $query = "UPDATE secciones SET categoria = '$categoria' WHERE id = $id";
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
    $query = "DELETE FROM secciones WHERE id = $id";
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
