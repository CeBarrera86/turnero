Echo.private('ticket')
    .listen('nuevoTicket', (data) => {
        const row = document.createElement("tr");
        row.setAttribute('id', data.ticket.id);
        row.innerHTML = `
            <td>
                <h4><strong>${data.ticket.alfa}</strong></h4>
                <p>${data.cliente.titular}</p>
            </td>
            <td class="td-actions text-right">
                <button id="btn-Llamar" class="btn btn-fab btn-round btn-outline-primary" title="Llamar"
                onclick="llamarTicket(${data.ticket.id})">
                <i class="material-icons">notifications</i>
                </button>
                <button id="btn-eliminar" class="btn btn-fab btn-round btn-outline-danger" title="Eliminar"
                onclick="eliminarTicket(${data.ticket.id})">
                <i class="material-icons">delete_outline</i>
                </button>
            </td>`;
        tabla.appendChild(row);
    })
    .listen('eliminarTicket', (data) => {
        if (data.ticket.eliminado) {
            Swal.fire({
                text: "El ticket se ha eliminado correctamente!",
                type: 'info',
                showConfirmButton: false,
                timer: 1500
            });
            const row = document.getElementById(data.ticket.id);
            if (row) {
                row.parentNode.removeChild(row);
            }
        }
    });

Echo.private('turno')
    .listen('nuevoTurno', async () => {
        try {
            // Espera a que se completen las solicitudes a la API antes de continuar
            await ticketsDisponibles();
            await ticketDerivado();
        } catch (error) {
            console.error("Ocurrió un error al obtener los datos de la API:", error);
        }
    });
