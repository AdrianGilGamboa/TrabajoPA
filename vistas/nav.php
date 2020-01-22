<?php
include_once ("../CRUD/CRUDSeccion.php");
$secciones = readAllSeccion();
?>
<nav>
    <ul>
        <?php
        foreach ($secciones as $seccion) {
            ?>
            <li><a href="seccion.php?idSeccion=<?php echo $seccion['idSeccion'] ?>"><?php echo $seccion['categoria']?></a></li>
            <?php
        }
        ?>
    </ul>
</nav>
