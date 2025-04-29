<?php

require_once 'Model.php';

class VentasModel extends Model {

    public function getDetalleComprasPorUsuario($idUsuario) {
        $query = "SELECT 
                    v.id_venta,
                    v.fecha,
                    v.total,
                    p.nombre_producto,
                    dv.cantidad,
                    dv.precio_unitario,
                    dv.subtotal
                  FROM ventas v
                  INNER JOIN detalle_venta dv ON v.id_venta = dv.id_venta
                  INNER JOIN productos p ON dv.id_producto = p.id_producto
                  WHERE v.id_usuario = :id_usuario
                  ORDER BY v.fecha DESC";
        
        return $this->get_query($query, [':id_usuario' => $idUsuario]);
    }
    
    
    public function insertVenta($venta = array()) {
        $query = "INSERT INTO ventas (id_usuario, fecha, total) 
                  VALUES (:id_usuario, NOW(), :total)";
        return $this->set_query($query, $venta);
    }
  
    public function insertDetalleVenta($detalle = array()) {
        $query = "INSERT INTO detalle_venta (id_venta, id_producto, cantidad, precio_unitario, subtotal)
                  VALUES (:id_venta, :id_producto, :cantidad, :precio_unitario, :subtotal)";
        return $this->set_query($query, $detalle);
    }
}
