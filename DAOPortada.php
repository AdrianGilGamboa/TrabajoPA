<?php
require_once 'DaoGenerico.php';

use DaoGenerico;

class DAOPortada extends DAOGenerico{
    
    public function __construct() {
        parent::__construct("portada");
    }

    
    public function create($obj) {
        $fecha=$obj->getFecha();
        $resul=false;
        $query="INSERT INTO portadas (fecha) VALUES ('$fecha')";
        $result=$this->con->query($query);
        if($result){
            $result=true;
        }
        return $resul;
    }

    public function update($obj) {
        $fecha=$obj->getFecha();
        $id=$obj->getId();
        $resul=false;
        $query="UPDATE portadas SET fecha='$fecha' WHERE id=$id";
        $result=$this->con->query($query);
        if($result){
            $result=true;
        }
        return $resul;
    }
    public function buscar($columna, $valor) {
        return parent::buscar($columna, $valor);
    }

    public function delete($id): boolean {
        return parent::delete($id);
    }

    public function read($id) {
        return parent::read($id);
    }

    public function readAll(): array {
        return parent::readAll();
    }

}