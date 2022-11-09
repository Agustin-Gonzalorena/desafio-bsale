<?php
require_once './app/model/categories.model.php';
require_once './app/view/api.view.php';

class categoriesController{
    private $model;
    private $view;

    function __construct(){
        $this->model=new categoriesModel();
        $this->view=new apiView();
    }

    function getAll($params=null){
        $categories=$this->model->getAll();
        $this->view->response($categories);
    }
}