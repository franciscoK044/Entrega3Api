<?php
require_once './app/controller/productosController.php';
require_once './app/controller/categoriasController.php';
require_once './app/controller/authController.php';
require_once './api/api.controller.php';
require_once 'libs/router.php';


define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');
$router = new Router();

$router->addRoute('productos', 'GET','apiController','get');


$router->addRoute('productos', 'POST','apiController','create');
$router->addRoute('productos/:ID', 'GET', 'apiController', 'get');
$router->addRoute('productos/:ID', 'DELETE','apiController','deleteProducto');
$router->addRoute('productos/:ID', 'PUT','apiController', 'update');
$router->addRoute('productosOrdenados/:sort/:ordenamiento', 'GET','apiController', 'getProductoOrdenado');




$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
