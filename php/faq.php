<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $pregunta = htmlspecialchars($_POST['Tu pregunta']);

    $destinatario = "crzveg473@gmail.com"; // Cambia esto por tu correo
    $asunto = "Nueva Pregunta de $nombre";
    $mensaje = "Nombre: $nombre\n";
    $mensaje .= "Correo: $email\n\n";
    $mensaje .= "Pregunta:\n$pregunta";

    $headers = "From: $email";

    if (mail($destinatario, $asunto, $mensaje, $headers)) {
        echo "<p>¡Tu pregunta ha sido enviada! Te responderemos pronto.</p>";
    } else {
        echo "<p>Hubo un error al enviar tu pregunta. Inténtalo de nuevo.</p>";
    }
}
?>
