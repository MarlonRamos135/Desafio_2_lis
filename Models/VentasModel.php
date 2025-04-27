<?php

require_once 'Model.php';

class VentasModel extends Model {
    public function get($id = '') {
        if ($id == '') {
            $query = "SELECT v.*, u.nombre_usuario AS usuario, p.nombre_producto AS producto 
                      FROM ventas v 
                      JOIN usuarios u ON v.id_usuario = u.id_usuario 
                      JOIN productos p ON v.id_producto = p.id_producto";
            return $this->get_query($query);
        } else {
            $query = "SELECT v.*, u.nombre_usuario AS usuario, p.nombre_producto AS producto 
                      FROM ventas v 
                      JOIN usuarios u ON v.id_usuario = u.id_usuario 
                      JOIN productos p ON v.id_producto = p.id_producto
                      WHERE v.id_venta = :id";
            return $this->get_query($query, [':id' => $id])[0]; // Solo una fila
        }
    }

    public function insert($venta = array()) {
        $query = "INSERT INTO ventas (id_usuario, id_producto, cantidad, total, fecha_venta) 
                  VALUES (:id_usuario, :id_producto, :cantidad, :total, :fecha_venta)";
        return $this->set_query($query, $venta);
    }

}