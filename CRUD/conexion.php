<?php
function conexionBD() {
    $baseDatos = require_once 'baseDatos.php';
    $con = new mysqli($baseDatos['host'], $baseDatos['user'], $baseDatos['pass'], $baseDatos['database']);
    if ($con->connect_errno) {
        die("Error al conectaro con la base de datos: " . $con->connect_error);
    }
    echo "Conexion establecida...<br>";
    return $con;
}

function desconectar($con) {
    $con->close();
}


