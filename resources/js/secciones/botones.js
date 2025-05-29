import { mostrarModalSeleccionSector, ticketEncontrado, noTicket, confirmarEliminarTicket, confirmarFinalizarTurno, confirmarPosponerTurno } from './alertas.js';
import { axiosRequest } from './configuraciones.js';
import { ticketsDisponibles, ticketSolicitado, ticketDerivado } from './solicitudes.js';
import { bloquearBotones, desbloquearBotones, parseTicket } from './utilidades.js';

async function buscarTicket() {
    try {
        bloquearBotones();
        const alfa = $("#input-alfa").val();
        $("#input-alfa").val("");

        const [letra, numero] = parseTicket(alfa);

        const response = await axiosRequest(urlSearchTicket, 'get', { letra, numero });
        if (response.data.status) {
            const ticket = response.data.ticket;
            const result = await ticketEncontrado(ticket);
            if (result.value) {
                await atenderTicket(ticket.id);
            } else {
                desbloquearBotones();
            }
        } else {
            noTicket();
            desbloquearBotones();
        }
    } catch (error) {
        console.error('Error en buscarTicket():', error);
    }
}

async function atenderTicket(id) {
    try {
        const response = await axiosRequest(urlAtenderTicket, 'post', { id });
        if (response.data.success) {
            await Promise.all([ticketsDisponibles(), ticketSolicitado(id), ticketDerivado()]);
        }
    } catch (error) {
        console.error("Error en atenderTicket():", error);
    }
}

async function eliminarTicket(id) {
    const result = await confirmarEliminarTicket();
    if (result.value) {
        try {
            const url = urlUpdateTicket.replace('id', id);
            await axiosRequest(url, 'put', { llamar: 0 });
        } catch (error) {
            console.error("Error en eliminarTicket():", error);
        }
    }
}

async function culminarTurno(id) {
    const result = await confirmarFinalizarTurno();
    if (result.value) {
        try {
            const url = urlUpdateTurno.replace('id', id);
            await axiosRequest(url, 'put', { estado: 2 });
            localStorage.removeItem("ticketId");
            desbloquearBotones();
            await Promise.all([ticketsDisponibles(), ticketSolicitado(id), ticketDerivado()]);
        } catch (error) {
            console.error("Error en culminarTurno():", error);
        }
    }
}

async function derivarTurno(id) {
    const url = urlUpdateTurno.replace('id', id);
    const result = await mostrarModalSeleccionSector();
    if (!result) {
        // console.log('No se seleccionó un sector o se canceló la operación');
        return;
    }
    try {
        const { sectorId, userId } = result.value;
        const response = await axiosRequest(url, 'put', { estado: 3, sector: sectorId, userDe: userData.userId, userPara: userId });
        if (response.data.success) {
            localStorage.removeItem("ticketId");
            desbloquearBotones();
            await Promise.all([ticketsDisponibles(), ticketSolicitado(), ticketDerivado()]);
        }
    } catch (error) {
        console.error("Error en derivarTurno():", error);
    }
}

async function posponerTurno(id) {
    const result = await confirmarPosponerTurno();
    if (result.value) {
        try {
            const url = urlUpdateTurno.replace('id', id);
            await axiosRequest(url, 'put', { estado: 4 });
            localStorage.removeItem("ticketId");
            desbloquearBotones();
            await Promise.all([ticketSolicitado(), ticketsDisponibles(), ticketDerivado()]);
        } catch (error) {
            console.error("Error en posponerTurno():", error);
        }
    }
}

async function llamarTicket(id) {
    const btnLlamar = $(`#btn-llamar-${id}`);
    try {
        btnLlamar.prop('disabled', true);
        bloquearBotones();
        const url = urlUpdateTicket.replace('id', id);
        await axiosRequest(url, 'put', { llamar: 1 });
        setTimeout(() => {
            btnLlamar.prop('disabled', false);
        }, 4000); // Esperar 4 segundos

    } catch (error) {
        console.error("Error en llamarTicket():", error);
        btnLlamar.prop('disabled', false);
    }
}

export {
    buscarTicket,
    atenderTicket,
    eliminarTicket,
    culminarTurno,
    derivarTurno,
    posponerTurno,
    llamarTicket
};
