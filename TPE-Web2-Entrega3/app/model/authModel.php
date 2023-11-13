<?php

class UserModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=db_tecnotandil;charset=utf8', 'root', '');
    }

    public function getByEmail($email) {
        $query = $this->db->prepare('SELECT * FROM users WHERE email = ?');
        $query->execute([$email]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
    

    public function insertUser($email,$password){
        $query = $this->db->prepare('INSERT INTO users(email,password) VALUES (?,?)');
        $query->execute([$email,$password]);
    }
    public function getByRol($rol){
        $query = $this->db->prepare('SELECT * FROM users WHERE rol = ?');
        $query->execute([$rol]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

}
