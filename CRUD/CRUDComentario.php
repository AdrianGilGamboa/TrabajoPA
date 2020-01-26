<?php

include_once "conexion.php";

//Devuelve True si ha creado o False si hay error
function createComentario($comentario) {
    $con = conexionBD();
    $res = FALSE;
    $texto = $comentario['texto'];
    $puntuacion = $comentario['puntuacion'];
    $query = "INSERT INTO comentarios (texto, puntuacion) VALUES ('$texto',$puntuacion)";
    $result = $con->query($query);
    if ($result) {
        $query = "SELECT * FROM comentarios WHERE texto = '$texto'";
        $result = $con->query($query);
        $aux = $result->fetch_assoc();
        $res = $aux['idComentario'];
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

function readAllComentariosFromID($idCuenta) {
    $con = conexionBD();
    $res = FALSE;
    $query = "SELECT * FROM comentarios WHERE idCuenta=$idCuenta";
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

//    comentarios en funcion de un articulo
function readAllComentariosFromArticulo($idArticulo) {
    $con = conexionBD();
    $res = FALSE;
    $query = "SELECT * FROM comentarios WHERE idArticulo=$idArticulo";
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

function asociaComentarioArticulo($idComentario, $idArticulo) {
    $con = conexionBD();
    $res = FALSE;
    $query = "UPDATE comentarios SET idArticulo = $idArticulo WHERE idComentario = $idComentario";
    $result = $con->query($query);
    if ($result) {
        $res = True;
    }
    desconectar($con);
    return $res;
}

function asociaComentarioCuenta($idComentario, $idCuenta) {
    $con = conexionBD();
    $res = FALSE;
    $query = "UPDATE comentarios SET idCuenta = $idCuenta WHERE idComentario = $idComentario";
    $result = $con->query($query);
    if ($result) {
        $res = True;
    }
    desconectar($con);
    return $res;
}

function asociaComentarioComentario($idComentario, $idRespuesta) {
    $con = conexionBD();
    $res = FALSE;
    $query = "UPDATE comentarios SET idRespuesta = $idRespuesta WHERE idComentario = $idComentario";
    $result = $con->query($query);
    if ($result) {
        $res = True;
    }
    desconectar($con);
    return $res;
}

function meGusta($idComentario) {
    $con = conexionBD();
    $res = FALSE;
    $query = "SELECT * FROM comentarios WHERE idComentario = $idComentario";
    $result = $con->query($query);
    $aux = $result->fetch_assoc();
    $puntuacion = $aux['puntuacion'];
    if ($puntuacion < 5 && $puntuacion >= 0) {
        $puntuacion = $puntuacion+1;
        $query = "UPDATE comentarios SET puntuacion = $puntuacion WHERE idComentario = $idComentario";
        $result = $con->query($query);
        if ($result) {
            $res = True;
        }
    }

    desconectar($con);
    return $res;
}
function noMeGusta($idComentario) {
    $con = conexionBD();
    $res = FALSE;
    $query = "SELECT * FROM comentarios WHERE idComentario = $idComentario";
    $result = $con->query($query);
    $aux = $result->fetch_assoc();
    $puntuacion = $aux['puntuacion'];
    if ($puntuacion <= 5 && $puntuacion > 0) {
        $puntuacion = $puntuacion-1;
        $query = "UPDATE comentarios SET puntuacion = $puntuacion WHERE idComentario = $idComentario";
        $result = $con->query($query);
        if ($result) {
            $res = True;
        }
    }

    desconectar($con);
    return $res;
}
