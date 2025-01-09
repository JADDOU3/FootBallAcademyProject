<?php
// Include database connection
include '../PHP/dp_connection.php';

// Initialize an empty message
$message = "";
$errorMessages = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $full_name = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone_number = $_POST['phone_number'] ?? '';
    $user_message = $_POST['message'] ?? '';

    // Sanitize input
    $full_name = $conn->real_escape_string($full_name);
    $email = $conn->real_escape_string($email);
    $phone_number = $conn->real_escape_string($phone_number);
    $user_message = $conn->real_escape_string($user_message);

    // Validate phone number format
    if (!preg_match('/^\+9705\d{8}$/', $phone_number)) {
        $errorMessages = "<span style='color: red; padding-right: 100px;'>يجب ان يكون رقم الهاتف بهذه الصيغة <strong>9705XXXXXXXX+</strong></span>";

    }

    // If there are no errors, proceed with database insertion
    if (empty($errorMessages)) {
        $sql = "INSERT INTO contact (full_name, email, phone_number, message) 
                VALUES ('$full_name', '$email', '$phone_number', '$user_message')";

        if ($conn->query($sql) === TRUE) {
            $message = "تم إرسال رسالتك بنجاح!"; // Success message
            $full_name = $email = $phone_number = $user_message = ""; // Clear variables
        } else {
            $message = "حدث خطأ أثناء إرسال الرسالة: " . $conn->error; // Error message
        }
    }
}

// Close connection
$conn->close();
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FootBall Academy</title>
    <link rel="stylesheet" href="../CSS/master.css">
    <link rel="stylesheet" href="../CSS/Contact.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>

    </style>

<script src="../JavaScript/NavigateTosignupButton.js">
    
</script>
<script src="../JavaScript/notifications.js"></script>
<script src="../JavaScript/ContactButton.js">
    
</script>

<script src="../JavaScript/AnimateFromBelow.js">
    
</script>
<script src="../JavaScript/dropMenuToggle.js"></script>

</head>
<body>
    <img src="../images/metodologia2.jpg" alt="Background image" class="Background">
    <nav class="navstyle">
    <a href="../html/index.html" style="text-decoration: none; color: blanchedalmond; margin: 0 10px;">
        <span>الصفحة الرئيسية</span> 
    </a> 
    <a href="../html/academy.html" style="text-decoration: none; color: blanchedalmond; margin: 0 10px;">
        <span>الأكاديمية</span>
    </a> 
    <a href="../html/Manhaj.html" style="text-decoration: none; color: blanchedalmond; margin: 0 10px;">
        <span>المنهج</span>
    </a> 
    <a href="../html/Rules.html" style="text-decoration: none; color: blanchedalmond; margin: 0 10px;">
        <span>الشروط والأحكام</span>
    </a> 
    <a href="../PHP/Contact.php" style="text-decoration: none; color: blanchedalmond; margin: 0 10px;">
        <span>تواصل معنا</span>
    </a> 
    <a href="../html/News.html" style="text-decoration: none; color: blanchedalmond; margin: 0 10px;">
        <span>الأخبار</span>
    </a> 
    <a href="../PHP/SignUp.php" style="text-decoration: none; color: blanchedalmond; margin: 0 10px;">
        <span>سجِّل الآن</span>
    </a>
    <!-- Dropdown Menu -->
    <div class="dropdown">
        <a href="#" style="text-decoration: none; color: blanchedalmond;">
            <span>قائمة الخيارات</span>
        </a>
        <div class="dropdown-content">
            <a href="#" id="notification-item">
                <i id="notification-bell" class="fa-solid fa-bell"></i>
                <span id="notification-count" class="notification-badge">0</span> الاشعارات
            </a>
            <a href="#" onclick="logout()"><i id="logout" class="fa-solid fa-right-from-bracket"></i>تسجيل الخروج</a>
        </div>
    </div>
</nav>

      <div class="message animate-from-below">
        <h1>تواصل معنا</h1>
        <p>
            شكرًا لاختياركم أكاديمية كابتن الرياضية؛ ثقتكم تدفعنا نحو الأمام؛
             ونعدكم بنتائج تفوق توقعاتكم؛ وننتظر استفساراتكم عبر قنوات الاتصال التالية
        </p>
      </div>

      <div class="contact-alignment animate-from-below">
        <div class="info"> 
            <div class="info-cards">
                <i id="location-icon" class="fa-solid fa-location-dot"></i>
                <div class="text-content">
                <h3>شارع رفيديا , رفيديا , نابلس </h3>
                <p>نابلس</p>
                </div>
            </div>

            <div class="info-cards">
                <i id="time-icon" class="fa-solid fa-clock"></i>
                <div class="text-content">
                <h3>ساعات العمل</h3>
                <p>
                    السبت - الخميس 
                    <br>
                    صباحا 9:00 - مساءا 5:00
                 </p>
                </div>
            </div>

            <div class="info-cards">
                <i class="fa-solid fa-envelope"></i>
                <div class="text-content">
                    <h3>البريد الالكتروني </h3>
                    <p>test@gmail.com</p>
                </div>
            </div>

            <div class="info-cards">
                <i class="fa-solid fa-phone"></i>
                <div class="text-content">
                <h3>رقم الهاتف</h3>
                <p class="number-alignment">059 000 0000</p>
            </div>
            </div>

            <div class="info-cards">
                <i class="fa-brands fa-whatsapp"></i>
                <div class="text-content">
                <h3>واتساب</h3>
                <p class="number-alignment">059 000 0000</p>
            </div>
            </div>

        </div>


        <div class="form" id="form-section">
    <h2>هل لديك أسئلة أو تحتاج إلى دعم أو جلسة استشارية مجانية؟</h2>
    <form action="Contact.php#form-section" method="post">
        <div class="input-fields">
            <div class="form-group">
                <label for="fName">الاسم الكامل</label>
                <input type="text" required id="fName" name="full_name" placeholder="ادخل اسمك الكامل" title="الاسم الكامل" value="<?php echo htmlspecialchars($full_name ?? '', ENT_QUOTES); ?>">
            </div>
            <div class="form-group">
                <label for="email">البريد الالكتروني</label>
                <input type="email" required id="email" name="email" placeholder="ادخل بريدك الالكتروني" title="البريد الالكتروني" value="<?php echo htmlspecialchars($email ?? '', ENT_QUOTES); ?>">
            </div>
            <div class="form-group">
                <label for="phone">رقم الهاتف</label>
                <input type="text" required id="phone" name="phone_number" placeholder="ادخل رقم هاتفك" title="رقم الهاتف" value="<?php echo htmlspecialchars($phone_number ?? '', ENT_QUOTES); ?>">
            </div>
            <div class="form-group">
                <label for="the-message">الرسالة</label>
                <span>لا يجب ان تتجاوز الرسالة اكثر من 1000 حرف</span>
                <textarea required id="the-message" name="message" placeholder="ادخل رسالتك" title="الرسالة" maxlength="1000"><?php echo htmlspecialchars($user_message ?? '', ENT_QUOTES); ?></textarea>
            </div>
            <button type="submit" id="contact-button">ارسال</button>
        </div>

        <!-- Success or Error Message -->
        <div class="response-message">
            <?php if (!empty($message)) echo htmlspecialchars($message, ENT_QUOTES); ?>
        </div>
        <!-- Error Message Display -->
    <?php if (!empty($errorMessages)) { echo "<p class='error'>$errorMessages</p>"; } ?>

    
    </form>
</div>





      </div>


      <div class="map animate-from-below">
        <iframe id="map-iframe" src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d5676.364048644867!2d35.22479964945128!3d32.22615101842358!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1735325963337!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <div class="footer animate-from-below">
        <h2>!!كن جزءا من فريقنا</h2>
        <button class="button" onclick="navigateToSignUpForm()">سجل الان</button>
    </div>


    <div class="styleadjust">
        <footer class="onlyForAnimation animate-from-below">
            <h3>ابقى على اطلاع بأخر التحديثات</h3>
            <div class="social-icons">
                <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
            </div>
            <div class="columns">
                <div class="column">
                    <h4>روابط</h4>
                    <ul>
                        <li><a href="../html/index.html">الصفحة الرئيسية</a></li>
                        <li><a href="../html/Manhaj.html">المنهج</a></li>
                        <li><a href="../html/academy.html">الأكاديمية</a></li>
                    </ul>
                </div>
                <div class="column">
                    <h4>مصادر</h4>
                    <ul>
                        <li><a href="../html/News.html">الأخبار</a></li>
                        <li><a href="../html/Contact.html">تواصل معنا</a></li>
                        <li><a href="../html/SignUp.html">سجل الآن</a></li>
                    </ul>
                </div>
                <div class="column">
                    <h4>جهات الاتصال</h4>
                    <p style="color: rgb(194, 194, 194);">رفيديا, نابلس</p>
                    <p style="color: rgb(194, 194, 194);">055 000 0000</p>
                    <p style="color: rgb(194, 194, 194);">050 000 0000</p>
                    <p><a href="mailto:test@gmail.com" style="color: white;">test@gmail.com</a></p>
                </div>
            </div>
            <div class="bottom">
                حقوق النشر © 2025. جميع الحقوق محفوظة. رفيديا, نابلس<br>
                طورت بواسطة أكاديمية الكابتن
            </div>
        </footer>
    </div>
    
</body>
</html>