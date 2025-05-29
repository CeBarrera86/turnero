import './eventos.js';
import { addNewRow } from './utilidades.js';
import { pasarPublicidad } from './solicitudes.js';

document.addEventListener('DOMContentLoaded', () => {
    const storedData = localStorage.getItem('ticketData');
    if (storedData) {
        const data = JSON.parse(storedData);
        addNewRow(data);
    }
    pasarPublicidad();
});
