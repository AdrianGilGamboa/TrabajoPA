<?php
function conectar(){
    $con = new mysqli("localhost","root","","moarnews");
    if($con->connect_errno){
        print "Error: " . $con->connect_error;
    }
    return $con;
}


?>

