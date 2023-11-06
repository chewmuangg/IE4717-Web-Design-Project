// enable timeslot buttons for user selection upon date is chosen
function showTimeslots() {
    var timeslotDiv = document.getElementById("timeslot-col");
    timeslotDiv.style.display = "block";
}

// Checks for valid patient Id input
function patientIdChecker() {
    var patientId = document.getElementById("patientId").value;
    validPatientId = patientId.search(/^1\d{3}$/);  // checks for a 4 digit number starting with 1

    var text;

    if (validPatientId != 0) {
        text = "Invalid patient ID format!";
    } else {
        text = "";
    }

    // display error message if input length is more than 0
    if (patientId.length > 0) {
        document.getElementById("patientId-error").innerHTML = text;
    } else {
        document.getElementById("patientId-error").innerHTML = ""; 
    }
}

// Booking form validation in appointment.html (new appt)
function formChecker() {
    // Get Dentist radio button selection
    var selectedDentist = document.querySelector('input[name="dentist"]:checked');
    //var dentist = selectedDentist.value;
    
    // Select Service Type Input
    var selectService = document.querySelector('select[name="serviceType"]');
    var selectedOption = selectService.selectedIndex;
    
    // Time radio button selection
    var selectedTimeslot = document.querySelector('input[name="time"]:checked');
    
    if (!selectedDentist) {
        // no selection of dentist
        alert('Please select a preferred dentist.');
        return false; // Prevent form submission

    } else if (selectedOption === -1 || selectedOption === 0) {
        // no selection of service
        alert('Please select a valid service type.');
        return false; // Prevent form submission

    } else if (!selectedTimeslot) {
        // no selection of timeslot
        alert('Please select a preferred timeslot.');
        return false; // Prevent form submission
    } else {
        // all inputs are filled, submit form
        return true;
    }

}

function init() {
    'use strict';

    // Date picker validation
    var today = new Date();
    var tomorrowDate = today.getDate() + 1;
    var month = today.getMonth() + 1;   // getMonth() returns the month (0 to 11) of a date, e.g. September = 8
    var year = today.getFullYear();

    // add a 0 in front of dates between 1 and 9
    if (tomorrowDate < 10) {
        tomorrowDate = "0" + tomorrowDate.toString();
    }
    
    // add a 0 in front of months between 1 and 9
    if (month < 10) {
        month = "0" + month.toString();
    }

    // put date into correct format to set as the "min" attribute in the date picker
    var minDate = year + "-" + month + "-" + tomorrowDate;

    // Confirm that document.getElementById() can be used:
    if ( document && document.getElementById ) {
        // sets min date attribute for date picker
        var dateInput = document.getElementById("date");
        dateInput.setAttribute('min', minDate);

        // validates all fields in the form upon clicking submit button
        var form = document.getElementById("appt-form");
        form.onsubmit = formChecker;
    }

}

// Assign an event listener to the window's load event:
window.onload = init;