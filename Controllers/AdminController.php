<?php
require_once 'Controller.php';
require_once 'Models/ProductosModel.php';
require_once 'Models/CategoriasModel.php';
require_once 'Utils/validaciones.php';
require_once 'Utils/session.php';

class AdminController extends Controller {
    private $model; 
    private $catModel;
    private $userModel;

    function __construct(){

        parent::__construct(); // Llama al constructor padre para iniciar session_start()

        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . PATH . '/Login/');
            exit();
        }

        $this->model = new ProductosModel();
        $this->catModel = new CategoriasModel();
        $this->userModel = new LoginModel();
    }

    public function editar($id){
        $codigo = $id[0];
        $usuario = $this->userModel->get($codigo);
        
        $viewBag['usuarios'] = $usuario;
        $this->render("editar-admin.php", $viewBag);
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

    public function adminCategorias(){
        $viewBag = [];
        $viewBag['categorias'] = $this->catModel->get();
        $this->render("ver-categorias.php", $viewBag);
    }

    public function adminUsuarios(){
        $viewBag = [];
        $viewBag['usuarios'] = $this->userModel->get();
        $this->render("usuarios-admin.php", $viewBag);
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
    

    public function editarUsuario($id){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = [
                'id_Usuario' => $id[0],
                'nombre_completo' => $_POST['nombre_completo'],
                'nombre_usuario' => $_POST['nombre_usuario'],
                'telefono' => $_POST['telefono'],
                'correo' => $_POST['correo'],
                'direccion' => $_POST['direccion'], // si quieres cambiar la contraseña, si no quieres cambiarla, omítela
                'id_tipo_usuario' => $_POST['id_tipo_usuario'],
            ];
            error_log("Usuario a editar: " . print_r($usuario, true));
            $resultado = $this->userModel->update($usuario);
            error_log("Resultado de la edición: " . $resultado);
            header('Location: '.PATH.'/Admin/adminUsuarios');
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

    public function editarCategoria($id){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoria = [
                ':id_categoria' => $id[0],
                ':nombre_categoria' => $_POST['nombre_categoria']
            ];
            $this->catModel->update($categoria);
            header('Location: '.PATH.'/Admin/adminCategorias'); 
            exit;
        }
    }

    public function agregarCategoria(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoria = [
                'nombre_categoria' => $_POST['nombre_categoria']
            ];
            $this->catModel->insert($categoria);
            header('Location: '.PATH.'/Admin/adminCategorias'); 
            exit;
        }
    }

    public function eliminarCategoria($id){
        error_log("ID de categoría a eliminar: " . print_r($id, true));
        $resultado = $this->catModel->delete($id[0]);
        error_log("Resultado de la eliminación de categoría: " . $resultado);
        header('Location: '.PATH.'/Admin/adminCategorias'); 
        exit;
    }

}
