<?php
function conexionBD() {
    $baseDatos = require 'baseDatos.php';

    $con = new mysqli($baseDatos['host'], $baseDatos['user'], $baseDatos['pass'], $baseDatos['database']);

    if ($con->connect_errno) {
        die("Error al conectar con la base de datos: " . $con->connect_error);
    }

    return $con;
}

function desconectar($con) {
    $con->close();
}


