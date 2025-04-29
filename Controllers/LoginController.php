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

    public function logout() {
        session_start();
        session_destroy();
        header("Location: " . PATH . "/Login/");
        exit();
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
        $correo = $_POST['correo'];
        $contrasena = $_POST['contrasena'];
    
        $resultado = $this->model->validateLogin($correo);
    
        if (!empty($resultado) && password_verify($contrasena, $resultado['contra'])) {
            // ✅ Guardamos en sesión los datos del usuario
            $_SESSION['usuario'] = [
                'id' => $resultado['id_Usuario'],  // corregido con "U" mayúscula
                'correo' => $resultado['correo'],
                'nombre' => $resultado['nombre_usuario'],
                'tipo' => $resultado['id_tipo_usuario']
            ];            
    
            $tipoUsuario = $resultado['id_tipo_usuario'];
    
            if ($tipoUsuario == 1) {
                header('Location: ' . PATH . '/Admin/');
            } elseif ($tipoUsuario == 2) {
                header('Location: ' . PATH . '/User/');
            } else {
                header('Location: ' . PATH . '/Login/');
            }
            exit();
        } else {
            $viewBag['errores'] = "Correo o contraseña incorrectos.";
            $this->render('index.php', $viewBag);
        }
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
            $usuario['id_tipo_usuario'] = 2; // Puedes cambiarlo si quieres manejar distintos tipos.
            $usuario['contra'] = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);
    
            if (empty($usuario['nombre_completo']) || empty($usuario['nombre_usuario']) || empty($usuario['telefono']) || empty($usuario['correo']) || empty($usuario['direccion']) || empty($_POST['contrasena'])) {
                $errores[] = "Debes llenar todos los campos.";
            }
            if (!isPhone($usuario['telefono'])) {
                $errores[] = "El número de teléfono no es válido.";
            }
            if (!isMail($usuario['correo'])) {
                $errores[] = "El correo electrónico no es válido.";
            }
            if (!isText($usuario['nombre_completo'])) {
                $errores[] = "El nombre completo no es válido.";
            }
            if ($this->model->get($usuario['nombre_usuario'])) {
                $errores[] = "El nombre de usuario ya existe.";
            }
            if ($this->model->get($usuario['correo'])) {
                $errores[] = "El correo electrónico ya existe.";
            }
            if ($this->model->get($usuario['telefono'])) {
                $errores[] = "El número de teléfono ya existe.";
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
    
                $this->render('verifyUser.php', $viewBag);
                exit();
            } catch (Exception $e) {
                error_log("Error al insertar el usuario: " . $e->getMessage());
                echo "Error: " . $e->getMessage();
            }
        }
    }
    
    
}