import { atenderTicket, eliminarTicket, culminarTurno, derivarTurno, posponerTurno, llamarTicket } from './botones.js';

// Función para manejar los eventos de los botones
function agregarEventosFila(ticket) {
    $(`#btn-atender-${ticket.id}`).on("click", () => atenderTicket(ticket.id));
    $(`#btn-eliminar-${ticket.id}`).on("click", () => eliminarTicket(ticket.id));
    $(`#btn-finalizar-${ticket.id}`).on("click", () => culminarTurno(ticket.id));
    $(`#btn-derivar-${ticket.id}`).on("click", () => derivarTurno(ticket.id));
    $(`#btn-posponer-${ticket.id}`).on("click", () => posponerTurno(ticket.id));
    $(`#btn-llamar-${ticket.id}`).on("click", () => llamarTicket(ticket.id));
}

function limpiarTabla(tbody) {
    tbody.empty();
}

function bloquearBotones() {
    $("#disponibles-body, #derivados-body").prop("disabled", true).css({ 'opacity': '0.5', 'pointer-events': 'none' });
}

function desbloquearBotones() {
    $("#disponibles-body, #derivados-body").prop("disabled", false).css({ 'opacity': '1', 'pointer-events': 'auto' });
}

function agregarFila(tbody, ticket, esDerivado = false) {
    let rowHtml = `
        <td>
            <h4>${ticket.letra + ticket.numero}</h4>
            <p>${ticket.clientes.titular}</p>
        `;
    if (esDerivado) {
        rowHtml += `<p>De: ${ticket.userDe}</p>`;
        if (ticket.userPara) {
            rowHtml += `<p>Para: ${ticket.userPara}<p>`;
        }
    }
    rowHtml += `</td>
        <td class="td-actions text-right">
            <button id="btn-atender-${ticket.id}" class="btn btn-fab btn-round btn-outline-success" title="Atender">
                <i class="material-icons">touch_app</i>
            </button>
            <button id="btn-eliminar-${ticket.id}" class="btn btn-fab btn-round btn-outline-danger" title="Eliminar">
                <i class="material-icons">delete_outline</i>
            </button>
        </td>`;

    const row = $("<tr>")
        .attr("id", ticket.id)
        .html(rowHtml);
    tbody.append(row);
    agregarEventosFila(ticket);
}

function RespuestaTickets(tbody, data, esDerivado = false) {
    limpiarTabla(tbody);
    if (data && data.status) {
        data.tickets.forEach(ticket => agregarFila(tbody, ticket, esDerivado));
    } else {
        const noDataMessage = $("<tr>").html(`<td colspan="2" class="text-center">No se encontraron tickets.</td>`);
        tbody.append(noDataMessage);
    }
}

function RespuestaTicketSolicitado(data) {
    const solicitadoBody = $("#solicitado-body");
    const solicitadoFooter = $("#solicitado-footer");
    if (data && data.status) {
        const ticket = data.ticket;
        const cliente = data.ticket.clientes;
        solicitadoBody.html(
            `<div class="col-md-12">
                <h3>${ticket.letra + ticket.numero}</h3>
            </div>
            <div class="col-md-12">
                <h5>${cliente.titular}</h5>
            </div>`
        );
        solicitadoFooter.html(
            `<button id="btn-finalizar-${ticket.id}" class="btn btn-fab btn-round btn-outline-danger mx-3" title="Finalizar">
                <i class="material-icons">close</i>
            </button>
            <button id="btn-derivar-${ticket.id}" class="btn btn-fab btn-round btn-outline-warning mx-3" title="Derivar">
                <i class="material-icons">swap_horiz</i>
            </button>
            <button id="btn-posponer-${ticket.id}" class="btn btn-fab btn-round btn-outline-info mx-3" title="Posponer">
                <i class="material-icons">hourglass_bottom</i>
            </button>
            <button id="btn-llamar-${ticket.id}" class="btn btn-fab btn-round btn-outline-primary mx-3" title="Llamar">
                <i class="material-icons">notifications</i>
            </button>`
        );
        agregarEventosFila(ticket);
    } else {
        solicitadoBody.empty();
        solicitadoFooter.empty();
    }
}

function parseTicket(alfa) {
    const indice = alfa.search(/\d/);
    const letra = alfa.substring(0, indice);
    const numero = alfa.substring(indice);
    return [letra, numero];
}

export {
    limpiarTabla,
    bloquearBotones,
    desbloquearBotones,
    agregarFila,
    RespuestaTickets,
    RespuestaTicketSolicitado,
    parseTicket
};
