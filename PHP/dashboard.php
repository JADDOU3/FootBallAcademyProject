<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: SignUp.php");
    exit();
}

// Get user details from the session
$userName = $_SESSION['user_name'];
$userEmail = $_SESSION['user_email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - FootBall Academy</title>
    <link rel="stylesheet" href="../CSS/master.css">
    <link rel="stylesheet" href="../CSS/dashboard.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="../JavaScript/dropMenuToggle.js"></script>
    <script src="../JavaScript/notifications.js"></script>
</head>
<body>
    <img src="../images/football-training-equipment-4.jpg" alt="Background image" class="Background">
    
    <!-- Navigation Bar -->
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

    <!-- Dashboard Content -->
    <div class="dashboard-container">
        <h1>مرحبًا بك، <?php echo htmlspecialchars($userName); ?>!</h1>
        <p>بريدك الإلكتروني: <?php echo htmlspecialchars($userEmail); ?></p>
        
        <div class="dashboard-cards">
            <div class="dashboard-card">
                <h2>الدورات التدريبية</h2>
                <p>تصفح الدورات التدريبية المتاحة وقم بالتسجيل.</p>
                <a href="../html/academy.html" class="dashboard-button">عرض الدورات</a>
            </div>
            
            <div class="dashboard-card">
                <h2>الأخبار</h2>
                <p>ابقَ على اطلاع بآخر أخبار الأكاديمية.</p>
                <a href="../html/News.html" class="dashboard-button">عرض الأخبار</a>
            </div>
            
            <div class="dashboard-card">
                <h2>تواصل معنا</h2>
                <p>لديك استفسار؟ تواصل معنا مباشرة.</p>
                <a href="../PHP/Contact.php" class="dashboard-button">التواصل</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="styleadjust">
        <footer class="onlyForAnimation">
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

    <!-- Call toggleDropdownVisibility to show the dropdown if the user is logged in -->
    <script>
        window.onload = function() {
            toggleDropdownVisibility(); // Show the dropdown menu
        };
    </script>
</body>
</html>