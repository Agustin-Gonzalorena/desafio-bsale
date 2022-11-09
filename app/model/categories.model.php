<?php

class categoriesModel{
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
        $query = $this->db->prepare("SELECT * FROM category");
        $query->execute();
        $categories = $query->fetchAll(PDO::FETCH_OBJ);
        return $categories;
    }
}