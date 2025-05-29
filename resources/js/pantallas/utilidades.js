import { playAudio } from './audio.js';

function videoPlaying() {
    const video = document.querySelector('.carousel-item.active video');
    if (video && video.paused) {
        video.play();
    }
}

function mostrarVentanaTicket(data) {
    const tableHtml = `
        <table class="table">
            <tr style="vertical-align:center; color:${data.ticket.turnos.puestos.mostradores.tipo === 'CAJA' ? 'white' : '#732d84'}">
                <th>TURNO</th>
                <th>${data.ticket.turnos.puestos.mostradores.tipo}</th>
            </tr>
            <tr style="vertical-align:center; color:${data.ticket.turnos.puestos.mostradores.tipo === 'CAJA' ? 'white' : '#732d84'}">
                <td class="text-center"><h1 class="fw-bold">${data.ticket.letra}${data.ticket.numero}</h1></td>
                <td class="text-center"><h1 class="fw-bold">${data.ticket.turnos.puestos.mostradores.numero}</h1></td>
            </tr>
        </table>`;

    Swal.fire({
        showConfirmButton: false,
        width: 1000,
        timer: 3500,
        background: data.ticket.turnos.puestos.mostradores.tipo === 'CAJA' ? '#732d84' : 'white',
        html: tableHtml,
        onBeforeOpen: () => {
            setTimeout(videoPlaying(), 100);
        },
    });

    playAudio();
}

function addNewRow(data) {
    const turnosTable = document.getElementById('tablaTurnos');
    turnosTable.innerHTML = ''; // Eliminar todo el contenido de la tabla

    data.tickets.forEach(function (ticket) {
        const newRow = turnosTable.insertRow();
        const cell1 = newRow.insertCell(0);
        const cell2 = newRow.insertCell(1);
        // Aplicar estilos a la fila
        newRow.style.backgroundColor = ticket.turnos.puestos.mostradores.tipo === 'CAJA' ? '#732d84' : 'white';
        newRow.style.color = ticket.turnos.puestos.mostradores.tipo === 'CAJA' ? 'white' : '#732d84';
        // Insertar datos en la Tabla
        cell1.innerHTML = `<div class="text-left">${ticket.letra}${ticket.numero}</div>`;
        cell2.innerHTML = `<div class="text-right">${ticket.turnos.puestos.mostradores.tipo} ${ticket.turnos.puestos.mostradores.numero}</div>`;
    });
}

export { mostrarVentanaTicket, addNewRow }
