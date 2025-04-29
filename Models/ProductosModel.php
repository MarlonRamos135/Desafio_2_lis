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
    

    public function insert($producto = array()){
        $query = "INSERT INTO productos (codigo_producto, nombre_producto, descripcion, imagen, id_categoria, precio, existencias)
                  VALUES (:codigo_producto, :nombre_producto, :descripcion, :imagen, :id_categoria, :precio, :existencias)";
        return $this->set_query($query, $producto);
    }
    
    
    public function reducirExistencias($idProducto, $cantidad) {
        $query = "UPDATE productos 
                  SET existencias = existencias - :cantidad 
                  WHERE id_producto = :id_producto";
        return $this->set_query($query, [
            ':cantidad' => $cantidad,
            ':id_producto' => $idProducto
        ]);
    }
    

    public function delete($id = ''){
        // Paso 1: Eliminar los registros relacionados en detalle_venta
        $queryDetalle = 'DELETE FROM detalle_venta WHERE id_producto = :id';
        $this->set_query($queryDetalle, [':id' => $id]);
    
        // Paso 2: Eliminar el producto
        $queryProducto = 'DELETE FROM productos WHERE id_producto = :id';
        return $this->set_query($queryProducto, [':id' => $id]);
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