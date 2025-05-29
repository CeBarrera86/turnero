import { buscarTicket, atenderTicket, eliminarTicket } from './botones.js';
import { ticketsDisponibles, ticketSolicitado, ticketDerivado } from './solicitudes.js';
import { bloquearBotones } from './utilidades.js';

document.addEventListener('DOMContentLoaded', async () => {
    try {
        if (localStorage.getItem("ticketId")) {
            bloquearBotones();
            await ticketSolicitado();
        }
        await Promise.all([ticketsDisponibles(), ticketDerivado()]);

        $("#btn-buscar").on("click", buscarTicket);
        $("#input-alfa").on("keyup", function (event) {
            if (event.keyCode === 13) {
                buscarTicket();
            }
        });
    } catch (error) {
        console.error("Error al cargar datos iniciales:", error);
    }

    Echo.private('ticket')
        .listen('nuevoTicket', (data) => {
            if (data.ticket.sector == userData.sectorId) {
                const tabla = $("#disponibles tbody");
                const noDataMessage = tabla.find("tr:contains('No se encontraron tickets.')");
                noDataMessage.remove();
                const row = document.createElement("tr");
                row.setAttribute('id', data.ticket.id);
                row.innerHTML = `
                    <td>
                        <h4>${data.ticket.letra + data.ticket.numero}</h4>
                        <p>${data.cliente.titular}</p>
                    </td>
                    <td class="td-actions text-right">
                        <button id="btn-atender-${data.ticket.id}" class="btn btn-fab btn-round btn-outline-success" title="Atender">
                        <i class="material-icons">touch_app</i>
                        </button>
                        <button id="btn-eliminar-${data.ticket.id}" class="btn btn-fab btn-round btn-outline-danger" title="Eliminar">
                        <i class="material-icons">delete_outline</i>
                        </button>
                    </td>`;
                if (tabla.children().length < 3) {
                    tabla.append(row);
                }
                row.querySelector(`#btn-atender-${data.ticket.id}`).addEventListener("click", () => atenderTicket(data.ticket.id));
                row.querySelector(`#btn-eliminar-${data.ticket.id}`).addEventListener("click", () => eliminarTicket(data.ticket.id));
            }
        })
        .listen('eliminarTicket', async (data) => {
            if (data.ticket.estado === 5) {
                const row = document.getElementById(data.ticket.id);
                if (row) {
                    row.parentNode.removeChild(row);
                    await Promise.all([ticketsDisponibles(), ticketDerivado()]);
                }
            }
        });

    Echo.private('turno')
        .listen('nuevoTurno', async () => {
            try {
                await Promise.all([ticketsDisponibles(), ticketDerivado()]);
            } catch (error) {
                console.error("Ocurrió un error al obtener los datos de la API:", error);
            }
        });
});
