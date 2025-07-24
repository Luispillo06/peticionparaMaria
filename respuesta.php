<?php
// Configuración de la base de datos
$host = "localhost";
$usuario = "root";
$contrasena = ""; // Si usas XAMPP, normalmente la contraseña está vacía
$basedatos = "cita_db";

// Crear conexión
$conn = new mysqli($host, $usuario, $contrasena, $basedatos);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se recibió el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["respuesta"])) {
    $respuesta = $_POST["respuesta"];

    // Insertar en la base de datos
    $stmt = $conn->prepare("INSERT INTO respuestas (respuesta) VALUES (?)");
    $stmt->bind_param("s", $respuesta);
    $stmt->execute();
    $stmt->close();

    // Mostrar respuesta personalizada
    if ($respuesta === "si") {
        echo "<h2 style='text-align:center; color:green; font-family:sans-serif;'>💖 ¡Sabía que dirías que sí! Prepara la cita 😍</h2>";
    } else {
        echo "<h2 style='text-align:center; color:red; font-family:sans-serif;'>😢 Qué pena... quizás otro día 🍂</h2>";
    }

} else {
    echo "<h2 style='text-align:center; color:orange;'>No se ha recibido ninguna respuesta válida.</h2>";
}

// Cerrar conexión
$conn->close();
?>