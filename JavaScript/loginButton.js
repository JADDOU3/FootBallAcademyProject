document.addEventListener('DOMContentLoaded', function () {
    const loginButton = document.getElementById('login-button');
    const userDropdown = document.getElementById('user-dropdown');
    const logoutButton = document.getElementById('logout-button');

    // Check if the user is already logged in (use localStorage for persistence)
    if (localStorage.getItem('isLoggedIn') === 'true') {
        userDropdown.style.display = 'block'; // Show dropdown menu if logged in
    }

    loginButton.addEventListener('click', function () {
        const email = document.getElementById('login-email').value.trim();
        const password = document.getElementById('login-password').value.trim();

        if (!email || !password) {
            alert('يرجى ملء جميع الحقول');
            return;
        }

        const validEmail = 'user@example.com';
        const validPassword = '12345';

        if (email === validEmail && password === validPassword) {
            alert('تسجيل الدخول ناجح!');
            localStorage.setItem('isLoggedIn', 'true'); // Persist login state
            userDropdown.style.display = 'block'; // Show dropdown
            window.location.href = '../html/index.html';
        } else {
            alert('البريد الإلكتروني أو كلمة المرور غير صحيحة');
        }
    });

    logoutButton.addEventListener('click', function () {
        localStorage.removeItem('isLoggedIn'); // Clear login state
        userDropdown.style.display = 'none'; // Hide dropdown
        alert('تم تسجيل الخروج بنجاح!');
        window.location.href = '../html/index.html';
    });
});
