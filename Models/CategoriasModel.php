<?php

require_once 'Model.php';

class CategoriasModel extends Model {
    public function get($id = '') {
        if ($id == '') {
            $query = "SELECT * FROM categorias";
            return $this->get_query($query);
        } else {
            $query = "SELECT * FROM categorias WHERE id_categoria = :id";
            return $this->get_query($query, [':id' => $id]);
        }
    }

    public function insert($categoria = array()) {
        $query = "INSERT INTO categorias (nombre_categoria) VALUES (:nombre_categoria)";
        return $this->set_query($query, $categoria);
    }

    public function update($categoria = array()) {
        $query = "UPDATE categorias SET nombre_categoria = :nombre_categoria WHERE id_categoria = :id_categoria";
        return $this->set_query($query, $categoria);
    }

    public function delete($id = '') {
        $query = "DELETE FROM categorias WHERE id_categoria = :id";
        return $this->set_query($query, [':id' => $id]);
    }
}
