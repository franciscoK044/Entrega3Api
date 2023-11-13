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
       
           public function get($params = []) {
            if (empty($params)) {
                $productos = $this->model->getProductos();
                $this->view->response($productos, 200);
            } else {
                // Verifica si el parámetro ":ID" está presente
                if (isset($params[":ID"])) {
                    $producto = $this->model->getProducto($params[":ID"]);
                    if (!empty($producto)) {
                        $this->view->response($producto, 200);
                    } else {
                        $this->view->response(['msg' => 'El producto con ID ' . $params[":ID"] . ' no existe'], 404);
                    }
                } else {
                    // Error 400: Solicitud incorrecta debido a parámetros inválidos
                    $this->view->response(['msg' => 'Solicitud incorrecta. El parámetro :ID es inválido.'], 400);
                }
            }
        }
        public function deleteProducto($params = []) {
            // Verifica si el parámetro ":ID" está presente y es un número válido
            if (isset($params[":ID"]) && is_numeric($params[":ID"])) {
                $producto_id = $params[":ID"];
                $producto = $this->model->getProducto($producto_id);
        
                if ($producto) {
                    $this->model->eliminarProducto($producto_id);
                    $this->view->response("Producto con ID $producto_id eliminado con éxito", 200);
                } else {
                    $this->view->response("Producto con ID $producto_id no encontrado", 404);
                }
            } else {
                // Error 400: Solicitud incorrecta debido a parámetro :ID inválido o ausente
                $this->view->response(['msg' => 'Solicitud incorrecta. El parámetro :ID es inválido o está ausente.'], 400);
            }
        }
        
        function create($params = []) {
            $body = $this->getData();
        
            // Verifica si los campos necesarios están presentes 
            if (isset($body->nombre_producto, $body->modelo, $body->precio, $body->categoria)) {
                $nombre = $body->nombre_producto;
                $modelo = $body->modelo;
                $precio = $body->precio;
                $categoria = $body->categoria;
        
                // Obtiene la categoría por nombre
                $categoriaAinsertar = $this->modelCategoria->getCategoryByNombre($categoria);
        
                if ($categoriaAinsertar) {
                    $id_categoria = $categoriaAinsertar->id_categoria;
        
                    // Inserta el producto
                    $this->model->insertProducto($nombre, $modelo, $precio, $id_categoria);
                    $this->view->response('El producto fue insertado', 201);
                } else {
                    // La categoría no existe
                    $this->view->response('La categoría no existe', 404);
                }
            } else {
                // Error 400: Solicitud incorrecta debido a datos de solicitud incompletos o inválidos
                $this->view->response(['msg' => 'Solicitud incorrecta. Los datos del producto son incompletos o inválidos.'], 400);
            }
        }
        
        public function update($params = []) {
            $producto_id = $params[':ID'];
            $producto = $this->model->getProducto($producto_id);
        
            if ($producto) {
                $body = $this->getData();
        
                // Verifica si los campos necesarios están presentes
                if (isset($body->nombre_producto, $body->modelo, $body->precio)) {
                    $nombre_producto = $body->nombre_producto;
                    $modelo = $body->modelo;
                    $precio = $body->precio;
        
                    // Actualiza el producto
                    $this->model->updateProductos($producto_id, $nombre_producto, $modelo, $precio);
        
                    $this->view->response("Producto actualizado correctamente", 200);
                } else {
                    // Error 400: Solicitud incorrecta debido a datos de solicitud incompletos
                    $this->view->response(['msg' => 'Solicitud incorrecta. Los datos del producto son incompletos.'], 400);
                }
            } else {
                // Producto no encontrado
                $this->view->response("Producto no encontrado", 404);
            }
        }
        
        public function getProductoOrdenado($params = []) {
            // Verifica si los parámetros de ordenamiento son válidos
            $ordenamientosValidos = ['asc', 'desc'];
            $sortValidos = ['id_producto', 'nombre_producto', 'modelo', 'precio'];
        
            if (isset($params[':ordenamiento'], $params[':sort']) &&
                in_array($params[':ordenamiento'], $ordenamientosValidos) &&
                in_array($params[':sort'], $sortValidos)) {
                
                $formaOrdenam = $params[':ordenamiento'];
                $valor = $params[':sort'];
        
                $productosOrdenados = $this->model->getProductosOrder($valor, $formaOrdenam);
        
                $this->view->response($productosOrdenados, 200);
            } else {
                // Error 400: Solicitud incorrecta debido a parámetros inválidos o faltantes
                $this->view->response("Solicitud incorrecta. Parámetros de ordenamiento inválidos o faltantes.", 400);
            }
        }
        public function getProductoOferta($params = []) {
            $categoriasPermitidas = ['Heladeras', 'Lavarropas', 'Audio_y_Video', 'Aire_y_Climatizacion'];
        
            if (isset($params[':Categoria']) && in_array($params[':Categoria'], $categoriasPermitidas)) {
                $categoriaNombre = $params[':Categoria'];
        
                // Llamada a la función en el modelo para obtener productos en oferta filtrados por categoría
                $productosEnOferta = $this->model->getProductosOferta($categoriaNombre);
        
                if ($productosEnOferta) {
                    $this->view->response($productosEnOferta, 200);
                } else {
                    $this->view->response("No hay productos en oferta para la categoría '$categoriaNombre'", 404);
                }
            } else {
                // Error 400: Solicitud incorrecta debido a categoría inválida o faltante
                $this->view->response("Solicitud incorrecta. La categoría proporcionada no es válida.", 400);
            }
        }        
    }