document.addEventListener('DOMContentLoaded', function() {
    // Check the cookie on page load
    if (getCookie('showDiv') === 'true') {
        document.querySelector('.rechercheUNSPSC').classList.remove('hidden');
    }

    window.toggleDiv = function() {
        var div = document.querySelector('.rechercheUNSPSC');
        // Toggle visibility of the div
        div.classList.toggle('hidden');

        // Set a cookie to remember the state
        if (!div.classList.contains('hidden')) {
            setCookie('showDiv', 'true', 7); // Show div, store cookie for 7 days
        } else {
            setCookie('showDiv', 'false', 7); // Hide div, store cookie for 7 days
        }
    };

    // Helper function to set a cookie
    function setCookie(name, value, days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000)); // Expiry in days
        var expires = "expires=" + date.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/";
    }

    // Helper function to get a cookie by name
    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }
});
