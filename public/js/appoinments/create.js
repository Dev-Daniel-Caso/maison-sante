let $doctor, $date, $specialty, $hours;
let iRadio;
const noHoursAlert =
    `<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
    <span class="alert-text"><strong>Lo Setimos!</strong> No se encontraron horas disponibles para el medico en el dia seleccionado.</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>`

$(function() {
    $specialty = $('#specialty');
    $doctor = $('#doctor');
    $date = $('#date');
    $hours = $('#hours');
    $error = $('#error');

    $specialty.change(() => {
        const specialtyId = $specialty.val();
        const url = `/specialties/${specialtyId}/doctors`;
        $.getJSON(url, onDoctorsLoaded);
    });
    $doctor.change(loadHours);
    $date.change(loadHours);
});

function onDoctorsLoaded(doctors) {
    let htmlOptions = '';
    doctors.forEach(doctor => {
        htmlOptions += `<option value="${doctor.id}">${doctor.name}</option>`;
    });
    $doctor.html(htmlOptions)
    loadHours(); // side-effect
}

function loadHours() {
    const selectedDate = $date.val();
    const doctorId = $doctor.val();
    const url = `/schedule/hours?date=${selectedDate}&doctor_id=${doctorId}`;
    $.getJSON(url, displayHours);
}

function displayHours(data) {
    if (!data.morning && !data.afternoon) {
        $hours.html(noHoursAlert)
            // $($hours).fadeTo(2000, 500).slideUp(500, function(){
            //     $($hours).slideUp(500);
            // });
        return;
    }
    let htmlHours = '';
    iRadio = 0;
    if (data.morning) {
        const morning_intervals = data.morning;
        morning_intervals.forEach(interval => {
            htmlHours += getRadioIntervalHtml(interval);
        });
    }
    if (data.afternoon) {
        const afternoon_intervals = data.afternoon;
        afternoon_intervals.forEach(interval => {
            htmlHours += getRadioIntervalHtml(interval);
        });
    }
    $hours.html(htmlHours);
}

function getRadioIntervalHtml(interval) {
    const text = `${interval.start} - ${interval.end}`;

    return `<div class="custom-control custom-radio mb-3">
  <input name="schedule_time" value="${interval.start}" class="custom-control-input" id="interval${iRadio}" type="radio" required>
  <label class="custom-control-label" for="interval${iRadio++}">${text}</label>
</div>`;
}