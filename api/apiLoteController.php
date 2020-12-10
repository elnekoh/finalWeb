<?php
class ApiLoteController{
    private $view;
    private $centroDeSaludModel;

    public function __construct(){
        $this->view= new APIView();
        $this->centroDeSalud = new CentroDeSaludModel();
    }

    public function getALLCentrosDeSalud(){
        return $this->view->response($this->centroDeSalud->getALLCentrosDeSalud(), 200);
    }

    public function getLotesDisponibles($recursos = null){
        //teniendo en cuenta que la tabla tiene un campo int con la cantidad de lotes dispobibles:
        //el campo se llamaria "lotesDisponibles"
        if(isset($recursos[":ID"]){
            $id = $recursos[":ID"];
            $lotesDisponibles=$this->centroDeSalud->getLotesDisponibles($id);
            if(isset($lotesDisponibles->lotesDisponibles)){
                return $this->view->response($lotesDisponibles,200);
            }else{
                return $this->view->response("no se encontro ese centro de salud",404);
            }
        }else{
            return $this->view->response("ocurrio un error",500);
        }

    }
}