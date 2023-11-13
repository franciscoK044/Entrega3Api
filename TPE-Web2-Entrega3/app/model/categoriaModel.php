<?php

    class categoriasModel{
        private $db;

        public function __construct(){
            $this->db = new PDO('mysql:host=localhost;dbname=db_tecnotandil;charset=utf8','root','');
        }   
        function getCategory(){
            
            $query = $this->db->prepare('SELECT * FROM categoria');
            $query->execute();
            $category = $query->fetchAll(PDO::FETCH_OBJ);
    
            return $category;
        }


        function getProductWithCategory($id_categoria) {
            $query = $this->db->prepare('SELECT p.*, c.nombre_categoria FROM producto p 
            INNER JOIN categoria c ON p.id_categoria = c.id_categoria WHERE c.id_categoria = :id_categoria');
            $query->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
            $query->execute();
            $productWithCategory = $query->fetchAll(PDO::FETCH_OBJ);
        
            return $productWithCategory;
        }
        
        

        function eliminaCategory($id){

            $sentenciaProducto = $this->db->prepare("DELETE FROM producto WHERE id_categoria = ?");
            $sentenciaProducto->execute(array($id));

            $sentenciaCategoria = $this->db->prepare("DELETE FROM categoria WHERE id_categoria = ?");
            $sentenciaCategoria->execute(array($id));

        }
        
        function getCategoryById($id){
            $query = $this->db->prepare('SELECT * FROM categoria WHERE id_categoria = ?');
            $query->execute([$id]);
            $category = $query->fetch(PDO::FETCH_OBJ);
    
            return $category;
        }

        function getCategoryByNombre($nombre_categoria){
            $query = $this->db->prepare('SELECT * FROM categoria WHERE nombre_categoria = ?');
            $query->execute([$nombre_categoria]);
            $category = $query->fetch(PDO::FETCH_OBJ);
    
            return $category;
        }

        function insertCategory($nombre_categoria){
            $query = $this->db->prepare('INSERT INTO categoria (nombre_categoria) VALUES(?)');
            $query-> execute([$nombre_categoria]);
            return $this->db->lastInsertId();
        }

        function updateCategoria($id_categoria, $nombre_categoria){
            $consulta = $this->db->prepare('UPDATE categoria SET nombre_categoria = ? WHERE id_categoria = ?');
            $consulta->execute([$nombre_categoria,$id_categoria]);
        }
                
    }