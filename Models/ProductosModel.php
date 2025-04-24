<?php

require_once 'Model.php';

class ProductosModel extends Model{
    public function get($id=''){
        if($id == ''){
            $query = "SELECT p.*, c.nombre_categoria AS categoria 
                      FROM productos p 
                      JOIN categorias c ON p.id_categoria = c.id_categoria";
            return $this->get_query($query);
        } else {
            $query = "SELECT p.*, c.nombre_categoria AS categoria 
                      FROM productos p 
                      JOIN categorias c ON p.id_categoria = c.id_categoria
                      WHERE p.id_producto = :id";
            return $this->get_query($query, [':id' => $id])[0]; // Solo una fila
        }
    }
    

    public function insert($producto=array()){
        $query = "INSERT INTO productos VALUES (:nombre, :descripcion, :precio, :stock, :imagen_url, :activo, :fecha_creacion)";
        return $this->set_query($query, $producto);
    }

    public function delete($id=''){
        $query = 'DELETE FROM productos WHERE id = :id';
        return $this->set_query($query, [':id'=>$id]);
    }

    public function update($producto = array()){
        $query = "UPDATE productos SET 
                    nombre_producto = :nombre, 
                    descripcion = :descripcion, 
                    imagen = :imagen,
                    id_categoria = :categoria,
                    precio = :precio,
                    existencias = :cantidad 
                  WHERE id_producto = :id";
        return $this->set_query($query, $producto);
    }
}