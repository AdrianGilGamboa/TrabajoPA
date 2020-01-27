<?php

include_once "conexion.php";

//Devuelve True si ha creado o False si hay error
function createCuenta($cuenta) {
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
    if ($result) {
        $res = TRUE;
    }
    desconectar($con);
    return $res;
}

//Devuelve False si no hay datos o un array con el datos
function readCuenta($id) {
    $con = conexionBD();
    $res = False;
    $query = "SELECT * FROM cuentas WHERE idCuenta = $id";
    $result = $con->query($query);
    if ($result) {
        $res = $result->fetch_assoc();
    }

    desconectar($con);
    return $res;
}

//Devuelve True si ha actualizado o False si hay error
function updateCuenta($cuenta) {
    $con = conexionBD();
    $res = FALSE;
    $id = $cuenta['idCuenta'];
    $nombre = $cuenta['nombre'];
    $usuario = $cuenta['usuario'];
    $clave = $cuenta['clave'];
    $claveEncriptada = password_hash($clave, PASSWORD_DEFAULT);
    $email = $cuenta['email'];
    $formato = $cuenta['formato'];
    $tipo = $cuenta['tipo'];
    $Dv = $cuenta['Dv'];
    $gustos = $cuenta['gustos'];
    $query = "UPDATE cuentas SET nombre = '$nombre', usuario = '$usuario', clave = '$claveEncriptada', email = '$email', formato = '$formato', tipo = '$tipo', Dv = $Dv, gustos='$gustos' WHERE idCuenta = $id";
    $result = $con->query($query);
    if ($result) {
        $res = True;
    }
    desconectar($con);
    return $res;
}

//Devuelve True si se ha borrado o  False y hay error
function deleteCuenta($id) {
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
function readAllCuenta() {
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

function inicioDeSesionValido($usuario, $clave) {
    $res = null;
    $con = conexionBD();

    $result = $con->query('SELECT * FROM cuentas WHERE UPPER(usuario) LIKE UPPER("' . $usuario . '") LIMIT 1');
    if (!$result) {
        die("Fallo de consulta sql" . $con->mysqli_errno);
    }
    if ($result->num_rows !== 0) {
        $resultados = $result->fetch_assoc();
        if (password_verify($clave, $resultados['clave'])) {
            $res = $resultados;
        }
    }
    desconectar($con);
    return $res;
}

function registrar($nombre, $usuario, $clave, $email, $Dv, $gustos) {
    $res = False;
    $con = conexionBD();
    echo "<br/>" . $nombre . " " . $usuario . " " . $clave . " " . $email . " " . $Dv . " " . $gustos;
    $claveEncriptada = password_hash($clave, PASSWORD_DEFAULT);
    if ($Dv) {
        $Dv = "TRUE";
    } else {
        $Dv = "FALSE";
    }
    $result = $con->query("INSERT INTO cuentas (nombre, usuario, clave, email, formato, tipo, Dv, gustos) VALUES ('$nombre', '$usuario','$claveEncriptada','$email','normal','usuario', $Dv, '$gustos')");
    if ($result) {
        $res = True;
    }
    desconectar($con);
    return $res;
}

function cuentaDadoComentario($idCuenta) {
    $con = conexionBD();
    $res = False;
    $query = "SELECT * FROM cuentas WHERE idCuenta = $idCuenta";
    $result = $con->query($query);
    if ($result) {
        $res = $result->fetch_assoc();
    }

    desconectar($con);
    return $res;
}

function formato($formato,$idCuenta){
    $con = conexionBD();
    $res = False;
    $query = "UPDATE cuentas SET formato = '$formato' WHERE idCuenta = $idCuenta";
    $result = $con->query($query);
    if ($result) {
        $res = True;
    }
    desconectar($con);
    return $res;
}

function updateCuentaSinClave($cuenta) {
    $con = conexionBD();
    $res = FALSE;
    $id = $cuenta['idCuenta'];
    $nombre = $cuenta['nombre'];
    $usuario = $cuenta['usuario'];
    $email = $cuenta['email'];
    $formato = $cuenta['formato'];
    $tipo = $cuenta['tipo'];
    $Dv = $cuenta['Dv'];
    $gustos = $cuenta['gustos'];
    $query = "UPDATE cuentas SET nombre = '$nombre', usuario = '$usuario', email = '$email', formato = '$formato', tipo = '$tipo', Dv = $Dv, gustos='$gustos' WHERE idCuenta = $id";
    $result = $con->query($query);
    if ($result) {
        $res = True;
    }
    desconectar($con);
    return $res;
}
