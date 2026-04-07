<?php
require_once "app/config/Conexion.php";

class UsuarioModel extends Conexion {

    public function registrar($d) {
        try {
            $sql = "INSERT INTO usuarios (nombre, apellido, cedula, direccion, telefono, email, password, id_rol) 
                    VALUES (:n, :a, :c, :d, :t, :e, :p, 2)";
            
            $stmt = $this->conectar()->prepare($sql);
            
            return $stmt->execute([
                ':n' => $d['name'], 
                ':a' => $d['lastname'], 
                ':c' => $d['cedula'], 
                ':d' => $d['direction'], 
                ':t' => $d['phone'], 
                ':e' => $d['email'], 
                ':p' => password_hash($d['password'], PASSWORD_BCRYPT)
            ]);
        } catch (PDOException $e) { 
            error_log("Error en registro: " . $e->getMessage());
            return false; 
        }
    }
    public function obtenerPorEmail($email) {
    try {
        $sql = "SELECT * FROM usuarios WHERE email = :e LIMIT 1";
        $stmt = $this->conectar()->prepare($sql);
        $stmt->execute([':e' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return false;
    }
}
}