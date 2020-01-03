<?php

include "conexion.php";
//Devuelve True si ha creado o False si hay error
function create($cuenta) {
    $con = conexionBD();
    $res = FALSE;
    $nombre = $cuenta['nombre'];
    $usuario = $cuenta['usuario'];
    $clave = $cuenta['clave'];
    $email = $cuenta['email'];
    $formato = $cuenta['formato'];
    $tipo = $cuenta['tipo'];
    $Dv = $cuenta['Dv'];
    $gustos = implode(",", $cuenta['gustos']);                                                                                                                              
    $query = "INSERT INTO cuentas (nombre, usuario, clave, email, formato, tipo, Dv, gustos) VALUES ('$nombre','$usuario','$clave','$email','$formato','$tipo',$Dv,'$gustos')";
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
    $query = "SELECT * FROM cuentas WHERE idCuenta = $id";
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
    $id = $cuenta['idCuenta'];
    $nombre = $cuenta['nombre'];
    $usuario = $cuenta['usuario'];
    $clave = $cuenta['clave'];
    $email = $cuenta['email'];
    $formato = $cuenta['formato'];
    $tipo = $cuenta['tipo'];
    $query = "UPDATE cuentas SET nombre = '$nombre', usuario = '$usuario', clave = '$clave', email = '$email', formato = '$formato', tipo = '$tipo' WHERE idCuenta = $id";
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
    $query = "DELETE FROM cuentas WHERE idCuenta = $id";
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
