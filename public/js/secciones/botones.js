async function llamarTicket(id) {
    try {
        // Deshabilitar los elementos y cambiar su estilo
        $("#body-disponibles").attr("disabled", true).css('opacity', '0.5').css('pointer-events', 'none');
        $("#body-derivados").attr("disabled", true).css('opacity', '0.5').css('pointer-events', 'none');
        // URL para la primera solicitud
        var url = urlLlamarTicket;
        var requestData = {
            id: id,
            llamar: 1,
        };
        var axiosConfig = {
            method: "post",
            url: url,
            data: requestData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        };
        // Realizar la primera solicitud Axios
        const response = await axios(axiosConfig);
        var data = response.data;
        if (data.success) {
            // Realizar las siguientes solicitudes utilizando await
            await ticketsDisponibles();
            await ticketSolicitado(id);
        }
    } catch (error) {
        console.error("Error de Axios: " + error);
    }
}

function eliminarTicket(id) {
    var url = urlEliminarTicket.replace('id', id);
    Swal.fire({
        title: '¿Es correcto eliminar el ticket?',
        text: "No podrás revertir esto!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            axios({
                method: "put",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }).then(function () {

            }).catch(function (error) {
                console.error("Error de Axios: " + error);
            });
        }
    });
}

function buscarTicket() {
    var alfa = $("#input-alfa").val();
    $("#input-alfa").val("");
    return axios.get(urlSearchTicket, {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        params: {
            alfa: alfa,
        }
    }).then(function (response) {
        var data = response.data;
        if (data.status === true) {
            Swal.fire({
                title: String(data.ticket.alfa),
                text: String(data.ticket.titular),
                type: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Atender',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    $("#body-disponibles").attr("disabled", true).css('opacity', '0.5').css('pointer-events', 'none');
                    $("#body-derivados").attr("disabled", true).css('opacity', '0.5').css('pointer-events', 'none');
                    // Construir la URL para la petición axios
                    var url = urlLlamarTicket;
                    var ticketId = data.ticket.id;
                    // Realizar una solicitud axios
                    axios.post(url, {
                        id: ticketId,
                        buscar: 1,
                    }, {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }).then(function (response) {
                        if (response.data.success) {
                            // Realizar una solicitud axios mediante la función ticketsDisponibles()
                            ticketsDisponibles().then(function () {
                                ticketSolicitado(ticketId).then(function () {
                                    // alert(data);
                                }).catch(function (error) {
                                    console.error("Error en la tercera petición axios: " + error);
                                });
                            }).catch(function (error) {
                                console.error("Error en la segunda petición axios: " + error);
                            });
                        }
                    }).catch(function (error) {
                        console.error("Error de axios: " + error);
                    });
                }
            });
        } else {
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: '¡Ticket no encontrado!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
            });
        }
    }).catch(function (error) {
        console.error('Error en la solicitud GET:', error);
    });
}

function atenderTurno(id) {
    var boton = $('#btn-atender');
    var ticketId = boton.attr("data-ticket");
    var url = urlUpdateTurno.replace('id', id);
    axios.put(url, {
        estado: "A"
    }, {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }).then(function (response) {
        var data = response.data;
        if (data.success) {
            return ticketSolicitado(ticketId);
        }
    }).then(function () {
        return ticketsDisponibles();
    }).then(function () {

    }).catch(function (error) {
        console.error("Error en la solicitud de axios: " + error);
    });
}

async function derivarTurno(id) {
    $("#body-disponibles").removeAttr("disabled").css('opacity', '1').css('pointer-events', 'auto');
    $("#body-derivados").removeAttr("disabled").css('opacity', '1').css('pointer-events', 'auto');
    var boton = $('#btn-derivar');
    var ticketId = boton.attr("data-ticket");
    var url = urlUpdateTurno.replace('id', id);
    try {
        const result = await Swal.fire({
            title: '¿A dónde se deriva?',
            input: 'select',
            inputOptions: {
                1: 'Cajas',
                2: 'Usuarios',
                3: 'Reclamos'
            },
            inputPlaceholder: 'Selecciona Sector',
            confirmButtonColor: '#4caf50',
            confirmButtonText: 'Derivar',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            inputValidator: (value) => {
                return new Promise((resolve) => {
                    value ? resolve() : resolve("Seleccionar Sector");
                });
            }
        });
        if (result.value) {
            const sector = result.value;
            const response = await axios.put(url, {
                estado: "D",
                sector: sector,
            }, {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var data = response.data;
            if (data.success) {
                await ticketSolicitado(ticketId);
                localStorage.removeItem("ticketId");
                await ticketsDisponibles();
            }
        }
    } catch (error) {
        console.error("Error en la función derivarTurno: " + error);
    }
}

function posponerTurno(id) {
    $("#body-disponibles").removeAttr("disabled").css('opacity', '1').css('pointer-events', 'auto');
    $("#body-derivados").removeAttr("disabled").css('opacity', '1').css('pointer-events', 'auto');
    var boton = $('#btn-posponer');
    var ticketId = boton.attr("data-ticket");
    var url = urlUpdateTurno.replace('id', id);
    var axiosConfig = {
        method: "put",
        url: url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            estado: "P"
        }
    };
    axios(axiosConfig).then(function (response) {
        var data = response.data;
        if (data.success) {
            return ticketSolicitado(ticketId);
        }
    }).then(function () {
        return ticketsDisponibles();
    }).then(function () {
        localStorage.removeItem("ticketId");
    }).catch(function (error) {
        console.error("Error en la petición axios: " + error);
    });
}

function culminarTurno(id) {
    $("#body-disponibles").removeAttr("disabled").css('opacity', '1').css('pointer-events', 'auto');
    $("#body-derivados").removeAttr("disabled").css('opacity', '1').css('pointer-events', 'auto');
    var boton = $('#btn-esperar');
    var ticketId = boton.attr("data-ticket");
    var url = urlUpdateTurno.replace('id', id);
    Swal.fire({
        title: '¿Finalizar la atención?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, finalizar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            axios.put(url, {
                estado: "C"
            }, {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }).then(function (response) {
                var data = response.data;
                if (data.success) {
                    ticketsDisponibles().then(function () {
                        return ticketSolicitado(ticketId);
                    }).then(function () {
                        localStorage.removeItem("ticketId");
                    }).catch(function (error) {
                        console.error("Error en la tercera petición axios: " + error);
                    });
                }
            }).catch(function (error) {
                console.error("Error de axios: " + error);
            });
        }
    });
}
