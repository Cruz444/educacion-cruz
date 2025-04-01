<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root"; // Cambia según tu configuración
$password = ""; // Cambia según tu configuración
$database = "basededatos_pagina";

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

// Cerrar conexión
$stmt->close();
$conn->close();
?>