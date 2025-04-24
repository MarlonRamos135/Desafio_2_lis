<?php

abstract class Model {
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $db_name = 'textilexport_db';
    protected $conn;

    protected function open_db() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name;charset=utf8", $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("❌ Error de conexión a la base de datos: " . $e->getMessage());
        }
    }

    protected function close_db() {
        $this->conn = null;
    }

    protected function get_query($query, $params = array()) {
        try {
            $this->open_db();
            if (!$this->conn) throw new Exception("Conexión no establecida");

            $stm = $this->conn->prepare($query);
            $stm->execute($params);

            $rows = [];
            while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                $rows[] = $row;
            }

            $this->close_db();
            return $rows;
        } catch (Exception $e) {
            $this->close_db();
            error_log("❌ Error en get_query(): " . $e->getMessage());
            return [];
        }
    }

    protected function set_query($query, $params = array()) {
        try {
            $this->open_db();
            if (!$this->conn) throw new Exception("Conexión no establecida");

            $stm = $this->conn->prepare($query);
            $stm->execute($params);
            $affectedRows = $stm->rowCount();

            $this->close_db();
            return $affectedRows;
        } catch (Exception $e) {
            $this->close_db();
            error_log("❌ Error en set_query(): " . $e->getMessage());
            return 0;
        }
    }
}
