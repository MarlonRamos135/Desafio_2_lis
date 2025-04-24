<?php

/* require_once 'Controller.php';
require_once 'Models/ProductosModel.php';
require_once 'Models/CategoriasModel.php';

class ProductosController extends Controller{
    private $model;
    private $catModel;

    function __construct(){
        $this->model = new ProductosModel();
        $this->catModel = new CategoriasModel();
    }

    public function users(){
        $viewBag = [];
        $viewBag['productos'] = $this->model->get();
        $this->render("users.php", $viewBag);
    }

    public function ProductosAdmin(){
        $viewBag = [];
        $viewBag['categorias'] = $this->catModel->get();
        $viewBag['productos'] = $this->model->get();
        $this->render("productos-admin.php", $viewBag);
    }

    public function UsuariosAdmin(){
        $viewBag = [];
        $viewBag['usuarios'] = $this->model->get();
        $this->render("usuarios-admin.php", $viewBag);
    }

    public function admin(){
        $this->render("admin.php");
    }

    public function comprar($id){
        $viewBag = [];
        $viewBag['producto'] = $this->model->get($id[0]);
        $this->render("comprar.php", $viewBag);
    }

    public function editar($id){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $producto = [
                ':id' => $id[0],
                ':nombre' => $_POST['nombre'],
                ':descripcion' => $_POST['desc'],
                ':imagen' => $_POST['img'],
                ':categoria' => $_POST['categoria'],
                ':precio' => $_POST['precio'],
                ':cantidad' => $_POST['cantidad']
            ];
    
            $this->model->update($producto);
            header('Location: '.PATH.'/Productos/ProductosAdmin'); // Redirige al admin
            exit;
        }
    } 
    
    
}