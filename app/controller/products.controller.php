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
            if(isset($_GET['search'])){
                $this->search($_GET['search']);
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
        if(empty($product)){
            $this->view->response("El producto con el id=($id) no exite.",404);
            exit();
        }
        $this->view->response($product);
    }

    private function search($search){
        if($search==null){
            $this->view->response("No se enviaron correctamente los datos",400);
            exit();
        }
        $results=$this->model->getResults($search);
        if(empty($results)){
            $this->view->response("No se encontraron resultados para($search)",404);
            exit();
        }
        $this->view->response($results);
    }

    function errorEndpoint($params=null){
        $this->view->response('Endpoint incorrecto',404);
    }
}