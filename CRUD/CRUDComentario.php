<?php

include "conexion.php";
//Devuelve True si ha creado o False si hay error
function createComentario($comentario) {
    $con = conexionBD();
    $res = FALSE;
    $texto = $comentario['texto'];
    $puntuacion = $comentario['puntuacion'];
    $query = "INSERT INTO comentarios (texto, puntuacion) VALUES ('$texto',$puntuacion)";
    $result = $con->query($query);
    if($result){
        $res = TRUE;
    }
    desconectar($con);
    return $res;
}

//Devuelve False si no hay datos o un array con el datos
function readComentario($idComentario) {
    $con = conexionBD();
    $res = False;
    $query = "SELECT * FROM comentarios WHERE idComentario = $idComentario";
    $result = $con->query($query);
    if ($result->num_rows !== 0) {
        $res = $result->fetch_assoc();
    }
    desconectar($con);
    return $res;
}

//Devuelve True si ha actualizado o False si hay error
function updateComentario($comentario) {
    $con = conexionBD();
    $res = FALSE;
    $idComentario = $comentario['idComentario'];
    $texto = $comentario['texto'];
    $puntuacion = $cuenta['puntuacion'];
    $query = "UPDATE comentarios SET texto = '$texto', puntuacion = $puntuacion WHERE idComentario = $idComentario";
    $result = $con->query($query);
    if ($result) {
        $res = True;
    }
    desconectar($con);
    return $res;
}

//Devuelve True si se ha borrado o  False y hay error
function deleteComentario($idComentario) {
    $con = conexionBD();
    $res = FALSE;
    $query = "DELETE FROM comentarios WHERE idComentario = $idComentario";
    $result = $con->query($query);
    if ($result) {
        $res = TRUE;
    }
    desconectar($con);
    return $res;
}

//Devuelve False si hay fallo/no hay datos o un array con los datos
function readAllComentario() {
    $con = conexionBD();
    $res = FALSE;
    $query = "SELECT * FROM comentarios";
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
