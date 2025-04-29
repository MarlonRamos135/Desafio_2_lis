<?php
require_once 'Controller.php';
require_once 'Models/ProductosModel.php';
require_once 'Utils/session.php';
require_once 'Models/VentasModel.php';
require_once 'Models/ProductosModel.php';
class UserController extends Controller {
    private $model;
    private $userModel;
    private $ventasModel;
    private $productosModel;

    function __construct(){

        parent::__construct(); // Llama al constructor padre para iniciar session_start()

        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . PATH . '/Login/');
            exit();
        }

        $this->model = new ProductosModel();
        $this->userModel = new LoginModel();
        $this->ventasModel = new VentasModel();
        $this->productosModel = new ProductosModel();
    }

    public function index(){
        $viewBag = [];
        $viewBag['productos'] = $this->model->get();
        $viewBag['usuarios'] = $this->userModel->get();
        $this->render("users.php", $viewBag);
    }

    public function comprar($id){
        $viewBag['producto'] = $this->model->get($id[0]);
        $this->render("comprar.php", $viewBag);
    }

    public function realizarCompra($id) {
        $usuario = $_SESSION['usuario']['id'];
        $id_producto = $id[0];
        $cantidad = (int)$_POST['cantidad'];
        $producto = $this->productosModel->get($id_producto);
    
        if (!$producto) {
            header("Location: /Desafio_2_lis/User/");
            exit;
        }
    
        $precio_unitario = (float)$producto['precio'];
        $subtotal = $precio_unitario * $cantidad;
    
        $venta = [
            ':id_usuario' => $usuario,
            ':total' => $subtotal
        ];
    
        $venta_resultado = $this->ventasModel->insertVenta($venta);
    
        if ($venta_resultado) {
            $id_venta = $this->ventasModel->lastInsertId();
            $detalle_venta = [
                ':id_venta' => $id_venta,
                ':id_producto' => $id_producto,
                ':cantidad' => $cantidad,
                ':precio_unitario' => $precio_unitario,
                ':subtotal' => $subtotal
            ];
    
            error_log("Detalle de venta: " . print_r($detalle_venta, true));
            error_log("Venta: " . print_r($venta, true));
    
            $detalle_venta_resultado = $this->ventasModel->insertDetalleVenta($detalle_venta);
    
            error_log("Resultado de la venta: " . print_r($venta_resultado, true));
            error_log("Resultado del detalle de venta: " . print_r($detalle_venta_resultado, true));
        }
    
        header("Location: /Desafio_2_lis/User/Compras");
    }
    
    public function ticket($id) {
        if (empty($id[0])) {
            die("ID de venta no especificado.");
        }
    
        $_GET['id'] = $id[0]; // para que ticket.php pueda seguir usando $_GET['id']
        include __DIR__ . '/../Ticket/invoice.php';

    }
    
    
    
    public function Compras(){
        $idUsuario = $_SESSION['usuario']['id'];
        $compras = $this->ventasModel->getDetalleComprasPorUsuario($idUsuario);
    
        $viewBag = ['compras' => $compras];
        $this->render("carrito.php", $viewBag);
    }
    
}
