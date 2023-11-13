<?php

    class productosModel{
        private $db;

        public function __construct(){
            $this->db = new PDO('mysql:host=localhost;dbname=db_tecnotandil;charset=utf8','root','');
        }   
        
    function getProductos(){
        
        $query = $this->db->prepare('SELECT * FROM producto');
        $query-> execute();
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }
    function getProductosOrder($valor,$ordenamiento){
        $query = $this->db->prepare("SELECT * FROM producto ORDER BY $valor $ordenamiento");
        $query->execute();
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    } 
    function getProductosOferta($categoriaNombre) {
        $query = $this->db->prepare("SELECT * FROM producto 
                                    WHERE oferta = 1 
                                    AND id_categoria IN (SELECT id_categoria FROM categoria WHERE nombre_categoria = :Categoria)");
        $query->bindParam(':Categoria', $categoriaNombre, PDO::PARAM_STR);
        $query->execute();
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }
    
    
    function getProducto($id){
        $query = $this->db->prepare('SELECT * FROM producto WHERE id_producto = ?');
        $query->execute([$id]);  // Pasa el valor del parámetro como un array
        $producto = $query->fetch(PDO::FETCH_OBJ);
        return $producto;
    }

    function getProductWithCategory($id_producto) {
        $query = $this->db->prepare('
            SELECT p.*, c.nombre_categoria 
            FROM producto AS p 
            INNER JOIN categoria AS c ON p.id_categoria = c.id_categoria 
            WHERE p.id_producto = :id_producto'
        );
    
        $query->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $query->execute();
        $productWithCategory = $query->fetch(PDO::FETCH_OBJ);
    
        return $productWithCategory;
    }

    function insertProducto($nombre_producto, $modelo, $precio, $id_categoria){
        $query = $this->db->prepare('INSERT INTO producto (nombre_producto, modelo, precio, id_categoria) VALUES (?,?,?,?)');
        $query->execute([$nombre_producto, $modelo, $precio, $id_categoria]);
        return $this->db->lastInsertId();
    }
    

    function eliminarProducto($id){
        
        $producto= $this->db->prepare("DELETE FROM producto WHERE id_producto= ?");
        $producto->execute(array($id));
        

    }

    function updateProductos($id_producto, $nombre_producto, $modelo, $precio){
        $consulta = $this->db->prepare('UPDATE producto SET nombre_producto=?, modelo=?, precio=? WHERE id_producto = ?');
        $consulta->execute(array($nombre_producto, $modelo, $precio, $id_producto));
    }


}