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
    selectedDate = element.dataset.date; // Asigna el valor de data-date a selectedDate
}

function selectHour(element) {
    document.querySelectorAll('.selectable-hour').forEach(hour => {
        hour.classList.remove('selected');
    });

    element.classList.add('selected');
    selectedHour = element.querySelector('span').dataset.hour; // Asigna el valor de data-hour a selectedHour
}

function mostrarError(mensaje) {
    const errorDiv = document.querySelector('.error');
    const errorText = document.querySelector('.error_text');
    const exitoDiv = document.querySelector('.succes');
    
    // Mostrar el mensaje de error y hacer visible el div
    errorText.textContent = mensaje;
    errorDiv.style.display = 'flex';
    exitoDiv.style.display = 'none';

}

function mostrarExito(mensaje) {
    const exitoDiv = document.querySelector('.succes');
    const exitoText = document.querySelector('.succes_text');
    const errorDiv = document.querySelector('.error');

    // Agregar el icono de "check" de Font Awesome
    exitoText.innerHTML = mensaje;

    // Mostrar el mensaje de éxito y hacer visible el div
    exitoDiv.style.display = 'flex';
    errorDiv.style.display = 'none';

}


function validarCita() {
    if (!selectedDate || !selectedHour) {
        mostrarError('Selecciona una fecha y hora antes de enviar el formulario.');
        return false;
    }

    const selectedDateOnly = new Date(selectedDate);
    const currentDateOnly = new Date();

    // Establecer la hora, minutos, segundos y milisegundos de la fecha actual a cero
    currentDateOnly.setHours(0, 0, 0, 0);

    if (selectedDateOnly.getTime() < currentDateOnly.getTime()) {
        mostrarError('La fecha seleccionada es en el pasado. Por favor, elige una fecha futura.');
        return false;
    }

    return true;
}

function enviarCita() {
    if (validarCita()) {

        id_psicologo = document.getElementById("id_psicologo").value;

        var datosCita = {
            fecha: selectedDate.trim(),
            hora: selectedHour.trim(),
            id: id_psicologo.trim(),
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
                    mostrarExito(respuesta.mensaje);
                } else {
                    mostrarError(respuesta.mensaje);
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
});

