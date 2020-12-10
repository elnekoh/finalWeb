<?php
require_once("./loteController.php");

class LaboratorioModel {
    private $db;

    public function __construct(){
        $this->db = new PDO("");
    }

    public function getLaboratorioID($id){
        $query = $this->db->prepare("SELECT * FROM Laboratorio WHERE id=?");
        $query->execute(array($id));
        return FETCH;
    }

    public function getStock($id){
        $query = $this->db->prepare("SELECT stock_lotes FROM Laboratorio WHERE id=?");
        $query->execute(array($id));
        return FETCH;
    }

    public function setStock($int,$id){
        $query = $this->db->prepare("UPDATE stock_lotes = ? FROM Laboratorio WHERE id=?");
        $query->execute(array($int,$id));
    }

    public function getTemperatura($id){
        $query = $this->db->prepare("SELECT temperatura_conservacion FROM Laboratorio WHERE id=?");
        $query->execute(array($id));
        return FETCH;
    }
}