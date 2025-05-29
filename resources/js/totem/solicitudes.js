import { limpiarParametros } from './formularios.js';
import { mostrarError } from './alertas.js';

/**
 * Servicio de API centralizado para manejar solicitudes HTTP
 */
// const apiService = {
//     post(url, data) {
//         return axios.post(url, data).catch((error) => {
//             handleApiError(error);
//             throw error; // Re-lanza el error para que los controladores puedan manejarlo si es necesario
//         });
//     },
// };

const apiService = {
    async post(url, data, retries = 3, delay = 500) {
        for (let i = 0; i < retries; i++) {
            try {
                return await axios.post(url, data);
            } catch (error) {
                if (error.response && error.response.status === 500) {
                    console.warn(`Error 500 - Reintentando (${i + 1}/${retries})...`);
                    if (i < retries - 1) {
                        await new Promise(res => setTimeout(res, delay * Math.pow(2, i)));
                        continue;
                    } else {
                        mostrarError(
                            'Error del servidor',
                            'El servidor no responde. Se recargará la página.'
                        );
                        setTimeout(() => location.reload(), delay * 3);
                    }
                } else {
                    handleApiError(error);
                    throw error; // Re-lanza el error si no es 500
                }
            }
        }
    },
};

/**
 * Manejo centralizado de errores de la API
 */
function handleApiError(error) {
    console.error('Error details:', error);

    if (error.response) {
        console.error('Response data:', error.response.data);
        console.error('Response status:', error.response.status);
        console.error('Response headers:', error.response.headers);

        const status = error.response.status;

        if (status === 422) {
            const validationErrors = error.response.data.errors;
            mostrarError(
                'Error de validación',
                Object.values(validationErrors).flat().join('<br>') // Combina todos los mensajes
            );
            limpiarParametros();
        } else if (status === 500) {
            mostrarError(
                'Error del servidor',
                'Hubo un problema en el servidor. Por favor, inténtalo más tarde.'
            );
        } else if (status === 404) {
            mostrarError('Recurso no encontrado', 'No se pudo encontrar el recurso solicitado.');
        } else {
            mostrarError('Error desconocido', error.response.statusText || 'Ocurrió un error.');
        }
    } else if (error.request) {
        console.error('Request details:', error.request);
        mostrarError('Error de conexión', 'No se pudo establecer la conexión con el servidor.');
    } else {
        console.error('Error config:', error.config);
        mostrarError('Error inesperado', error.message);
    }
}

/**
 * Enviar formulario para buscar cliente
 * @param {FormData} formData - Datos del formulario
 */
async function enviarFormulario(formData) {
    try {
        const response = await apiService.post(urlSearchDNI, formData);
        const clienteData = response.data.cliente;
        localStorage.setItem('cliente', JSON.stringify(clienteData));
        window.location.href = '/totem/opciones';
    } catch (error) {
        // El manejo del error ya se realiza en `handleApiError`
    }
}

/**
 * Generar ticket para un cliente y sector
 * @param {Number} cliId - ID del cliente
 * @param {Number} secId - ID del sector
 */
async function generarTicket(cliId, secId) {
    try {
        await apiService.post(urlTotemStore, { cli_id: cliId, sec_id: secId });
        Swal.close();
        localStorage.clear();
        window.location.href = urlTotemIndex;
    } catch (error) {
        // El manejo del error ya se realiza en `handleApiError`
    }
}

export { enviarFormulario, generarTicket };

