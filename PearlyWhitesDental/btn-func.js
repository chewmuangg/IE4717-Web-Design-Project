function init() {
    'use strict';

    // Confirm that document.getElementById() can be used:
    if ( document && document.getElementById ) {
        
        // Confirmation message when clicking onto btn-cancel
        // Get a reference to the cancel button link by its ID
        var cancelLink = document.getElementById("btn-delete");

        // Add an event listener to the cancel button link
        cancelLink.addEventListener("click", function(event) {
            event.preventDefault(); // Prevent the default behavior of the anchor tag
            
            // Display a confirmation dialog
            var confirmation = window.confirm("Are you sure you want to cancel this appointment? The decision cannot be undone.");

            // Check the user's response
            if (confirmation) {
                // Clicks "ok" and direct to link to delete appt 
                window.location.href = cancelLink.getAttribute("href");
            } else {
                // Clicks "cancel" in message box and do nothing 
                event.preventDefault();
            }
        });


    }
}

// Assign an event listener to the window's load event:
window.onload = init;