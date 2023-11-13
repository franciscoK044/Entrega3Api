<?php

require_once './app/model/categoriaModel.php';
require_once './app/model/productosModel.php';
require_once './app/views/viewProduct.phtml';


class productosController {
    private $model;
    private $view;
    private $categoriasModel;

    public function __construct() {
        $this->model = new productosModel();
        $this->categoriasModel = new categoriasModel();
        $this->view = new viewProducts();
    }

    function showProducts() {
        session_start();
        $products = $this->model->getProductos();
        $categoria = $this->categoriasModel->getCategory();
        $this->view->viewProducts($products,$categoria);
    }

    function viewProduct($id){    
        session_start();                    
        $products = $this->categoriasModel->getProductWithCategory($id);
        $this->view->viewItem($products);
    }


    function viewProductoID($id_producto) {
        session_start();
        $products = $this->model->getProductWithCategory($id_producto);
        $categoria = $this->categoriasModel->getCategoryById($products->id_categoria);
        $this->view->viewProductoID($id_producto, $products->nombre_producto, $products->precio, $products->modelo, $categoria->nombre_categoria);
    }

    function addProducto() {
        if (!empty($_POST['nombre_producto']) && !empty($_POST['modelo']) && !empty($_POST['precio']) && !empty($_POST['id_categoria'])){

            $value = $this->model->insertProducto($_POST['nombre_producto'],$_POST['modelo'],$_POST['precio'],$_POST['id_categoria']);

            if($value){
                header("Location:" . BASE_URL . "productos");
            }
            
            }
            else{
                $this->view->mostrarError("Completar todos los campos");
        }
    }

    function removeProducto($id_producto) {
        $this->model->eliminarProducto($id_producto);
        header("Location:" . BASE_URL . "productos");
    }

    function mostrarFormEditProductos($id_producto) {
        AuthHelper::verify();
        $producto = $this->model->getProductWithCategory($id_producto);
        $categorias = $this->categoriasModel->getCategory();
        $this->view->mostrarFormEditProducto($producto->id_producto, $producto->nombre_producto, $categorias);

    }

    function modifyProducto() {
        $id = $_POST['id_producto'];
        $nombre_producto = $_POST['nombre_producto'];
        $modelo = $_POST['modelo'];
        $precio = $_POST['precio'];
        $id_categoria = $_POST['id_categoria'];


        $this->model->updateProductos($id, $nombre_producto, $modelo, $precio,$id_categoria);
        header("Location:" . BASE_URL . "productos");
    }
}
