function displayNewDate() {
    // Get input of new date
    var newDate = document.getElementById("newDate").value;

    // Display new date in appt card
    var dateOutput = document.getElementById("displayDate");
    dateOutput.textContent = newDate;

}

function displayNewTime() {
    // Get radio button selection
    var selectedTimeslot = document.querySelector('input[name="time"]:checked');
    
    // Check if there is a selection in the Cafe au Lait Radio Button Group
    if (selectedTimeslot) {
        // have selection in timeslot radio button group
    
        // Display new selected timeslot in appt card
        //var newTimeslot = selectedTimeslot.value;
        var timeOutput = document.getElementById("displayTime");
        timeOutput.textContent = selectedTimeslot.value;
    }

}

// register the event handlers for radio buttons in reschedule form
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
        var dateInput = document.getElementById("newDate");
        dateInput.setAttribute('min', minDate);

        // Assign displayNewDate event to date input tag in reschedule form
        dateInput.onchange = displayNewDate;
    
        // Assign displayNewTime event to timeslot radio buttons in reschedule form
        var timeRadioBtns = document.getElementsByName("time");
        timeRadioBtns[0].onclick = displayNewTime;
        timeRadioBtns[1].onclick = displayNewTime;
        timeRadioBtns[2].onclick = displayNewTime;
        timeRadioBtns[3].onclick = displayNewTime;
        timeRadioBtns[4].onclick = displayNewTime;
        timeRadioBtns[5].onclick = displayNewTime;
        timeRadioBtns[6].onclick = displayNewTime;
        timeRadioBtns[7].onclick = displayNewTime;
        timeRadioBtns[8].onclick = displayNewTime;
    }

}

// Assign an event listener to the window's load event:
window.onload = init;