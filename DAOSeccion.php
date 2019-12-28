<?php
require_once 'DaoGenerico.php';

use DAOGenerico;

class DAOSeccion extends DAOGenerico{
    
    public function __construct() {
        parent::__construct("secciones");
    }

    
    public function create($obj) {
        $categoria=$obj->getCategoria();
        $resul=false;
        $query="INSERT INTO secciones (categoria) VALUES ('$categoria')";
        $result=$this->con->query($query);
        if($result){
            $result=true;
        }
        return $resul;
    }

    public function update($obj) {
        $categoria=$obj->getCategoria();
        $id=$obj->getId();
        $resul=false;
        $query="UPDATE secciones SET categoria='$categoria' WHERE id=$id";
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