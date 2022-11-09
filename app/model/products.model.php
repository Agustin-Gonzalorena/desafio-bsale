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

    
    function getResults($search){
        $query = $this->db->prepare("SELECT product.*, category.name as category FROM product JOIN category ON product.category = category.id WHERE `product`.`name` LIKE ? OR `category`.`name` LIKE ? ");
        $query->execute(['%' . $search . '%','%' . $search . '%']);
        $products=$query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }
}