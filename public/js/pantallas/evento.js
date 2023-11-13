Echo.channel('llamar-ticket')
    .listen('llamarTicket', (data) => {
        Swal.fire({
            showConfirmButton: false,
            width: 1000,
            timer: 5000,
            background: '#f2e20b',
            html: '<audio id="audio" autoplay controls="false" style="display:none"> <source src="../../sound/timbre2.mp3" /> </audio>' +
                '<table class="table">' +
                '<caption class="text-center" style="color:black">' + 'Llamando...' + '</caption>' +
                '<tr style="vertical-align:center; color:black">' +
                '<th>TURNO</th>' +
                '<th>' + data.ticket.turnos.puestos.mostradores.tipo + '</th>' +
                '</tr>' +
                '<tr style="vertical-align:center; color:black">' +
                '<td class="text-center"><h1 class="fw-bold">' + data.ticket.alfa + '</h1></td>' +
                '<td class="text-center"><h1 class="fw-bold">' + data.ticket.turnos.puestos.mostrador + '</h1></td>' +
                '</tr>' +
                '</table>'
        });
    });
