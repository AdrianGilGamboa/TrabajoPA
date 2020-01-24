<!DOCTYPE html>
<?php
include_once ("../CRUD/CRUDAnuncio.php");
include_once ("../CRUD/CRUDAnunciante.php");
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
        if (!isset($_SESSION[''])) {
            header('Location:inicioSesion.php');
        }
        if (isset($_SESSION['cuentaID'])) {
            if ($_SESSION['tipo'] !== 'administrador') {
                $nombreUsuario = $_SESSION['nombreUsuario'];
                $idUsuario = $_SESSION['cuentaID'];
            } else {
                header('Location:cuenta.php');
            }
        }
        ?>
        <?php
        include_once 'nav.php';
        ?>
         <?php
        include_once 'header.php';
        ?>
          
        <form action="#" method="POST">
            <input type="submit" value="Create advertisement" name="creaAnuncio">
            <input type="submit" value="Delete advertisement" name="borraAnuncio">
            <input type="submit" value="Create advertiser" name="creaAnunciante">
            <input type="submit" value="Delete advertiser" name="borraAnunciante">
        </form>
        <?php
        if (isset($_POST['creaAnuncio'])) {
            ?>
            <form action="#" method="#">
                <table>
                    <tr>
                        <td>Description of the advertisement: </td>
                        <td><input type="text" name="descripcion"></td>
                    </tr>
                    <tr>
                        <td>Duration: </td>
                        <td><input type="number" name="duracion"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="file" name="imagen"></td>
                    </tr>                  
                    <input type="submit" name="creaA" value="Create advertisement">
                </table>
            </form>
            <?php
        } else if (isset($_POST['borraAnuncio'])) {
            $anuncios = readAllAnuncio();
            ?>
            <form action="#" method="POST">
                <table border = "2">
                    <tr>
                        <th></th>
                        <th>Advertisement</th>
                        <th>Image</th>
                    </tr>
                    <?php
                    $j = 0;
                    foreach ($anuncios as $anuncio) {
                        ?>
                        <tr>
                            <td><input type="checkbox" name="<?php echo $j++; ?>" value="<?php echo $anuncio['idAnuncio']; ?>"></td>
                            <td><?php echo $anuncio['descripcion']; ?></td>
                            <td><img src="anuncios/<?php echo $anuncio['imagen']; ?>" width='100'></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>>
            </form>
            <?php
        } else if (isset($_POST['creaAnunciante'])) {
            
        } else if (isset($_POST['borraAnunciante'])) {
            
        }
        ?>
        <footer id="footer">
            <div class="inner">
                <h2>Get In Touch</h2>
                <ul class="actions">
                    <li><i class="icon fa-phone"></i> <a href="#">(034)954 34 92 00</a></li>
                    <li><span class="icon fa-envelope"></span> <a href="#">moarNesws@gmail.com</a></li>
                    <li><span class="icon fa-map-marker"></span> Ctra. de Utrera, 1, 41013 Sevilla </li>
                </ul>
            </div>
            <div class="copyright">
                &copy; Newspaper. MoarNews <a href="https://www.upo.es/portal/impe/web/portada/index.html">MoarNews</a>. Images <a href="../imagenes/logo.jpeg" alt="logo">MoarNews</a>.

            </div>
        </footer>
    </body>
</html>
