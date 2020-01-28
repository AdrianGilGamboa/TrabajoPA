<?php

include_once "conexion.php";

//Devuelve True si ha creado o False si hay error
function createComentario($comentario) {
    $con = conexionBD();
    $res = FALSE;
    $texto = $comentario['texto'];
    $puntuacion = $comentario['puntuacion'];
    $puntuacionNegativa = $comentario['puntuacionNegativa'];
    $query = "INSERT INTO comentarios (texto, puntuacion, puntuacionNegativa) VALUES ('$texto',$puntuacion,$puntuacionNegativa)";
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
    if ($puntuacion >= 0) {
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
    $puntuacion = $aux['puntuacionNegativa'];
    if ( $puntuacion >= 0) {
        $puntuacion = $puntuacion+1;
        $query = "UPDATE comentarios SET puntuacionNegativa = $puntuacion WHERE idComentario = $idComentario";
        $result = $con->query($query);
        if ($result) {
            $res = True;
        }
    }

    desconectar($con);
    return $res;
}

function hiloComentario($respuesta, $idUsuario, $idArticulo) {
    $con = conexionBD();
    $idComentario = $respuesta['idComentario'];
    ?>
    <ul class="listaComentario">
        <?php
        $query = "SELECT * FROM comentarios WHERE idRespuesta = $idComentario";
        $result = $con->query($query);
        while ($respuesta = mysqli_fetch_array($result)) {
            ?><li><?php echo $respuesta['texto']; ?></li>
            <form action="comentario.php" method="POST" class="comentario">
                <input type="hidden" name="articulo" value="<?php echo $idArticulo; ?>">
                <input type="hidden" name="cuenta" value="<?php echo $idUsuario; ?>">
                <input type="hidden" name="comentario" value="<?php echo $respuesta['idComentario']; ?>">
                <input class="small" type="submit" name="responder" value="Reply comment">
            </form>
            <form action="#" method="POST" class="comentario">
                <input type="hidden" name="idComentario" value="<?php echo $respuesta['idComentario']; ?>">
                <input class="small" type="submit" name="like" value="Like">
                <input class="small" type="submit" name="dislike" value="Dislike">
            </form>
                <?php
            hiloComentario($respuesta, $idUsuario, $idArticulo);
        }
        ?>
    </ul><?php
}

function readComentariosArticulo($idArticulo, $idUsuario) {
    $con = conexionBD();
    $res = False;
    $query = "SELECT * FROM comentarios WHERE idArticulo = $idArticulo and idRespuesta is NULL";
    $result = $con->query($query);
    ?>
    <ul class="listaComentario">
        <?php
        while ($comentario = mysqli_fetch_array($result)) {
            ?><li><?php echo $comentario['texto']; ?></li>
            <form action="comentario.php" method="POST" class="comentario">
                <input type="hidden" name="articulo" value="<?php echo $idArticulo; ?>">
                <input type="hidden" name="cuenta" value="<?php echo $idUsuario; ?>">
                <input type="hidden" name="comentario" value="<?php echo $comentario['idComentario']; ?>">
                <input class="small" type="submit" name="responder" value="Reply comment">
            </form>
            <form action="#" method="POST" class="comentario">
                <input type="hidden" name="idComentario" value="<?php echo $comentario['idComentario']; ?>">
                <input class="small" type="submit" name="like" value="Like">
                <input class="small" type="submit" name="dislike" value="Dislike">
            </form>
                <?php
            ?><?php
            hiloComentario($comentario, $idUsuario, $idArticulo);
        }
        ?>
    </ul>
    <?php
    desconectar($con);
    return $res;
}