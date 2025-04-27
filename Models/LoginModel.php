<?php

require_once 'Model.php';

class LoginModel extends Model{
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
            return $this->get_query($query, [':id_Usuario' => $id]);
        }
    }
    
    

    public function insert($usuario=array()){
        $query = "INSERT INTO usuarios 
        (nombre_completo, nombre_usuario, telefono, correo, direccion, contra, id_tipo_usuario, codigo_verificacion, verificado) 
        VALUES (:nombre_completo, :nombre_usuario, :telefono, :correo, :direccion, :contra, :id_tipo_usuario, :codigo_verificacion, :verificado)";
        return $this->set_query($query, $usuario);
    }

    public function update($usuario=array()){
        $query = 'UPDATE usuarios SET nombre_completo = :nombre_completo, nombre_usuario = :nombre_usuario, telefono = :telefono, correo = :correo, contra = :contra, direccion = :direccion, id_tipo_usuario = :id_tipo_usuario, codigo_verificacion = :codigo_verificacion, verificado = :verificado WHERE id_Usuario=:id_Usuario';
        return $this->set_query($query, $usuario);
    }

    public function delete($id=''){
        $query = 'DELETE FROM usuarios WHERE id_Usuario = :id_Usuario';
        return $this->set_query($query, [':id'=>$id]);
    }

    public function validateLogin($correo, $contra){
        // Preparamos la consulta SQL para verificar el correo y la contraseña
        $query = "SELECT id_tipo_usuario FROM usuarios WHERE correo = :correo AND contra = SHA2(:contra, 512)";
        
        // Llamamos a la función get_query pasando las variables
        return $this->get_query($query, ['correo' => $correo, 'contra' => $contra]);
    }

    public function verificarToken($token) {
        $query = "SELECT * FROM usuarios WHERE codigo_verificacion = :token AND verificado = 0";
        return $this->get_query($query, [':token' => $token]);
    }

    //para cambiar el campo verificado de 0 a 1 cuando el user ya se haya verificado
    public function Verificado($idUsuario) {
        $query = "UPDATE usuarios SET verificado = 1, codigo_verificacion = NULL WHERE id_Usuario = :id_Usuario";
        return $this->set_query($query, [':id_Usuario' => $idUsuario]);
    }


}