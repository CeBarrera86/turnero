$(document).ready(function () {
    if (localStorage.getItem("ticketId")) {
        $("#body-disponibles").attr("disabled", true).css('opacity', '0.5').css('pointer-events', 'none');
        $("#body-derivados").attr("disabled", true).css('opacity', '0.5').css('pointer-events', 'none');
        ticketSolicitado(localStorage.getItem("ticketId"));
    }

    ticketsDisponibles();

    ticketDerivado();
});

const tabla = document.querySelector("#disponibles tbody");
function ticketsDisponibles() {
    return axios.get(urlVerificarDisponibles, {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        params: {
            sector: sector,
        }
    }).then(function (response) {
        const data = response.data;
        if (data.status) {
            while (tabla.firstChild) {
                tabla.removeChild(tabla.firstChild);
            }
            data.tickets.forEach(function (element) {
                const row = document.createElement("tr");
                row.setAttribute('id', element.id);
                row.innerHTML = `
                  <td>
                    <h4><strong>${element.alfa}</strong></h4>
                    <p>${element.titular}</p>
                  </td>
                  <td class="td-actions text-right">
                    <button id="btn-Llamar" class="btn btn-fab btn-round btn-outline-primary" title="Llamar"
                    onclick="llamarTicket(${element.id})">
                      <i class="material-icons">notifications</i>
                    </button>
                    <button id="btn-eliminar" class="btn btn-fab btn-round btn-outline-danger" title="Eliminar"
                    onclick="eliminarTicket(${element.id})">
                      <i class="material-icons">delete_outline</i>
                    </button>
                  </td>`;
                tabla.appendChild(row);
            });
        } else {
            // Limpiar el contenido cuando status es false
            tabla.innerHTML = '';
        }
    }).catch(function (error) {
        console.error('Error en la solicitud GET:', error);
    });
}

function ticketSolicitado(id) {
    return axios.get(urlCheckTurno, {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        params: {
            id: id,
        }
    }).then(function (response) {
        localStorage.setItem("ticketId", id);
        const divBody = document.querySelector("#solicitado-body");
        const divFooter = document.querySelector("#solicitado-footer");
        const data = response.data;
        if (data.status == true) {
            divBody.innerHTML = `
                <div class="col-md-12">
                    <h3><strong> ${data.turno.alfa} </strong></h1>
                </div>
                <div class="col-md-12">
                    <h5> ${data.turno.titular} </h5>
                </div>`;
            if (data.turno.estado == 5) {
                divFooter.innerHTML = `
                    <button id="btn-atender" class="btn btn-fab btn-round btn-outline-success mx-3" title="Atender"
                        data-ticket="${id}" onclick="atenderTurno(${data.turno.id})">
                        <i class="material-icons">done_all</i>
                    </button>
                    <button id="btn-derivar" class="btn btn-fab btn-round btn-outline-warning mx-3" title="Derivar"
                        data-ticket="${id}" onclick="derivarTurno(${data.turno.id})">
                        <i class="material-icons">swap_horiz</i>
                    </button>
                    <button id="btn-posponer" class="btn btn-fab btn-round btn-outline-info mx-3" title="Posponer"
                        data-ticket="${id}" onclick="posponerTurno(${data.turno.id})">
                        <i class="material-icons">hourglass_bottom</i>
                    </button>`;
            } else {
                divFooter.innerHTML = `
                    <button id="btn-derivar" class="btn btn-fab btn-round btn-outline-warning mx-3" title="Derivar"
                        data-ticket="${id}" onclick="derivarTurno(${data.turno.id})">
                        <i class="material-icons">swap_horiz</i>
                    </button>
                    <button id="btn-finalizar" class="btn btn-fab btn-round btn-outline-danger mx-3" title="Finalizar"
                        data-ticket="${id}" onclick="culminarTurno(${data.turno.id})">
                        <i class="material-icons">close</i>
                    </button>`;
            }
        } else {
            // Limpiar el contenido cuando status es false
            divBody.innerHTML = "";
            divFooter.innerHTML = "";
        }
    }).catch(function (error) {
        console.error('Error en la solicitud GET:', error);
    });
}

function ticketDerivado() {
    return axios.get(urlVerificarDerivados, {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        params: {
            sector: sector,
        }
    }).then(function (response) {
        const tabla = document.querySelector("#derivados tbody");
        const data = response.data;
        if (data.status === true) {
            while (tabla.firstChild) {
                tabla.removeChild(tabla.firstChild);
            }
            data.tickets.forEach(function (element) {
                const row = document.createElement("tr");
                row.innerHTML = `
                  <td>
                    <h4><strong>${element.alfa}</strong></h4>
                    <p>${element.titular}</p>
                  </td>
                  <td class="td-actions text-right">
                    <button id="btn-Llamar" class="btn btn-fab btn-round btn-outline-primary" title="Llamar"
                    onclick="llamarTicket(${element.id})">
                      <i class="material-icons">notifications</i>
                    </button>
                  </td>`;
                tabla.appendChild(row);
            });
        } else {
            tabla.innerHTML = '';
        }
    }).catch(function (error) {
        console.error('Error en la solicitud GET:', error);
    });
}
