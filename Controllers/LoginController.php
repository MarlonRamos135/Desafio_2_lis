<?php

require_once 'Controller.php';
require_once 'Models/LoginModel.php';
require_once 'Utils/validaciones.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class LoginController extends Controller{
    private $model;

    function __construct(){
        $this->model = new LoginModel();
    }

    public function index(){
        $viewBag = [];
        $viewBag['usuarios'] = $this->model->get();
        $this->render("index.php", $viewBag);
    }

    public function registerUser(){
        $this->render("register.php");
    }

    public function verifyUser(){
        $this->render('verifyUser.php');
    }

    public function createUser(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $viewBag = [];
            $errores = [];
    
            $usuario['nombre_completo'] = $_POST['nombre_completo'];
            $usuario['nombre_usuario'] = $_POST['nombre_usuario'];
            $usuario['telefono'] = $_POST['telefono'];
            $usuario['correo'] = $_POST['correo'];
            $usuario['direccion'] = $_POST['direccion'];
            $usuario['id_tipo_usuario'] = 1;
            $usuario['codigo_verificacion'] = bin2hex(random_bytes(32));
            $usuario['verificado'] = 0;
            $usuario['contra'] = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);
    
            if (empty($usuario['nombre_completo']) || empty($usuario['nombre_usuario']) || empty($usuario['telefono']) || empty($usuario['correo']) || empty($usuario['direccion']) || empty($_POST['contrasena'])) {
                array_push($errores, "Todos los campos son obligatorios.");
                $this->render("register.php", $viewBag);
                error_log("Error: " . print_r($errores, true));
                exit();
            }
            if (!isPhone($usuario['telefono'])) {
                array_push($errores, "El número de teléfono no es válido.");
                $this->render("register.php", $viewBag);
                error_log("Error: " . print_r($errores, true));
                exit();
            }
            if (!isMail($usuario['correo'])) {
                array_push($errores, "El correo electrónico no es válido.");
                $this->render("register.php", $viewBag);
                error_log("Error: " . print_r($errores, true));
                exit();
            }
            if (!isText($usuario['nombre_completo'])) {
                array_push($errores, "El nombre no es válido.");
                $this->render("register.php", $viewBag);
                error_log("Error: " . print_r($errores, true));
                exit();
            }
            if ($this->model->get($usuario['nombre_usuario'])) {
                array_push($errores, "El nombre de usuario ya existe.");
                $this->render("register.php", $viewBag);
                error_log("Error: " . print_r($errores, true));
                exit();
            }
            if ($this->model->get($usuario['correo'])) {
                array_push($errores, "El correo electrónico ya existe.");
                $this->render("register.php", $viewBag);
                error_log("Error: " . print_r($errores, true));
                exit();
            }
            if ($this->model->get($usuario['telefono'])) {
                array_push($errores, "El número de teléfono ya existe.");
                $this->render("register.php", $viewBag);
                error_log("Error: " . print_r($errores, true));
                exit();
            }
    
            if (count($errores) > 0) {
                $viewBag['errores'] = $errores;
                $viewBag['usuario'] = $usuario;
                $this->render("register.php", $viewBag);
                error_log("Error: " . print_r($errores, true));
                exit();
            }

            try {
                error_log("Usuario: " . print_r($usuario, true));
                $resultado = $this->model->insert($usuario);
                error_log("Resultado: " . print_r($resultado, true));
    
                //$this->sendEmail($usuario['correo'], $usuario['nombre_completo'], $usuario['codigo_verificacion']);
    
                $this->render('verifyUser.php', $viewBag);
                exit();
            } catch (Exception $e) {
                error_log("Error al insertar el usuario: " . $e->getMessage());
                echo "Error: " . $e->getMessage();
            }
        }
    }
    
}