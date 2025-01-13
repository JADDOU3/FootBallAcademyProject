document.addEventListener("DOMContentLoaded", () => {
    const submitButton = document.getElementById("request-button");
    const minDate = new Date("2008-01-01");
    const maxDate = new Date("2017-01-01");
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const phoneRegex = /^0\d{9}$/;

    submitButton.addEventListener("click", () => {
        const formData = {
            fullName: document.getElementById("fName").value,
            email: document.getElementById("email").value,
            password: document.getElementById("password").value,
            confirmPassword: document.getElementById("conf-password").value,
            subscriptionType: document.getElementById("subs-type").value,
            phoneNumber: document.getElementById("phone-number").value,
            dateOfBirth: document.getElementById("date-of-birth").value,
            bloodType: document.getElementById("blood-type").value,
        };

        // Validate the inputs
        if (formData.password !== formData.confirmPassword) {
            alert("كلمات المرور غير متطابقة. يرجى المحاولة مرة أخرى.");
            return;
        }

        

        if (!formData.fullName || !formData.email || !formData.password || !formData.phoneNumber || !formData.dateOfBirth) {
            alert("يرجى تعبئة جميع الحقول المطلوبة.");
            return;
        }

        if (!emailRegex.test(formData.email)) {
            alert('الرجاء إدخال بريد إلكتروني صحيح');
            return;
        }
    
        if (!phoneRegex.test(formData.phoneNumber)) {
            alert('الرجاء إدخال رقم هاتف مكون من 10 أرقام');
            return;
        }

        // Validate the date of birth
        const dob = new Date(formData.dateOfBirth);
        if (dob < minDate || dob > maxDate) {
            alert("يرجى اختيار تاريخ ميلاد بين 2008-01-01 و 2017-01-01.");
            return;
        }

        // Log the data (or send it to a server)
        console.log("Form Data:", formData);

        alert("تم إرسال الطلب بنجاح!");
    });
});
