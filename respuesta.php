<?php
// Configuración de base de datos
$host = "localhost";
$usuario = "root";
$contrasena = ""; // Usa tu contraseña si la has puesto en MySQL
$basedatos = "cita_db";

// Conexión a la base de datos
$conn = new mysqli($host, $usuario, $contrasena, $basedatos);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verifica si se envió una respuesta
if (isset($_POST['respuesta'])) {
    $respuesta = $_POST['respuesta'];

    // Prepara y ejecuta la consulta
    $stmt = $conn->prepare("INSERT INTO respuestas (respuesta) VALUES (?)");
    $stmt->bind_param("s", $respuesta);

    if ($stmt->execute()) {
        echo "<h2 style='color:green; text-align:center;'>¡Gracias por tu respuesta! 💌</h2>";
    } else {
        echo "Error al guardar la respuesta.";
    }

    $stmt->close();
} else {
    echo "No se recibió ninguna respuesta.";
}

$conn->close();
?>
