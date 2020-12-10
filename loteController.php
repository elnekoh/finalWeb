<?php
//require_once router
//require_once VIEW
require_once("./loteModel.php");
require_once("./ciudadModel.php");
require_once("./laboratorioModel.php");

class LoteController {
    private $loteModel;
    private $laboratorioModel;
    private $ciudadModel;
    //private $view
    public function __construct(){
        $this->loteModel = new LoteModel();
        $this->ciudadModel = new CiudadModel();
        $this->laboratorioModel = new LaboratorioModel();
        //instancio view;
    }

    public function insertLote(){
        //compruebo si esta logueado
        $this->checkLoggedAdmin();
        //teniendo en cuenta que los datos para crear un nuevo lote mellegan por $_POST
        try {
            if (isset($_POST) && !empty($_POST["año_vencimiento"])) {
                $nro_lote = $_POST["nro_lote"];
                $año_vencimiento = $_POST["año_vencimiento"];
                $id_ciudad = $_POST["id_ciudad"];
                $id_laboratorio = $_POST["id_laboratorio"];
                if($this->comprobarCiudadYLab){
                    if($this->comprobarTemperatura($id_ciudad,$id_laboratorio)){
                        $this->loteModel = insertLote($nro_lote,$año_vencimiento,$id_ciudad,$id_laboratorio);
                    }else{
                        $this->view->renderError("La ciudad destino no cuenta con la temperatura de conservacion deseada");
                    }
                }else{
                    $this->view->renderError("ciudad y/o laboratorio inexistentes");
                }
            }
        } catch (\Throwable $th) {
            //header(home); (lo mando de nuevo a home si falta alguno de esos datos)
        }
    }

    public function comprobarCiudadYLab($id_ciudad,$id_laboratorio){
        $ciudad = $this->ciudadModel->getCiudadID($id_ciudad);
        $laboratorio= $this->laboratorioModel->getLaboratorioID($id_laboratorio);
        if(!empty($ciudad) && !empty($laboratorio)){
            return true;
        }else{
            return false;
        }
    }

    public function comprobarTemperatura($id_ciudad,$id_laboratorio){
        $temperaturaCiudad=$this->ciudadModel->getTemperatura($id);
        $temperaturaLaboratorio=$this->ciudadLaboratorio->getTemperatura($id);
        if($temperaturaCiudad >= $temperaturaLaboratorio){
            return true;
        }else{
            return false;
        }
    }

    public function getStock($id){
        return $this->laboratorioModel->getStrock($id);
    }

    public function checkLoggedAdmin(){
        session_start();
        if(!empty($_SESSION["ROL"]) && isset($_SESSION["ROL"])){
            if($_SESSION["ROL"] != "admin"){
                //si no es admin... 
                //lo mandamos a el home
                //header(home);
                //y cortamos la ejecucion
                die();
            }
        }else{
            //si no esta logueado, tambien lo mandamos al home
            //header(home);
            die();
        }
    }

    public function mostrarTablaCostos(){
        $lotes=$this->loteModel->getLotesYPrecio();
        $this->view->renderTablaCostos($lotes);
    }
}

