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
    selectedHour = null;
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

    if (selectedDate && selectedHour) {
        fechaInput.value = selectedDate;
        horaInput.value = selectedHour;
    } else {
        const today = new Date();
        const formattedToday = `${today.getFullYear()}-${today.getMonth() + 1}-${today.getDate()}`;
        fechaInput.value = formattedToday;
    }
}

function validarCita() {
    if (!selectedDate || !selectedHour) {
        alert('Selecciona una fecha y hora antes de enviar el formulario.');
        return true;
    }

    const selectedDateObject = new Date(selectedDate);
    const currentDateObject = new Date();

    if (selectedDateObject < currentDateObject) {
        alert('La fecha seleccionada es en el pasado. Por favor, elige una fecha futura.');
        return true;
    }

    if (selectedDateObject.toDateString() === currentDateObject.toDateString()) {
        const selectedTime = new Date(`2000-01-01T${selectedHour}`);
        const currentTime = new Date(`2000-01-01T${currentDateObject.getHours()}:${currentDateObject.getMinutes()}`);

        if (selectedTime <= currentTime) {
            alert('La hora seleccionada es en el pasado. Por favor, elige una hora futura.');
            return true;
        }
    }

    return false;
}

function enviarCita() {
    if (validarCita()) {
        return;
    }

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
                
            } else {
                
            }
        },
        error: function (error) {
            console.error("Error en la solicitud AJAX: ", error);
        },
    });
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
    const fechaInput = form.querySelector('input[name="fecha"]');
    const horaInput = form.querySelector('input[name="hora"]');
    const botonEnviar = form.querySelector('.boton_enviar');

    botonEnviar.addEventListener('click', (event) => {
        event.preventDefault();
        enviarCita();
    });
});
