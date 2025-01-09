document.addEventListener('DOMContentLoaded', function() {
    // Toggle between Signup and Login forms
    document.getElementById('already-subscribed').addEventListener('click', function() {
        document.getElementById('signup-form').style.display = 'none';
        document.getElementById('login-form').style.display = 'block';
    });

    document.getElementById('back-to-signup').addEventListener('click', function() {
        document.getElementById('login-form').style.display = 'none';
        document.getElementById('signup-form').style.display = 'block';
    });

    // Automatically show the login form if there are login errors
    const loginErrorState = document.getElementById('login-error-state')?.value;
    if (loginErrorState === 'true') {
        document.getElementById('signup-form').style.display = 'none';
        document.getElementById('login-form').style.display = 'block';
    }
});