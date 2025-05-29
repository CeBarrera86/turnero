import { mostrarVentanaTicket, addNewRow } from './utilidades.js';
import { pasarPublicidad } from './solicitudes.js';

Echo.channel('ventana-ticket')
    .listen('ventanaTicket', (data) => {
        mostrarVentanaTicket(data);
    });

Echo.channel('listar-tickets')
    .listen('listarTickets', (data) => {
        localStorage.setItem('ticketData', JSON.stringify(data));
        addNewRow(data);
    });

Echo.channel('actualizar-publicidad')
    .listen('actualizarPublicidad', () => {
        pasarPublicidad();
    });
