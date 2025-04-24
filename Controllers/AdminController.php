<?php
require_once 'Controller.php';
require_once 'Models/ProductosModel.php';
require_once 'Models/CategoriasModel.php';
require_once 'Utils/validaciones.php';

class AdminController extends Controller {
    private $model; 
    private $catModel;

    function __construct(){
        $this->model = new ProductosModel();
        $this->catModel = new CategoriasModel();
    }

    

    public function index(){
        $viewBag['productos'] = $this->model->get();
        $viewBag['categorias'] = $this->catModel->get();
        $this->render("admin.php", $viewBag);
    }

    public function adminProductos(){
        $viewBag = [];
        $viewBag['categorias'] = $this->catModel->get();
        $viewBag['productos'] = $this->model->get();
        $this->render("productos-admin.php", $viewBag);
    }

    public function agregarProductos(){
        $viewBag = [];
        $viewBag['categorias'] = $this->catModel->get();
        $this->render("agregar-admin.php", $viewBag);
    }

    public function crear() {
        error_log("POST: " . print_r($_POST, true));

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errores = [];
            $viewBag = [];
    
            // Validaciones
            if (empty($_POST['nombre']) || empty($_POST['desc']) || empty($_POST['img']) || empty($_POST['categoria']) || empty($_POST['precio']) || empty($_POST['cantidad'])) {
                $errores[] = "Debes llenar todos los campos.";
            }
    
            if (!isText($_POST['nombre'])) {
                $errores[] = "El nombre no es válido.";
            }
    
            if (!isPositive($_POST['precio'])) {
                $errores[] = "El precio no es válido.";
            }
    
            if (!isPositive($_POST['cantidad'])) {
                $errores[] = "La cantidad no es válida.";
            }
    
            // Armar el producto solo si no hay errores
            $producto = [
                'codigo_producto' => strtoupper(substr($_POST['nombre'], 0, 4)) . mt_rand(1000, 9999),
                'nombre_producto' => $_POST['nombre'],
                'descripcion' => $_POST['desc'],
                'imagen' => $_POST['img'],
                'id_categoria' => $_POST['categoria'],
                'precio' => $_POST['precio'],
                'existencias' => $_POST['cantidad']
            ];
    
            if (!empty($errores)) {
                $viewBag['errores'] = $errores;
                $viewBag['producto'] = $producto;
                $viewBag['categorias'] = $this->catModel->get();
                $this->render("agregar-admin.php", $viewBag);
                return;
            }
    
            // Si todo está bien, insertar
            try {
                error_log("Producto que se va a insertar: " . print_r($producto, true));
                $resultado = $this->model->insert($producto);
                error_log("Resultado del insert: " . $resultado);
                header('Location: ' . PATH . '/Admin/adminProductos');
                exit;
            } catch (Exception $e) {
                $errores[] = "Error al agregar el producto: " . $e->getMessage();
                $viewBag['errores'] = $errores;
                $viewBag['producto'] = $producto;
                $viewBag['categorias'] = $this->catModel->get();
                $this->render("agregar-admin.php", $viewBag);
            }
        }
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
            header('Location: '.PATH.'/Admin/adminProductos'); 
            exit;
        }
    }

    public function eliminar($id){
        error_log("ID a eliminar: " . print_r($id, true));
        $resultado = $this->model->delete($id[0]);
        error_log("Resultado de la eliminación: " . $resultado);
        header('Location: '.PATH.'/Admin/adminProductos'); 
        exit;
    }


}
