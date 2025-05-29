import { obtenerUsuariosPorSector } from './solicitudes.js';

function swalConfigBase(titulo, tipo, texto = '', confirmText = '', cancelText = '', footer = '') {
    return Swal.fire({
        title: titulo,
        text: texto,
        type: tipo,
        footer: footer,
        showCancelButton: cancelText ? true : false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: confirmText,
        cancelButtonText: cancelText
    });
}

async function mostrarModalSeleccionSector() {
    const result = await Swal.fire({
        title: '¿A dónde se deriva?',
        html: `
            <select id="sectorSelect" class="swal2-input">
                <option value="" disabled selected>Selecciona Sector</option>
                <option value="1">Cajas</option>
                <option value="2">Usuarios</option>
                <option value="3">Reclamos</option>
            </select>
            <select id="usuarioSelect" class="swal2-input" style="display: none; margin-top: 15px;">
                <option value="" disabled selected>Selecciona Usuario</option>
            </select>
        `,
        confirmButtonColor: '#4caf50',
        confirmButtonText: 'Derivar',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        preConfirm: () => {
            const sectorId = document.getElementById('sectorSelect').value;
            const userId = document.getElementById('usuarioSelect').value;
            if (!sectorId) {
                Swal.showValidationMessage('Seleccionar Sector');
                return null;
            }
            return { sectorId, userId: userId || null };
        }
    });
    return result;
}

document.addEventListener('change', async (event) => {
    if (event.target && event.target.id === 'sectorSelect') {
        const sectorId = parseInt(event.target.value, 10);
        const usuarioSelect = document.getElementById('usuarioSelect');
        const userOptions = await obtenerUsuariosPorSector(sectorId);
        // Limpiar las opciones anteriores
        usuarioSelect.innerHTML = '<option value="" disabled selected>Selecciona Usuario (opcional)</option>';
        // Agregar nuevas opciones
        userOptions.forEach(user => {
            const option = document.createElement('option');
            option.value = user.id;
            option.textContent = user.username;
            usuarioSelect.appendChild(option);
        });
        // Mostrar el selector de usuario si hay opciones disponibles
        usuarioSelect.style.display = userOptions.length > 0 ? 'block' : 'none';
    }
});

function nombreSector(sectorId) {
    const sectores = {
        1: 'Cajas',
        2: 'Usuarios',
        3: 'Reclamos'
    };
    return sectores[sectorId] || '';
}

async function ticketEncontrado(ticket) {
    const estados = {
        4: { type: 'success', title: 'Disponible' },
        3: { type: 'warning', footer: 'Ticket derivado a ' + nombreSector(ticket.sector) },
        default: { type: 'warning', footer: 'Ticket ' + (ticket.estado === 2 ? 'Culminado' : 'Eliminado') }
    };
    const estadoTicket = estados[ticket.estado] || estados.default;
    return swalConfigBase(`${ticket.letra} ${ticket.numero}`, estadoTicket.type, ticket.clientes.titular, 'Atender', 'Cancelar', estadoTicket.footer);
}

function noTicket() {
    swalConfigBase('Oops...', 'error', '¡Ticket no encontrado!', 'Aceptar');
}

function confirmarEliminarTicket() {
    return swalConfigBase('¿Es correcto eliminar el ticket?', 'warning', 'No podrás revertir esto!', 'Sí, eliminar', 'Cancelar');
}

function confirmarFinalizarTurno() {
    return swalConfigBase('¿Finalizar la atención?', 'warning', '', 'Aceptar', 'Cancelar');
}

function confirmarPosponerTurno() {
    return swalConfigBase('¿Posponer la atención?', 'warning', '', 'Aceptar', 'Cancelar');
}

export {
    mostrarModalSeleccionSector,
    ticketEncontrado,
    noTicket,
    confirmarEliminarTicket,
    confirmarFinalizarTurno,
    confirmarPosponerTurno
};
