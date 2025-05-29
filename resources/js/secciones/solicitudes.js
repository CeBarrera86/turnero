import { axiosRequest } from './configuraciones.js';
import { bloquearBotones, RespuestaTickets, RespuestaTicketSolicitado } from './utilidades.js';

function manejarError(error, callback) {
    console.error("Error en solicitud:", error.response ? error.response.data : error.message);
    if (callback) {
        callback(null);
    }
}

function manejarRespuesta(response, callback, additionalParams = {}) {
    if (response.data && response.data.status) {
        callback(response.data, additionalParams);
    } else {
        callback(null, additionalParams);
    }
}

function ticketSolicitado() {
    return axiosRequest(urlVerificarSolicitado, 'get', { puestoId: userData.puestoId })
        .then(response => manejarRespuesta(response, data => {
            if (data && data.status) {
                localStorage.setItem("ticketId", data.ticket.id);
                bloquearBotones();
            }
            RespuestaTicketSolicitado(data);
        }))
        .catch(error => manejarError(error, RespuestaTicketSolicitado));
}

function ticketsDisponibles() {
    const tbody = $("#disponibles tbody");
    return axiosRequest(urlVerificarDisponibles, 'get', { sectorId: userData.sectorId })
        .then(response => manejarRespuesta(response, data => RespuestaTickets(tbody, data)))
        .catch(error => manejarError(error, () => RespuestaTickets(tbody, null)));
}

function ticketDerivado() {
    const tbody = $("#derivados tbody");
    return axiosRequest(urlVerificarDerivados, 'get', { sectorId: userData.sectorId })
        .then(response => manejarRespuesta(response, data => RespuestaTickets(tbody, data, true)))
        .catch(error => manejarError(error, () => RespuestaTickets(tbody, null, true)));
}

function obtenerUsuariosPorSector(sectorId) {
    return axiosRequest(urlUsuariosSector, 'get', { sectorId: sectorId })
        .then(response => { return response.data.usuarios || []; })
        .catch(error => { manejarError(error); return []; });
}

export {
    ticketSolicitado,
    ticketsDisponibles,
    ticketDerivado,
    obtenerUsuariosPorSector
};
