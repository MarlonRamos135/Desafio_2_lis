<?php

require_once 'Controller.php';
require_once 'Models/CateogriasModel.php';
require_once 'Models/ProductosModel.php';

class EmpleadoController extends Controller {
    private $model; 
    private $catModel;

    function __construct(){
        $this->model = new ProductosModel();
        $this->catModel = new CategoriasModel();
    }

    public function index(){
        $viewBag['productos'] = $this->model->get();
        $viewBag['categorias'] = $this->catModel->get();
        $this->render("empleado.php", $viewBag);
    }
}