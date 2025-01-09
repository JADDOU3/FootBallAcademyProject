function sendMessage() {
    // Get input values from the form fields
    const fullName = document.getElementById('fName').value.trim();
    const email = document.getElementById('email').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const message = document.getElementById('the-message').value.trim();

    // Email and phone number validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const phoneRegex = /^0\d{9}$/;

    if (!fullName || !email || !phone || !message) {
        alert('الرجاء ملء جميع الحقول المطلوبة');
        return;
    }

    if (!emailRegex.test(email)) {
        alert('الرجاء إدخال بريد إلكتروني صحيح');
        return;
    }

    if (!phoneRegex.test(phone)) {
        alert('الرجاء إدخال رقم هاتف مكون من 10 أرقام');
        return;
    }

    // Create a message object
    const formData = {
        fullName: fullName,
        email: email,
        phone: phone,
        message: message
    };

    // Display the collected data (For demonstration purposes)
    console.log('Form Data:', formData);

    // Temporary feedback to the user
    alert('تم إرسال الرسالة بنجاح!');
}
