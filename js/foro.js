function abrirVentana(tema) {
    document.getElementById("ventanaModal").style.display = "block";
    document.getElementById("chatTitulo").textContent = tema;
    document.getElementById("chatMensajes").innerHTML = ""; // Limpiar mensajes al cambiar de sala
}

function cerrarVentana() {
    document.getElementById("ventanaModal").style.display = "none";
}

function agregarMensaje() {
    let mensaje = document.getElementById("mensajeInput").value;
    if (mensaje.trim() !== "") {
        let nuevoMensaje = document.createElement("div");
        nuevoMensaje.classList.add("mensaje");
        nuevoMensaje.textContent = mensaje;
        document.getElementById("chatMensajes").appendChild(nuevoMensaje);
        document.getElementById("mensajeInput").value = "";
    }
}