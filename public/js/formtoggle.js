document.addEventListener("DOMContentLoaded", function() {
    // Function pour montrer ou cacher le form
    function changeform(formId) {
        const loginSections = document.querySelectorAll('.login-section');
        loginSections.forEach(section => {
            section.classList.remove('active');
        });
        const activeForm = document.getElementById(formId);
        if (activeForm) {
            activeForm.classList.add('active');
        }
    }

    // Listeners pour les évenement
    const bouttonEmail = document.querySelector('button[onclick="changeform(\'email-login\')"]');
    const BouttonNEQ = document.querySelector('button[onclick="changeform(\'neq-login\')"]');

    bouttonEmail.addEventListener('click', function() {
        changeform('email-login');
    });

    BouttonNEQ.addEventListener('click', function() {
        changeform('neq-login');
    });
});
