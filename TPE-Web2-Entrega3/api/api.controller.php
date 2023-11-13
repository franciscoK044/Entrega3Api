<?php
    require_once 'app/model/productosModel.php';
    require_once 'app/model/categoriaModel.php';
    require_once 'controller.php';
    
    class ApiController extends controller{
        private $model;
        private $modelCategoria;

        public function __construct() {
            parent::__construct();
              $this->model = new productosModel();
              $this->modelCategoria = new categoriasModel();
           }
       
        public function get($params = []){
            if (empty($params)){
                $productos = $this->model->getProductos();
                $this->view->response($productos ,200);
            }else{
                $producto = $this->model->getProducto($params[":ID"]);
                if (!empty($producto)){
                    $this->view->response($producto ,200);
                }else{
                    $this->view->response(['msg => la tarea' .$params[":ID"]. 'no existe'],404);
                }
            }
        }
        public function deleteProducto($params = []){
            $producto_id = $params[":ID"];
            $producto = $this->model->getProducto($producto_id);
            
            if ($producto){
                $this->model->eliminarProducto($producto_id);
                $this->view->response('producto id= $producto_id eliminado con exito' ,200);
            }
            else{
                $this->view->response('Producto $producto_id not found' ,404);
            }
        }
        function create($params = []){
            $body = $this->getData();
            $nombre = $body->nombre_producto;
            $modelo = $body->modelo;
            $precio = $body->precio;
            $categoria = $body->categoria;
            $categoriaAinsertar = $this->modelCategoria->getCategoryByNombre($categoria);
            if ($categoriaAinsertar){
                $id_categoria = $categoriaAinsertar->id_categoria;
                $this->model->insertProducto($nombre,$modelo,$precio,$id_categoria);
                $this->view->response('El producto fue insertado',201);  
            }else{
                $this->view->response('La categoria no existe',404);
            }
            
            
        }
        public function update($params = []) {
            $producto_id = $params[':ID'];
            $producto = $this->model->getProducto($producto_id);
        
            if ($producto) {
                $body = $this->getData();
                $nombre_producto = $body->nombre_producto;
                $modelo = $body->modelo;
                $precio = $body->precio;
                $this->model->updateProductos($producto_id, $nombre_producto, $modelo, $precio);
        
                $this->view->response("Producto actualizado correctamente", 200);
            } else {
                $this->view->response("Producto no encontrado", 404);
            }        
        }
        public function getProductoOrdenado($params = []) {
            if (($params[':ordenamiento'] == 'asc' || $params[':ordenamiento'] == 'desc') &&
                ($params[':sort'] == 'id_producto' || ($params[':sort'] == "nombre_producto") || ($params[':sort'] == "modelo") || ($params[':sort'] == "precio"))) {
                    
                $formaOrdenam = $params[':ordenamiento'];
                $valor = $params[':sort'];
        
                // Realiza acciones con el resultado de la consulta*/
                $productosOrdenados = $this->model->getProductosOrder($valor, $formaOrdenam);
        
                // Puedes hacer algo con los productos ordenados, como enviarlos como respuesta a la vista
                $this->view->response($productosOrdenados,200);
            } else {
                $this->view->response("No ingreso un campo correcto",404);
            }
        }        
    }