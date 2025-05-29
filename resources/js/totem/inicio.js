function inicializar() {
    var clienteData = JSON.parse(localStorage.getItem('cliente'));
    var clienteTitularElement = document.getElementById('clienteTitular');
    clienteTitularElement.innerText = clienteData.titular;
}

document.addEventListener('DOMContentLoaded', inicializar);
