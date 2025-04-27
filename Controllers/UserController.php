<?php
require_once 'Controller.php';
require_once 'Models/ProductosModel.php';
require_once 'Utils/session.php';
require_once 'Models/VentasModel.php';
class UserController extends Controller {
    private $model;

    function __construct(){
        $this->model = new ProductosModel();
    }

    public function index(){
        $viewBag['productos'] = $this->model->get();
        $this->render("users.php", $viewBag);
    }

    public function comprar($id){
        $viewBag['productos'] = $this->model->get($id[0]);
        $this->render("comprar.php", $viewBag);
    }

    public function pago($id){

    }

    public function agregarAlCarrito($id){
        $producto = $this->model->get($id[0]);
    
        if(!$producto) {
            // Manejo de error
            header("Location: /Desafio_2_lis/User/index");
            exit;
        }
    
        $productoId = $producto['id_producto'];
    
        if(!isset($_SESSION['carrito'])){
            $_SESSION['carrito'] = [];
        }
    
        if(isset($_SESSION['carrito'][$productoId])){
            $_SESSION['carrito'][$productoId]['cantidad'] += 1;
        } else {
            $_SESSION['carrito'][$productoId] = [
                'id_producto' => $producto['id_producto'],
                'nombre_producto' => $producto['nombre_producto'],
                'precio' => $producto['precio'],
                'cantidad' => 1
            ];
        }
    
        header("Location: /Desafio_2_lis/User/verCarrito");
    }
    
    public function Carrito(){
        $viewBag['carrito'] = $_SESSION['carrito'] ?? [];
        $this->render("carrito.php", $viewBag);
    }
}
