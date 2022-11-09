<?php
require_once './libs/Router.php';
require_once './app/controller/products.controller.php';
require_once './app/controller/categories.controller.php';

$router = new Router();

$router->addRoute('products', 'GET', 'productsController', 'getAll');
$router->addRoute('products/:ID','GET','productsController','getById');
$router->addRoute('products', 'POST', 'productsController', 'search');

$router->addRoute('categories','GET','categoriesController','getAll');

$router->setDefaultRoute('productsController','errorEndpoint');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);