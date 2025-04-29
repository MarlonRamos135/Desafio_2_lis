<?php
$host = 'localhost';
$dbname = 'textilexport_db';  // ← Reemplaza con el nombre real de tu base de datos
$username = 'root';             // ← Cambia si tienes un usuario diferente
$password = '';                 // ← Cambia si tu usuario tiene contraseña

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexión exitosa"; // puedes descomentar para probar
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
