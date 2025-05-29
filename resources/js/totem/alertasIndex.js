import { mostrarExito } from './alertas.js';
import { verificarCierre, reiniciarTemporizador } from './utilidades.js';

document.addEventListener('DOMContentLoaded', function () {
    verificarCierre();

    if (typeof message !== 'undefined' && message === 'ok') {
        mostrarExito();
    }

    reiniciarTemporizador();

    document.addEventListener('mousemove', reiniciarTemporizador);
    document.addEventListener('keydown', reiniciarTemporizador);
    document.addEventListener('click', reiniciarTemporizador);
});
