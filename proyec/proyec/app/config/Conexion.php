<?php

class Conexion {
    private $host = "localhost";
    private $db   = "sistema_usuarios"; 
    private $user = "root";           
    private $pass = "";               
    private $charset = "utf8mb4";     

    protected $pdo;

    public function __construct() {
        try {
            // Construir el DSN (Data Source Name)
            $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
            
            // Configuraciones de PDO
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       
                PDO::ATTR_EMULATE_PREPARES   => false,                 
            ];

            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
            
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function conectar() {
        return $this->pdo;
    }
}