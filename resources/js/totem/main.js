import './configuraciones.js';
import { configurarBotones } from './utilidades.js';
import { configurarFormulario, configurarCampo } from './formularios.js';

function inicializar() {
    const sectoresButtons = document.querySelectorAll('.turno-button');

    configurarFormulario();
    configurarCampo();
    configurarBotones(sectoresButtons);
}

document.addEventListener('DOMContentLoaded', inicializar);
