<?php

//SIGLETON
class conexion {

    private static $instance;
    private $con;

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        //$config = require_once 'baseDatos.php';
        $config=array(
    "host" => "localhost",
    "user" => "root",
    "pass" => "",
    "database" => "moarnews",
    "charset" => "utf8"
);
       // $this->con = new mysqli(config["host"], config["user"], config["pass"], config["database"]);
        $this->con = new mysqli("localhost", "root", "", "moarnews");
        if ($this->con->connect_errno) {
            die("Error: " . $this->con->connect_error);
        }
        $this->con->set_charset("utf8");
    }
    
    public function getConnection() {
        return $this->con;
    }

}
?>

