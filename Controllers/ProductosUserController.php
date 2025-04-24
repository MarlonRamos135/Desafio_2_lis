<?php
require_once 'Controller.php';
require_once 'Models/ProductosModel.php';

class ProductosUserController extends Controller {
    private $model;

    function __construct(){
        $this->model = new ProductosModel();
    }

    public function index(){
        $viewBag['productos'] = $this->model->get();
        $this->render("users.php", $viewBag);
    }

    public function comprar($id){
        $viewBag['producto'] = $this->model->get($id[0]);
        $this->render("comprar.php", $viewBag);
    }
}
