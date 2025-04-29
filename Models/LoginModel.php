<?php

require_once 'Model.php';

class LoginModel extends Model {
    
    public function get($id = ''){
        if ($id == '') {
            $query = "SELECT u.*, t.tipo_usuario AS nombre_rol
                      FROM usuarios u
                      JOIN tipo_usuarios t ON u.id_tipo_usuario = t.id_tipo_usuario";
            return $this->get_query($query);
        } else {
            $query = "SELECT u.*, t.tipo_usuario AS nombre_rol
                      FROM usuarios u
                      JOIN tipo_usuarios t ON u.id_tipo_usuario = t.id_tipo_usuario
                      WHERE u.id_Usuario = :id_Usuario";
            $result = $this->get_query($query, [':id_Usuario' => $id]);
            return $result ? $result[0] : null; // <<< Aquí tomo el primer usuario
        }
    }
    
    
    public function insert($usuario = array()){
        $query = "INSERT INTO usuarios 
                  (nombre_completo, nombre_usuario, telefono, correo, direccion, contra, id_tipo_usuario) 
                  VALUES 
                  (:nombre_completo, :nombre_usuario, :telefono, :correo, :direccion, :contra, :id_tipo_usuario)";
        return $this->set_query($query, $usuario);
    }
    

    public function update($usuario = array()){
        $query = "UPDATE usuarios 
                  SET nombre_completo = :nombre_completo, 
                      nombre_usuario = :nombre_usuario, 
                      telefono = :telefono, 
                      correo = :correo,
                      direccion = :direccion, 
                      id_tipo_usuario = :id_tipo_usuario 
                  WHERE id_Usuario = :id_Usuario";
        return $this->set_query($query, $usuario);
    }

    public function delete($id = ''){
        $query = "DELETE FROM usuarios WHERE id_Usuario = :id_Usuario";
        return $this->set_query($query, [':id_Usuario' => $id]);
    }

    public function validateLogin($correo){
        $query = "SELECT id_Usuario, correo, nombre_usuario, contra, id_tipo_usuario 
                  FROM usuarios 
                  WHERE correo = :correo";
        $result = $this->get_query($query, [':correo' => $correo]);
        return $result ? $result[0] : null;
    }
    
    
    
}
