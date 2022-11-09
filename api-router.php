<?php
require_once './libs/Router.php';
require_once './app/controller/products.controller.php';

$router = new Router();

$router->addRoute('products', 'GET', 'productsController', 'getAll');
$router->addRoute('products/:ID','GET','productsController','getById');

$router->setDefaultRoute('productsController','errorEndpoint');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);