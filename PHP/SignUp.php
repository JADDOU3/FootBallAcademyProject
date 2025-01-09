<?php

require_once "../PHP/dp_connection.php";

$errorMessages = [];
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Submit'])) {
    $fullName = $conn->real_escape_string($_POST['FullName']);
    $email = $conn->real_escape_string($_POST['Email']);
    $password = $_POST['Password'];
    $confPassword = $_POST['ConfPassword'];
    $registrationType = $conn->real_escape_string($_POST['RegistrationType']);
    $phoneNumber = $conn->real_escape_string($_POST['PhoneNumber']);
    $date = $_POST['Date'];
    $bloodType = $conn->real_escape_string($_POST['BloddType']);
    $passwordMatch = true;

    // Validate email uniqueness
    $emailCheck = "SELECT email FROM trainers WHERE email = '$email'";
    $result = $conn->query($emailCheck);
    if ($result->num_rows > 0) {
        $errorMessages[] = "<strong>الايميل مستخدم بالفعل</strong>";
    }

    // Validate phone number format
    if (!preg_match('/^\+9705\d{8}$/', $phoneNumber)) {
        $errorMessages[] = "يجب ان يكون رقم الهاتف بهذه الصيغة <strong> .9705XXXXXXXX</strong>+";
    }

    // Validate date range
    $maxDate = "2017-01-01";
    $minDate = "2008-01-01";
    if ($date < $minDate || $date > $maxDate) {
        $errorMessages[] = " يجب ان يكون التاريخ بين 01-01-2008 و 01-01-2017";
    }

    // Validate password confirmation
    if ($password !== $confPassword) {
        $errorMessages[] = "<strong>كلمة المرور غير متطابقة</strong>";
        $passwordMatch = false;
    } else {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    }

    if (empty($errorMessages)) {
        $sql = "INSERT INTO trainers (full_name, email, password, phone_number, registration_type, blood_type, date)
                VALUES ('$fullName', '$email', '$hashedPassword', '$phoneNumber', '$registrationType', '$bloodType', '$date')";
        if ($conn->query($sql) === TRUE) {
            $successMessage = "<strong>!تم ارسال الطلب بنجاح </strong>";
            // Clear form values
            $_POST = [];
        } else {
            $errorMessages[] = "Error: " . $conn->error;
        }
    }
}



// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Login'])) {
    $email = $conn->real_escape_string($_POST['login-email']);
    $password = $_POST['login-password'];

    // Check if the email exists in the database
    $sql = "SELECT * FROM trainers WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Password is correct, start a session
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['full_name'];

            // Redirect to a dashboard or home page
            header("Location: dashboard.php");
            exit();
        } else {
            $errorMessages[] = "كلمة المرور غير صحيحة";
        }
    } else {
        $errorMessages[] = "البريد الإلكتروني غير مسجل";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FootBall Academy</title>
    <link rel="stylesheet" href="../CSS/master.css">
    <link rel="stylesheet" href="../CSS/SignUp.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>

    </style>

<script src="../JavaScript/SignUpButton.js">
    
</script>

<script src="../JavaScript/AnimateFromBelow.js">
    
</script>

<script src="../JavaScript/subsButton.js">
    
</script>

<script src="../JavaScript/transformToLoginButton.js">
    
</script>
<script src="../JavaScript/notifications.js"></script>

<script src="../JavaScript/dropMenuToggle.js">
    
</script>
</head>
<body>
        <img src="../images/football-training-equipment-4.jpg" alt="Background image" class="Background">
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
</body>

<div class="programs-card-alignment animate-from-below" id="programs-card">
    <div class="programs-card">
        <h2>شهري</h2>
        <p class="price">11.99 دولار/شهريًا</p>
        <ul>
            <li>اشتراك شهري مرن</li>
            <li>إمكانية الوصول إلى جميع الفعاليات</li>
            <li>خدمات تدريبية مميزة</li>
            <li>خصومات خاصة للأعضاء</li>
        </ul>
        <button class="btn" data-type="monthly">اشترك الآن</button>
    </div>

    <div class="programs-card">
        <h2>سنوي</h2>
        <p class="price"><span style=" color: #5a9f7a; font-size: 120%;">99.99</span> <span style="text-decoration: line-through;">119.99</span> دولار/سنوياً</p>
        <ul>
            <li>اشتراك اقتصادي سنوي</li>
            <li>إمكانية الوصول إلى كافة المرافق</li>
            <li>حصص تدريبية متقدمة</li>
            <li>مزايا إضافية للأعضاء السنويين</li>
        </ul>
        <button class="btn" data-type="yearly">اشترك الآن</button>
    </div>
</div>


<div class="signup-alignment animate-from-below" id="form-section">
    <h1>اكتشف البطل الذي بداخلك. سجّل الآن وابدأ رحلتك نحو النجاح في كرة القدم</h1>

    <div class="SignUp-form animate-from-below" id="signup-form">
        <h2>استمارة التسجيل</h2>

        <!-- Display success message -->
        <?php if (!empty($successMessage)) : ?>
            <p style="color: green;"><?php echo htmlspecialchars_decode($successMessage); ?></p>
        <?php endif; ?>

        <!-- Display error messages -->
        <?php if (!empty($errorMessages)) : ?>
            <ul style="color: red; text-align: right; direction: rtl;">
            <?php foreach ($errorMessages as $error) : ?>
                <li><?php echo htmlspecialchars_decode($error); ?></li>
            <?php endforeach; ?>
             </ul>
        <?php endif; ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>#form-section" method="post">
    <div class="form-row">
        <div class="form-group">
            <label for="fName">الاسم الكامل</label>
            <input type="text" required id="fName" title="الاسم الكامل" name="FullName" value="<?php echo $_POST['FullName'] ?? ''; ?>"> 
        </div>
        <div class="form-group">
            <label for="email">البريد الالكتروني</label>
            <input type="email" required title="البريد الالكتروني" id="email" name="Email" value="<?php echo $_POST['Email'] ?? ''; ?>"> 
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="conf-password">تأكيد كلمة المرور</label>
            <input type="password" required title="تأكيد كلمة المرور" id="conf-password" name="ConfPassword" 
           value="<?php echo htmlspecialchars($_POST['ConfPassword'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="password">كلمة المرور</label>
            <input type="password" required title="كلمة المرور" id="password" name="Password" 
            value="<?php echo htmlspecialchars($_POST['Password'] ?? ''); ?>">
        </div>
    </div>


            <div class="form-row">
                <div class="form-group">
                    <label for="subs-type">نوع الاشتراك</label>
                    <select required title="نوع الاشتراك" id="subs-type" name="RegistrationType">
                        <option value="monthly" <?php echo (isset($_POST['RegistrationType']) && $_POST['RegistrationType'] == 'monthly') ? 'selected' : ''; ?>>شهري</option>
                        <option value="yearly" <?php echo (isset($_POST['RegistrationType']) && $_POST['RegistrationType'] == 'yearly') ? 'selected' : ''; ?>>سنوي</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="phone-number">رقم الهاتف</label>
                    <input type="text" required title="رقم الهاتف" id="phone-number" name="PhoneNumber" value="<?php echo $_POST['PhoneNumber'] ?? ''; ?>"> 
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="date-of-birth">تاريخ الميلاد</label>
                    <input type="date" required title="تاريخ الميلاد" id="date-of-birth" max="2017-01-01" min="2008-01-01" name="Date" value="<?php echo $_POST['Date'] ?? ''; ?>"> 
                </div>
                <div class="form-group">
                    <label for="blood-type">فصيلة الدم</label>
                    <select required title="فصيلة الدم" id="blood-type" name="BloddType">
                        <option value="O+" <?php echo (isset($_POST['BloddType']) && $_POST['BloddType'] == 'O+') ? 'selected' : ''; ?>>O+</option>
                        <option value="A+" <?php echo (isset($_POST['BloddType']) && $_POST['BloddType'] == 'A+') ? 'selected' : ''; ?>>A+</option>
                        <option value="B+" <?php echo (isset($_POST['BloddType']) && $_POST['BloddType'] == 'B+') ? 'selected' : ''; ?>>B+</option>
                        <option value="AB+" <?php echo (isset($_POST['BloddType']) && $_POST['BloddType'] == 'AB+') ? 'selected' : ''; ?>>AB+</option>
                        <option value="A-" <?php echo (isset($_POST['BloddType']) && $_POST['BloddType'] == 'A-') ? 'selected' : ''; ?>>A-</option>
                        <option value="B-" <?php echo (isset($_POST['BloddType']) && $_POST['BloddType'] == 'B-') ? 'selected' : ''; ?>>B-</option>
                        <option value="AB-" <?php echo (isset($_POST['BloddType']) && $_POST['BloddType'] == 'AB-') ? 'selected' : ''; ?>>AB-</option>
                        <option value="O-" <?php echo (isset($_POST['BloddType']) && $_POST['BloddType'] == 'O-') ? 'selected' : ''; ?>>O-</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <button id="already-subscribed" type="button" class="button">تسجيل الدخول</button>
                <input id="request-button" type="submit" name="Submit" value="ارسال الطلب">
        </div>
    </div>
    </form>
  <!-- Login Form -->
  <div class="SignUp-form animate-from-below" id="login-form" style="display: none;">
            <h2>تسجيل الدخول</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>#form-section" method="post">
                <div class="form-row">
                    <div class="form-group">
                        <label for="login-email">البريد الالكتروني</label>
                        <input type="email" required title="البريد الالكتروني" id="login-email" name="login-email">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="login-password">كلمة المرور</label>
                        <input type="password" required title="كلمة المرور" id="login-password" name="login-password">
                    </div>
                </div>
                <div class="form-row">
                    <button id="back-to-signup" type="button" class="button">العودة إلى التسجيل</button>
                    <input id="login-button" type="submit" name="Login" value="تسجيل الدخول">
                </div>
            </form>
        </div>
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
</html>