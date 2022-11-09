<?php
require_once './app/model/products.model.php';
require_once './app/view/api.view.php';

class productsController{
    private $model;
    private $view;

    function __construct(){
        $this->model=new productsModel();
        $this->view=new apiView();
    }

    function getAll($params=null){
        if(count($_GET)==1){
            $products=$this->model->getAll();
            $this->view->response($products);
        }elseif(count($_GET)==2){
            if(empty($_GET['filter'])){
                $this->view->response("Parametro GET incorrecto",400);
            }else{
                $category=$_GET['filter'];
                $products=$this->model->filterByCategory($category);
                $this->view->response($products);
            }
        }elseif(count($_GET)==3){
            if(isset($_GET['column']) && isset($_GET['order'])){
                if(empty($_GET["column"]) || empty($_GET["order"])){
                    $this->view->response("Al parametro GET le falta la variable order o column", 400);
                }else{
                    $column=$this->checkParamColumn($_GET['column']);
                    $order=$this->checkParamOrder($_GET['order']);
                    $products=$this->model->orderByColumn($column,$order);
                    $this->view->response($products);
                }
            }elseif(isset($_GET['page']) && isset($_GET['size'])){
                $page=$_GET['page'];
                $size=$_GET['size'];
                $this->checkPaginate($page,$size);
                $products=$this->model->getAllPaginate($page,$size);
                $this->view->response($products);
            }else{
                $this->view->response("Parametro GET desconocido", 400);
            }
        }else{
            $this->view->response("Parametro GET desconocido", 400);
        }
            
    }
    
    function getById($params=null){
        $id=$params[':ID'];
        $product=$this->model->getById($id);
        $this->view->response($product);
    }

    private function checkParamColumn($column){
        if($column!='name' && $column!='price' && $column!='discount'){
            $this->view->response("El parametro column=($column) no existe",404);
            exit(); 
        }
        return $column;
    }
    private function checkParamOrder($order){
        if($order=='a'){
            $order='ASC';
            return $order;
        }elseif($order=='d'){
            $order='DESC';
            return $order;
        }else{
            $error=$order;
            $this->view->response("El parametro de orden=($error) es incorrecto",400);
            exit();
        }
    }
    private function checkPaginate($page,$size){
        if(!is_integer($page) && $page<=0)
            $this->view->response("El parametro (page) debe ser numero positivo", 400);

        if(!is_integer($size) && $size<=0)
            $this->view->response("El parametro (size) debe ser numero positivo", 400);

        $quantity=$this->model->quantityProducts();
        if($page>=$quantity){
            $this->view->response("La pagina ($page) no existe", 404);
            exit();
        }
    }

    function errorEndpoint($params=null){
        $this->view->response('Endpoint incorrecto',404);
    }
}