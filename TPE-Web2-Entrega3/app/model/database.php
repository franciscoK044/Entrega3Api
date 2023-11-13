<?php

class Database {
    private $pdo;

    public function __construct() {
        // Configuración de la base de datos
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
        $user = DB_USER;
        $password = DB_PASSWORD;

        try {
            $this->pdo = new PDO($dsn, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Error en la conexión a la base de datos: ' . $e->getMessage());
        }
    }

    public function getPdo() {
        return $this->pdo;
    }
}

$database = new Database();
$pdo = $database->getPdo();


?>
