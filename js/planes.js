document.getElementById("crearPlanBtn").addEventListener("click", function () {
    document.getElementById("modalCrearPlan").style.display = "block";
});

document.getElementById("verPlanesBtn").addEventListener("click", function () {
    document.getElementById("modalVerPlanes").style.display = "block";
    cargarPlanes();
});

document.querySelectorAll(".cerrar").forEach(function (element) {
    element.addEventListener("click", function () {
        document.querySelectorAll(".modal").forEach(function (modal) {
            modal.style.display = "none";
        });
    });
});

window.addEventListener("click", function (event) {
    if (event.target.classList.contains("modal")) {
        event.target.style.display = "none";
    }
});

document.getElementById("formCrearPlan").addEventListener("submit", function (event) {
    event.preventDefault();
    const nombrePlan = document.getElementById("nombrePlan").value;
    const descripcionPlan = document.getElementById("descripcionPlan").value;

    const plan = {
        nombre: nombrePlan,
        descripcion: descripcionPlan,
    };
    let planes = JSON.parse(localStorage.getItem("planes")) || [];
    planes.push(plan);
    localStorage.setItem("planes", JSON.stringify(planes));

    document.getElementById("formCrearPlan").reset();
    document.getElementById("modalCrearPlan").style.display = "none";
    alert("¡Plan creado exitosamente!");
});

function cargarPlanes() {
    const listaPlanes = document.getElementById("listaPlanes");
    listaPlanes.innerHTML = ""; 

    const planes = JSON.parse(localStorage.getItem("planes")) || [];
    planes.forEach(function (plan, index) {
        const planItem = document.createElement("div");
        planItem.classList.add("plan-item");
        planItem.innerHTML = `
            <h3>${plan.nombre}</h3>
            <p>${plan.descripcion}</p>
        `;
        listaPlanes.appendChild(planItem);
    });
}