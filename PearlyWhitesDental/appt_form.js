// enable timeslot buttons for user selection upon date is chosen
function showTimeslots() {
    var timeslotDiv = document.getElementById("timeslot-col");
    timeslotDiv.style.display = "block";
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
    }

}

// Assign an event listener to the window's load event:
window.onload = init;