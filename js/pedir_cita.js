const daysTag = document.querySelector(".days"),
    currentDate = document.querySelector(".current-date"),
    prevNextIcon = document.querySelectorAll(".icons span");

let date = new Date(),
    currYear = date.getFullYear(),
    currMonth = date.getMonth();

const months = [
    "January", "February", "March", "April", "May", "June", "July",
    "August", "September", "October", "November", "December"
];

const selectableHours = document.querySelectorAll('.selectable-hour');
let selectedDate = null;
let selectedHour = null;

const renderCalendar = () => {
    let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(),
        lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(),
        lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(),
        lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate();
    let liTag = "";

    for (let i = firstDayofMonth; i > 0; i--) {
        liTag += `<li class="inactive" data-date="${currYear}-${currMonth}-${lastDateofLastMonth - i + 1}">${lastDateofLastMonth - i + 1}</li>`;
    }

    for (let i = 1; i <= lastDateofMonth; i++) {
        let isToday = i === date.getDate() && currMonth === date.getMonth() && currYear === date.getFullYear() ? "active" : "";
        liTag += `<li class="${isToday}" data-date="${currYear}-${currMonth + 1}-${i}" onclick="selectDay(this)">${i}</li>`;
    }

    for (let i = lastDayofMonth; i < 6; i++) {
        liTag += `<li class="inactive" data-date="${currYear}-${currMonth + 2}-${i - lastDayofMonth + 1}">${i - lastDayofMonth + 1}</li>`;
    }
    currentDate.innerText = `${months[currMonth]} ${currYear}`;
    daysTag.innerHTML = liTag;
}

function selectDay(element) {
    document.querySelectorAll('.days li').forEach(day => {
        day.classList.remove('active');
    });

    element.classList.add('active');
    selectedDate = element.dataset.date;
    updateSelectedDateTime();
}

function selectHour(element) {
    document.querySelectorAll('.selectable-hour').forEach(hour => {
        hour.classList.remove('selected');
    });

    element.classList.add('selected');
    selectedHour = element.querySelector('span').dataset.hour;
    updateSelectedDateTime();
}

function updateSelectedDateTime() {
    const fechaInput = document.querySelector('input[name="fecha"]');
    const horaInput = document.querySelector('input[name="hora"]');

    fechaInput.value = selectedDate || ''; // Almacenar la fecha seleccionada o dejar vacío si no hay ninguna seleccionada
    horaInput.value = selectedHour || ''; // Almacenar la hora seleccionada o dejar vacío si no hay ninguna seleccionada
}

// Función para validar si la fecha está en el pasado
function esFechaEnElPasado(fecha) {
    const fechaSeleccionada = new Date(fecha);
    const fechaActual = new Date();
    return fechaSeleccionada < fechaActual;
}



function enviarCita() {
    if (validarCita()) {
        var datosCita = {
            fecha: selectedDate.trim(),
            hora: selectedHour.trim(),
        };

        var datosJSON = JSON.stringify(datosCita);

        $.ajax({
            type: "POST",
            url: "../procesamiento_datos/procesar_cita.php",
            dataType: "json",
            data: { datos: datosJSON },
            success: function (respuesta) {
                console.log(respuesta);
                if (respuesta.success) {
                    // Hacer algo en caso de éxito, por ejemplo, redireccionar a otra página
                    window.location.href = "tu_pagina_de_exito.html";
                } else {
                    // Hacer algo en caso de error
                    alert('Error al procesar la cita. Por favor, inténtalo de nuevo.');
                }
            },
            error: function (error) {
                console.error("Error en la solicitud AJAX: ", error);
            },
        });
    }
}

document.addEventListener("DOMContentLoaded", function () {
    renderCalendar();

    prevNextIcon.forEach(icon => {
        icon.addEventListener("click", () => {
            currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

            if (currMonth < 0 || currMonth > 11) {
                date = new Date(currYear, currMonth, new Date().getDate());
                currYear = date.getFullYear();
                currMonth = date.getMonth();
            } else {
                date = new Date();
            }
            renderCalendar();
        });
    });

    selectableHours.forEach(hourSpan => {
        hourSpan.addEventListener('click', () => {
            selectHour(hourSpan);
        });
    });

    const form = document.querySelector('form');

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        enviarCita();
    });
});
