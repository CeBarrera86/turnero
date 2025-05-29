import { enviarFormulario } from './solicitudes.js';
import { mostrarEspera } from './alertas.js';

const campo = $('#campo');

function limpiarParametros() {
    campo.val('');
    localStorage.clear();
}

function actualizarCampo(number) {
    const currentValue = campo.val();
    if (number === 'BORRAR') {
        campo.val(currentValue.slice(0, -1));
    } else if (currentValue.length < 10) {
        campo.val(currentValue + number);
    }
    campo.focus();
}

// Función para manejar eventos de teclado
function configurarCampo() {
    $('.table_teclado td').click(function () {
        const number = $(this).text();
        actualizarCampo(number);
    });
    campo.on('keydown', (event) => {
        if (event.key === 'Enter') {
            event.preventDefault();
            $('#searchForm').submit();
        }
    });
}

// Función para manejar el envío del formulario
function configurarFormulario() {
    $('#searchForm').submit((event) => {
        event.preventDefault();
        const formData = {
            '_token': $('input[name=_token]').val(),
            'dni': campo.val()
        };
        mostrarEspera();

        setTimeout(() => {
            enviarFormulario(formData);
        }, 100);
    });
}

export { campo, configurarCampo, limpiarParametros, configurarFormulario }
