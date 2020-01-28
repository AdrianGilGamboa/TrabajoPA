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
        $puntuacion = $puntuacion + 1;
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
    if ($puntuacion >= 0) {
        $puntuacion = $puntuacion + 1;
        $query = "UPDATE comentarios SET puntuacionNegativa = $puntuacion WHERE idComentario = $idComentario";
        $result = $con->query($query);
        if ($result) {
            $res = True;
        }
    }

    desconectar($con);
    return $res;
}

function TieneRespuesta($comentario) {
    $con = conexionBD();
    $res = true;
    //$result = readComentario($comentario);
    $query = "SELECT * FROM comentarios WHERE idRespuesta = $comentario";
    $result = $con->query($query);
    $aux = $result->fetch_assoc();
    if (!$aux) {
        $res = false;
    }else{
    }
    desconectar($con);
    return $res;
}

function hiloComentario($respuesta, $idUsuario, $idArticulo) {
    $con = conexionBD();
    $idComentario = $respuesta['idComentario'];
    ?>
    <ul>
        

                <?php
                $query = "SELECT * FROM comentarios WHERE idRespuesta = $idComentario";
                $result = $con->query($query);
                while ($comentario = mysqli_fetch_array($result)) {
                    
                    ?><li>
            <table class="listaComentario"  style="width: 100%"><tr>

                        <td> <?php
                            $autor = cuentaDadoComentario($comentario['idCuenta']);
                            ?>
                            <span style="color: <?php
                            if ($autor['formato'] === "gold") {
                                echo "gold";
                            } else if ($autor['formato'] === "silver") {
                                echo "silver";
                            } else if ($autor['formato'] === "bronze") {
                                echo "brown";
                            }
                            ?>">
                                
                               <?php echo $comentario['texto']; ?><br> </span>
                                <p style="text-align: right; margin:0px"><?php echo $autor['nombre'];?></p></td>
                        <td> <?php
                            $puntuacion = $comentario['puntuacion'];
                            ?>
                            <span style=" color: <?php
                            if ($autor['formato'] === "gold") {
                                echo "gold";
                            } else if ($autor['formato'] === "silver") {
                                echo "silver";
                            } else if ($autor['formato'] === "bronze") {
                                echo "brown";
                            }
                            ?>">Likes: <?php echo $puntuacion; ?></span><br>
                                  <?php
                                  $puntuacionNegativa = $comentario['puntuacionNegativa'];
                                  ?>
                            <span style=" color: <?php
                            if ($autor['formato'] === "gold") {
                                echo "gold";
                            } else if ($autor['formato'] === "silver") {
                                echo "silver";
                            } else if ($autor['formato'] === "bronze") {
                                echo "brown";
                            }
                            ?>">Dislikes: <?php echo $puntuacionNegativa; ?></span>

                        </td>
                        <?php if ($idUsuario) { ?>
                            <td> <form action="#" method="POST" style="padding: 0px;margin: 0px;">
                                    <ul class="actions vertical small">
                                        <input type="hidden" name="idComentario" value="<?php echo $comentario['idComentario']; ?>">
                                        <li>
                                            <i class="fa fa-thumbs-o-up fa-lg" aria-hidden="true"></i>
                                            <input class="nav-text" type="submit" name="like" value="like" style="background-color: green">

                                        </li>
                                        <li>
                                            <i class="fa fa-thumbs-o-down fa-lg" aria-hidden="true" ></i>
                                            <input class="nav-text" type="submit" name="dislike" value="dislike" style="background-color: red">
                                        </li>
                                    </ul>
                                </form></td> <?php } ?>

                    </tr>

                </table>
            </li>
            <?php
            if (TieneRespuesta($comentario['idComentario'])) {
                hiloComentario($comentario, $idUsuario, $idArticulo);
            }
                
        }
        ?>
    </ul>
    <?php
}

function readComentariosArticulo($idArticulo, $idUsuario) {
    $con = conexionBD();
    $res = False;
    $query = "SELECT * FROM comentarios WHERE idArticulo = $idArticulo and idRespuesta is NULL";
    $result = $con->query($query);
    ?>
    <ul>
        
                <?php
                while ($comentario = mysqli_fetch_array($result)) {
                    ?><li>
            <table class="listaComentarioPrincipal"  style="width: 100%"><tr>

                        <td> <?php
                            $autor = cuentaDadoComentario($comentario['idCuenta']);
                            ?>
                            <span style="color: <?php
                            if ($autor['formato'] === "gold") {
                                echo "gold";
                            } else if ($autor['formato'] === "silver") {
                                echo "silver";
                            } else if ($autor['formato'] === "bronze") {
                                echo "brown";
                            }
                            ?>">
                                
                               <?php echo $comentario['texto']; ?><br> </span>
                                <p style="text-align: right;margin:0px"><?php echo $autor['nombre'];?></p></td>
                        <td> <?php
                            $puntuacion = $comentario['puntuacion'];
                            ?>
                            <span style=" color: <?php
                            if ($autor['formato'] === "gold") {
                                echo "gold";
                            } else if ($autor['formato'] === "silver") {
                                echo "silver";
                            } else if ($autor['formato'] === "bronze") {
                                echo "brown";
                            }
                            ?>">Likes: <?php echo $puntuacion; ?></span><br>
                                  <?php
                                  $puntuacionNegativa = $comentario['puntuacionNegativa'];
                                  ?>
                            <span style=" color: <?php
                            if ($autor['formato'] === "gold") {
                                echo "gold";
                            } else if ($autor['formato'] === "silver") {
                                echo "silver";
                            } else if ($autor['formato'] === "bronze") {
                                echo "brown";
                            }
                            ?>">Dislikes: <?php echo $puntuacionNegativa; ?></span>

                        </td>
        <?php if ($idUsuario) { ?>
                            <td> <form action="#" method="POST" style="padding: 0px;margin: 0px;">
                                    <ul class="actions vertical small">
                                        <input type="hidden" name="idComentario" value="<?php echo $comentario['idComentario']; ?>">
                                        <li>
                                            <i class="fa fa-thumbs-o-up fa-lg" aria-hidden="true"></i>
                                            <input class="nav-text" type="submit" name="like" value="like" style="background-color: green">

                                        </li>
                                        <li>
                                            <i class="fa fa-thumbs-o-down fa-lg" aria-hidden="true" ></i>
                                            <input class="nav-text" type="submit" name="dislike" value="dislike" style="background-color: red">
                                        </li>
                                    </ul>
                                </form></td> <?php } ?>

                    </tr>
                </table>
            </li>

            <?php
            if (TieneRespuesta($comentario['idComentario'])) {
                hiloComentario($comentario, $idUsuario, $idArticulo);
            }
        }
        ?>
    </ul>
    <?php
    desconectar($con);
    return $res;
}
