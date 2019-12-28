<!DOCTYPE html>
<?php
require_once 'DAOGenerico.php';
require_once 'DAOSeccion.php';
require_once 'Seccion.php';
$DAOSeccion = new DAOSeccion();
$seccion1 = new Seccion(null, 'futbol');
$DAOSeccion::readAll();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

    </body>
</html>
