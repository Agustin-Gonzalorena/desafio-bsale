<?php

class productsModel{
    private $db;

    function __construct(){
        $this->db=$this->connect();
    }

    private function connect() {
        $db = new PDO('mysql:host=mdb-test.c6vunyturrl6.us-west-1.rds.amazonaws.com;'
        .'dbname=bsale_test;charset=utf8', 'bsale_test', 'bsale_test');
        return $db;
    }
    function getAll() {
        $query = $this->db->prepare("SELECT * FROM product");
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    function getById($id){
        $query = $this->db->prepare("SELECT * FROM product WHERE id=?");
        $query->execute([$id]);
        $product = $query->fetch(PDO::FETCH_OBJ);
        return $product;
    }
    
    function filterByCategory($category){
        $query = $this->db->prepare("SELECT * FROM product WHERE category=?");
        $query->execute([$category]);
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    function orderByColumn($column,$order){
        $query = $this->db->prepare("SELECT * FROM `product` ORDER BY `product`.`$column` $order");
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    function getAllPaginate($start,$cantPages){
        $query = $this->db->prepare("SELECT * FROM product LIMIT $start,$cantPages");
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    function quantityProducts(){
        $query = $this->db->prepare("SELECT * FROM product");
        $query->execute();
        $quantity=$query->rowCount();
        return $quantity;
    }
    function getResults($search){
        $query = $this->db->prepare("SELECT * FROM product WHERE `name` LIKE ? ");
        $query->execute(['%' . $search . '%']);
        $products=$query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }
}