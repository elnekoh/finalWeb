<?php
require_once("./loteController.php");

class CiudadModel {
    private $db;

    public function __construct(){
        $this->db = new PDO("");
    }

    public function getCiudadID($id){
        $query = $this->db->prepare("SELECT * FROM Ciudad WHERE id=?");
        $this->query->execute(array($id));
        return FETCH;
    }

    public function getTemperatura($id){
        $query = $this->db->prepare("SELECT temperatura_conservacion FROM Ciudad WHERE id=?");
        $this->query->execute(array($id));
        return FETCH;
    }
}