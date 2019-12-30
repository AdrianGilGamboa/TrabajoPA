<?php

include "conexion.php";
//Devuelve True si ha creado o False si hay error
function create($comentario) {
    $con = conexionBD();
    $res = FALSE;
    $nombre = $cuenta['nombre'];
    $usuario = $cuenta['usuario'];
    $clave = $cuenta['clave'];
    $email = $cuenta['email'];
    $formato = $cuenta['formato'];
    $tipo = $cuenta['tipo'];
    $query = "INSERT INTO cuenta (nombre, usuario, clave, email, formato, tipo) VALUES ('$nombre','$usuario','$clave','$email','$formato','$tipo')";
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
    $query = "SELECT * FROM cuenta WHERE id = $id";
    $result = $con->query($query);
    if ($result->num_rows !== 0) {
        $res = $result->fetch_assoc();
    }
    desconectar($con);
    return $res;
}

//Devuelve True si ha actualizado o False si hay error
function update($cuenta) {
    $con = conexionBD();
    $res = FALSE;
    $id = $cuenta['id'];
    $nombre = $cuenta['nombre'];
    $usuario = $cuenta['usuario'];
    $clave = $cuenta['clave'];
    $email = $cuenta['email'];
    $formato = $cuenta['formato'];
    $tipo = $cuenta['tipo'];
    $query = "UPDATE cuenta SET nombre = '$nombre', usuario = '$usuario', clave = '$clave', email = '$email', formato = '$formato', tipo = '$tipo' WHERE id = $id";
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
    $query = "DELETE FROM cuentas WHERE id = $id";
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
    $query = "SELECT * FROM cuentas";
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