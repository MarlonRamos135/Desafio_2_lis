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

    public function sendEmail($correo, $nombre, $token){
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'textilexport24@gmail.com';                     //SMTP username
            $mail->Password   = 'textilcontra123';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('textilexport24@gmail.com', 'TextilExports');
            $mail->addAddress($correo, $nombre);

            $linkVerificacion = $linkVerificacion = 'http://' . $_SERVER['HTTP_HOST'] . PATH . '/Usuarios/accountCreated/' . $token;

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Confirmación de correo';
            $mail->Body    = 'Accede a: <a href="'.$linkVerificacion.'"><b>AQUI</b></a> para verificar tu cuenta.';
            $mail->Body .= '<br><br>Si no puedes acceder al enlace, copia y pega el siguiente enlace en tu navegador: <br><b>'.$linkVerificacion.'</b>';

            $mail->send();
        } 
        catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function accountCreated($param) {
        if (!empty($param[0])) {
            $token = $param[0];
            $usuario = $this->model->verificarToken($token);
    
            if (!empty($usuario)) {
                $idUsuario = $usuario[0]['id_Usuario'];
                $this->model->Verificado($idUsuario);
                $this->render('welcome.php');
                
            } else {
                $viewBag['error'] = 'Token inválido o cuenta ya verificada.';
                return $this->render('verifyUser.php', $viewBag);
            }
        }
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
                exit();
            }
            if (!isPhone($usuario['telefono'])) {
                array_push($errores, "El número de teléfono no es válido.");
                $this->render("register.php", $viewBag);
                exit();
            }
            if (!isMail($usuario['correo'])) {
                array_push($errores, "El correo electrónico no es válido.");
                $this->render("register.php", $viewBag);
                exit();
            }
            if (!isText($usuario['nombre_completo'])) {
                array_push($errores, "El nombre no es válido.");
                $this->render("register.php", $viewBag);
                exit();
            }
            if ($this->model->get($usuario['nombre_usuario'])) {
                array_push($errores, "El nombre de usuario ya existe.");
                $this->render("register.php", $viewBag);
                exit();
            }
            if ($this->model->get($usuario['correo'])) {
                array_push($errores, "El correo electrónico ya existe.");
                $this->render("register.php", $viewBag);
                exit();
            }
            if ($this->model->get($usuario['telefono'])) {
                array_push($errores, "El número de teléfono ya existe.");
                $this->render("register.php", $viewBag);
                exit();
            }
    
            if (count($errores) > 0) {
                $viewBag['errores'] = $errores;
                $viewBag['usuario'] = $usuario;
                $this->render("register.php", $viewBag);
                exit();
            }

            try {
                $this->model->insert($usuario);
    
                //$this->sendEmail($usuario['correo'], $usuario['nombre_completo'], $usuario['codigo_verificacion']);
    
                $this->render('verifyUser.php', $viewBag);
                exit();
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
    
}