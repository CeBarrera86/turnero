import { mostrarAviso, mostrarEspera } from './alertas.js';
import { generarTicket } from './solicitudes.js';

// Definiciones de constantes
const CIERRE_HORAS = 14;
const CIERRE_MINUTOS = 0;
const ABP_HORAS = 12;
const ABP_MINUTOS = 45;
const ATP_HORAS = 13;
const ATP_MINUTOS = 0;
const INACTIVIDAD = 180000; // 5 minutos en milisegundos
let inactividadTimer;

function esHora(horas, minutos) {
    const currentTime = new Date();
    const xHoras = currentTime.getHours();
    const xMinutos = currentTime.getMinutes();
    return xHoras > horas || (xHoras === horas && xMinutos >= minutos);
}

function verificarCierre() {
    if (esHora(CIERRE_HORAS, CIERRE_MINUTOS)) {
        mostrarAviso();
    }
}

function reiniciarTemporizador() {
    clearTimeout(inactividadTimer);
    inactividadTimer = setTimeout(() => {
        if (esHora(CIERRE_HORAS, CIERRE_MINUTOS)) {
            mostrarAviso();
        }
    }, INACTIVIDAD);
}

function desactivarBotones(secId, button) {
    if (secId === 2 && esHora(ABP_HORAS, ABP_MINUTOS)) {
        if (parseInt(button.id) === 1) {
            button.classList.add('disabled-button');
            button.disabled = true;
        }
    }
    if (secId === 4 && esHora(ATP_HORAS, ATP_MINUTOS)) {
        button.classList.add('disabled-button');
        button.disabled = true;
    }
}

// Función para manejar eventos de botones
function configurarBotones(sectoresButtons) {
    sectoresButtons.forEach((button) => {
        const secId = parseInt(button.dataset.secId);

        desactivarBotones(secId, button);

        button.addEventListener('click', () => {
            const cliId = parseInt(button.dataset.cliId);
            if (secId === 4) {
                localStorage.removeItem('sectores');
                window.location.href = urlTareasIndex;
            } else {
                mostrarEspera();
                setTimeout(() => {
                    generarTicket(cliId, secId);
                }, 100);
            }
        });
    });
}

export { esHora, verificarCierre, reiniciarTemporizador, configurarBotones }
