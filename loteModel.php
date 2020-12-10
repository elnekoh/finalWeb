<?php
require_once("./loteController.php");

class LoteModel {
    private $db;

    public function __construct(){
        $this->db = new PDO("");
    }
    public function insertLote($nro_lote,$año_vencimiento,$id_ciudad,$id_laboratorio){
        $query = $this->db->prepare("INSERT INTO Lote(nro_lote, año_vencimiento, id_ciudad, id_laboratorio) VALUES(?,?,?,?)");
        $query->execute(array($nro_lote,$año_vencimiento,$id_ciudad,$id_laboratorio));
    }
// *lotes y traer precio por id lab
    public function getLotesYPrecio(){
        $query = $this->db->prepare("SELECT nro_lote.l, costo_lote.lab, nombre.lab FROM Lote l INNER JOIN Laboratorio lab ON id_laboratorio.l=id.lab ");
        $query->execute();
        return FETCHALL
    }
}
