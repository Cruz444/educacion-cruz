<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root"; // Cambia según tu configuración
$password = ""; // Cambia según tu configuración
$database = "dbconexion";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Error en la conexión a la base de datos."]));
}

// Obtener datos del formulario
$nombre = $_POST["nombre"] ?? '';
$email = $_POST["email"] ?? '';
$pregunta = $_POST["pregunta"] ?? '';

// Validar que los campos no estén vacíos
if (empty($nombre) || empty($email) || empty($pregunta)) {
    echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios."]);
    exit;
}

// Preparar la consulta SQL
$stmt = $conn->prepare("INSERT INTO preguntas (nombre, correo, pregunta) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nombre, $email, $pregunta);

// Ejecutar y responder
if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Tu pregunta ha sido enviada correctamente."]);
} else {
    echo json_encode(["success" => false, "message" => "Error al enviar la pregunta."]);
}
$result = $conn->query("SELECT nombre, pregunta FROM preguntas ORDER BY id DESC LIMIT 5");

if ($result->num_rows > 0) {
    echo "<div class='preguntas-guardadas'><h2>Últimas Preguntas</h2>";
    while($row = $result->fetch_assoc()) {
        echo "<div class='pregunta'>";
        echo "<h4>" . htmlspecialchars($row["nombre"]) . " preguntó:</h4>";
        echo "<p>" . htmlspecialchars($row["pregunta"]) . "</p>";
        echo "</div>";
    }
    echo "</div>";
}
// Cerrar conexión
$stmt->close();
$conn->close();
?>
