function mostrarAviso() {
    Swal.fire({
        type: 'info',
        title: '¡No se entregan más tickets!',
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
        html: `
            <h2>Horarios de atención:</h2>
            <h3 style="font-size: 30px; font-weight:600;">Cajas</h3>
            <h3>Lunes a Viernes de 6 a 14 hs.</h3>
            <h3 style="font-size: 30px; font-weight:600;">Atención al Público</h3>
            <h3>Lunes a Viernes de 6 a 13 hs.</h3>
            <p style="font-weight:600;">¡Muchas gracias!</p>
        `,
        backdrop: `
            rgba(0,0,123,0.4)
            left top
            no-repeat
        `
    });
}

function mostrarExito() {
    Swal.fire({
        title: 'Éxito',
        text: 'El ticket se ha generado correctamente.',
        type: 'success',
        showConfirmButton: false,
        timer: 2000
    });
}

function mostrarError(titulo, mensaje) {
    Swal.fire({
        title: titulo,
        text: mensaje,
        type: 'error'
    });
}

function mostrarEspera() {
    Swal.fire({
        title: 'Procesando...',
        html: 'Por favor espere...',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        onOpen: () => {
            Swal.showLoading();
        }
    });
}

export { mostrarAviso, mostrarExito, mostrarError, mostrarEspera }
