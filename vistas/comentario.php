<!DOCTYPE html>
<?php
include_once ("../CRUD/CRUDComentario.php");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content=="IE=edge"/>
        <meta name="google" value="notranslate"/>
        <link href="css.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <title></title>
    </head>
    <body>



        <?php
        session_start();
        if (!isset($_SESSION['cuentaID'])) {
            header('Location: inicioSesion.php');
        }
        if (isset($_SESSION['cuentaID'])) {
            $nombreUsuario = $_SESSION['nombreUsuario'];
            $idUsuario = $_SESSION['cuentaID'];
        }
        ?>
        
        <?php
        if(isset($_POST['confirmarComen'])){
            $idArticulo = $_POST['idArticulo'];
            $idCuenta = $_POST['idCuenta'];
            $texto = $_POST['comentario'];
            $puntuacion = 0;
            $puntuacionNegativa = 0;
            $comentario = array(
                'texto'=>$texto,
                'puntuacion'=>$puntuacion,
                'puntuacionNegativa'=>$puntuacionNegativa
            );
            if(($idComentario = createComentario($comentario))!==FALSE){
                asociaComentarioArticulo($idComentario,$idArticulo);
                asociaComentarioCuenta($idComentario,$idCuenta);
                header('Location: portada.php');
            }
        }else if(isset($_POST['confirmarResp'])){
            $idArticulo = $_POST['idArticulo'];
            $idCuenta = $_POST['idCuenta'];
            $idRespuesta = $_POST['idComentario'];
            $texto = $_POST['comentario'];
            $puntuacion = 0;
            $puntuacionNegativa = 0;
            $comentario = array(
                'texto'=>$texto,
                'puntuacion'=>$puntuacion,
                'puntuacionNegativa'=>$puntuacionNegativa
            );
            if(($idComentario = createComentario($comentario))!==FALSE){
                asociaComentarioArticulo($idComentario,$idArticulo);
                asociaComentarioCuenta($idComentario,$idCuenta);
                asociaComentarioComentario($idComentario,$idRespuesta);
                header('Location: portada.php');
            }
        }else if (isset($_POST['comentar'])) {
            ?>
            <form action="#" method="POST">
                <input type="text" name="comentario" placeholder="Comment">
                <input type="hidden" name="idArticulo" value="<?php echo $_POST['articulo'];?>">
                <input type="hidden" name="idCuenta" value="<?php echo $_POST['cuenta'];?>">
                <input type="submit" name="confirmarComen" value="Comment">
            </form>
            <?php
        } else if (isset($_POST['responder'])) {
            ?>
            <form action="#" method="POST">
                <input type="text" name="comentario" placeholder="Comment">
                <input type="hidden" name="idArticulo" value="<?php echo $_POST['articulo'];?>">
                <input type="hidden" name="idCuenta" value="<?php echo $_POST['cuenta'];?>">
                <input type="hidden" name="idComentario" value="<?php echo $_POST['comentario'];?>">
                <input type="submit" name="confirmarResp" value="Reply comment">
            </form>
            <?php
        }
        ?>
        <?php
        include_once 'nav.php';
        ?>
        <footer id="footer">
            <div class="inner">
                <h2>Get In Touch</h2>
                <ul class="actions">
                    <li><i class="icon fa-phone"></i> <a href="#">(034)954 34 92 00</a></li>
                    <li><span class="icon fa-envelope"></span> <a href="#">moarnewspa@gmail.com</a></li>
                    <li><span class="icon fa-map-marker"></span> Ctra. de Utrera, 1, 41013 Sevilla </li>
                </ul>
            </div>
            <div class="copyright">
                &copy; Newspaper. MoarNews <a href="https://www.upo.es/portal/impe/web/portada/index.html">MoarNews</a>. Images <a href="../imagenes/logo.jpeg" alt="logo">MoarNews</a>.

            </div>
        </footer>
    </body>
</html>