<?php

require_once './app/model/categoriaModel.php';
require_once './app/views/viewCategoria.phtml';
require_once './app/helpers/auhtHelper.php';

    class categoriasController{
        private $model;
        private $view;
        private $auth;

        public function __construct(){
            $this->model = new categoriasModel();
            $this->view = new viewCategorias();
            $this->auth = new AuthController();
            
        }

        //Lista las categorias 
        function ListCategory(){
            if (!isset($_SESSION['email']))
                session_start();
            $category = $this->model->getCategory();
            $this->view->showCategorys($category);
        }

        //Enseña el formulario para editar una categoria
        function mostrarFormEditCategory($id_categoria){
            
            $categoria = $this->model->getCategoryById($id_categoria);
            $this->view->mostrarFormEditCategory($id_categoria, $categoria->nombre_categoria);
        }
    
        //Eliminamos las categorias
        function removeCategory($id){
            $this->model->eliminaCategory($id);
            header("Location:" . BASE_URL . "categorias");
        }


        //Añadimos una categoria
        function addCategory(){
            $nombre_categoria = $_POST['nombre_categoria'];
            
            if (empty($nombre_categoria)){
                $this->view->mostrarError("Debe completar todos los campos");
                return;
            }
            $id = $this->model->insertCategory($nombre_categoria);
            if ($id){
                header("Location:" . BASE_URL . "categorias");
            }
            else{
                $this->view->mostrarError("error al insertar el usuario");
            }
        }

        function modifyCategory(){
            $id = $_POST['id_categoria'];
            $nombre_categoria = $_POST['nombre_categoria'];
        
            if (empty($nombre_categoria)){
                $this->view->mostrarError("No ingreso bien los campos");
            }
            else{
                // Llama a la función actualizarCategoria con el nombre de la categoría y el ID
                $this->model->updateCategoria($id,$nombre_categoria);
                header("Location:" . BASE_URL . "categorias");
            }
        }
        
        function viewForm($id){
            $this->view->mostrarForm($id);
        }
    }