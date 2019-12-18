<?php

require_once 'conexion.php';

abstract class DAOGenerico {

    protected $tabla;
    protected $db;
    protected $con;

    public function __construct($tabla) {
        $this->tabla = (String) $tabla;
        $this->db = conexion::getInstance();
        $this->con = $this->db->getConnection();
    }

    public function readAll() {
        $result = $this->con->query("SELECT * FROM $this->tabla ORDER BY id DESC");
        $datos = array();
        if ($result->num_rows != 0) {
            array_push($datos, $result->fetch_assoc());
        }
        $result->free();
        return $datos;
    }

    public abstract function create($obj);

    public function read($id) {
        $result = $this->con->query("SELECT * FROM $this->tabla WHERE id = $id");
        $datos = FALSE;
        if ($result->num_rows !== 0) {
            $datos = $result->fetch_assoc();
        }
        $result->free();
        return $datos;
    }

    public abstract function update($obj);

    public function delete($id){
        $result = $this->con->query("DELETE FROM $this->tabla WHERE id = $id");
        $res = TRUE;
        if(!$result){
            $res = FALSE;
        }
        $result->free();
        return $res;
    }
    
    public function buscar($columna,$valor){
        $result = $this->con->query("SELECT * FROM $this->tabla WHERE $columna = $valor");
        $res = TRUE;
        if ($result->num_rows !== 0) {
            $datos = $result->fetch_assoc();
        }
        $result->free();
        return $datos;
    }
}
