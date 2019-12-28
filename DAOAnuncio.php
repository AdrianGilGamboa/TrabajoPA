<?php

require_once 'DaoGenerico.php';

use DaoGenerico;

class DAOAnuncio extends DAOGenerico {

    public function __construct() {
        parent::__construct("anuncios");
    }

    public function create($anuncioDatos) {
        $descripcion = $anuncioDatos['descripcion'];
        $imagen = $anuncioDatos['imagen'];
        $duracion = $anuncioDatos['duracion'];
        $resul = False;
        $query = "INSERT INTO anuncios (descripcion,imagen, duracion) VALUES ('$descripcion','$imagen','$duracion')";
        $result = $this->con->query($query);
        if ($result) {
            $resul = True;
        }
        return $resul;
    }

    public function update($anuncioDatos) {
        $descripcion = $anuncioDatos['descripcion'];
        $imagen = $anuncioDatos['imagen'];
        $duracion = $anuncioDatos['duracion'];
        $id = $anuncioDatos['id'];
        $resul = False;
        $query = "UPDATE anuncios SET descripcion='$descripcion', imagen='$imagen' , duracion='$duracion' WHERE id=$id";
        $result = $this->con->query($query);
        if ($result) {
            $resul = True;
           
        }
        return $resul;
    }
    
    public function delete($id): boolean {
        return parent::delete($id);
    }
    public function buscar($columna, $valor) {
        return parent::buscar($columna, $valor);
    }

    public function read($id) {
        return parent::read($id);
    }

    public function readAll(): array {
        return parent::readAll();
    }


}
