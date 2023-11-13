$(document).ready(function () {
    setInterval(function () {
        actualizarSidebar();
    }, 3500);
    setInterval(function () {
        actualizarTurnosCajas();
    }, 7500);
    setInterval(function () {
        actualizarTurnosBoxes();
    }, 7500);
});

function actualizarTurnosCajas() {
    axios.get(urlCheckDataCaja).then(response => {
        const data = response.data;
        const divCaja = document.querySelector("#myCarouselCaja");
        if (data.status === true) {
            clearCarousel(divCaja);
            data.turnos.forEach((element, i) => {
                const div = createCarouselItem(element, i);
                divCaja.appendChild(div);
            });
            $("#myCarouselCaja").carousel();
        } else {
            clearCarousel(divCaja);
        }
    }).catch(error => {
        console.error('Error en la solicitud GET: ', error);
    });
}

function actualizarTurnosBoxes() {
    axios.get(urlCheckDataBox).then(response => {
        const data = response.data;
        const divBox = document.querySelector("#myCarouselBox");
        if (data.status === true) {
            clearCarousel(divBox);
            data.turnos.forEach((element, i) => {
                const div = createCarouselItem(element, i);
                divBox.appendChild(div);
            });
            $("#myCarouselBox").carousel();
        } else {
            clearCarousel(divBox);
        }
    }).catch(error => {
        console.error('Error en la solicitud GET: ', error);
    });
}

function clearCarousel(carousel) {
    $(carousel).carousel("dispose");
    while (carousel.firstChild) {
        carousel.removeChild(carousel.firstChild);
    }
}

function createCarouselItem(element, index) {
    const div = document.createElement("div");
    div.id = element.alfa;
    div.className = index === 0 ? 'carousel-item active' : 'carousel-item';
    const content = `
        <h3 class="card-title">TURNO</h3>
        <h1>${element.alfa}</h1>
        <div>
            <hr width=100% align="center" style="border-top: 3px solid rgb(255, 255, 255);">
        </div>
        <h3 class="card-title">${element.tipo}</h3>
        <h1>${element.numero}</h1>`;
    div.innerHTML = content;
    return div;
}

const cajaTable = $("#cajaTable tbody");
const boxTable = $("#boxTable tbody");

function actualizarSidebar() {
    axios.get(urlCheckSidebar).then(response => {
        const data = response.data;
        if (data.status === true) {
            cajaTable.empty();
            boxTable.empty();
            data.turnos.forEach(element => {
                const row = createTableRow(element);
                appendRowToTable(row, element.sector === 1 ? cajaTable : boxTable);
            });
        } else {
            cajaTable.empty();
            boxTable.empty();
        }
    }).catch(error => {
        console.error('Error en la solicitud GET: ', error);
    });
}

function createTableRow(element) {
    return $("<tr></tr>").attr('id', element.alfa).html(`
        <td>${element.alfa}</td>
        <td>${element.numero}</td>
    `);
}

function appendRowToTable(row, table) {
    table.append(row);
}
