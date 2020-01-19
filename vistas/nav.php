<?php
include_once ("../CRUD/CRUDSeccion.php");
$secciones = readAllSeccion();
?>
<nav>
    <form action="seccion.php" method="POST">
        <ul>
            <?php
            foreach ($secciones as $seccion) {
                ?>
                <li><input type="submit" value="<?php echo $seccion['categoria']; ?>" name="seccion"></li>
                <?php
            }
            ?>
        </ul>
    </form>
</nav>
