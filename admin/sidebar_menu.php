<?php
session_start();

// ข้อมูลสำหรับการเชื่อมต่อฐานข้อมูล
$host = 'localhost';
$dbname = 'data_health';
$username = 'root';
$password = '';

try {
    // ทำการเชื่อมต่อฐานข้อมูล
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // กำหนดให้ PDO รายงานข้อผิดพลาดแบบการแจ้งเตือน
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // สมมติว่าคุณมีระบบล็อกอินและเก็บ username ของผู้ใช้ใน session หลังจากผู้ใช้ล็อกอิน
    // ในตัวอย่างนี้เราจะใช้ session ที่เก็บค่า username ของผู้ใช้
    if (isset($_SESSION['username'])) {
        $loggedInUser = $_SESSION['username'];
    } else {
        // หากไม่มีผู้ใช้ล็อกอิน ให้ใช้ค่าเริ่มต้น
        $loggedInUser = 'Admin';
    }

    // ดึงข้อมูลชื่อผู้ใช้จากฐานข้อมูล (ตัวอย่างนี้จะดึงข้อมูลตาม session username)
    $sql = "SELECT username FROM admin_user WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $loggedInUser);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // ตรวจสอบว่าพบผู้ใช้หรือไม่
    if ($result) {
        $adminUsername = $result['username'];
    } else {
        $adminUsername = 'Admin';
    }
} catch (PDOException $e) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Service Maejo</title>
</head>
<body>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index.php" class="brand-link">
            <img src="../assets/dist/img/MaejoUniversityLogo.png" alt="MaejoUniversity Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Health Service Maejo</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="../assets/dist/img/9703596.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">ยินดีต้อนรับ <?php echo htmlspecialchars($adminUsername); ?></a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>แดชบอร์ด</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="dashboard.php" class="nav-link">
                            <i class="nav-icon far fa-chart-bar"></i>
                            <p>สถิติการเข้ารักษา</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="dashboard2.php" class="nav-link">
                            <i class="nav-icon far fa-chart-bar"></i>
                            <p>สถิติอาการป่วย</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="dashboard3.php" class="nav-link">
                            <i class="nav-icon far fa-chart-bar"></i>
                            <p>สถิติการจ่ายยา</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="treatment.php" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>การเข้ารักษาพยาบาล</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="appointment.php" class="nav-link">
                            <i class="nav-icon fas fa-calendar"></i>
                            <p>การนัดหมาย</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="student.php" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>ข้อมูลนักศึกษา</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../logout.php" class="nav-link btn btn-danger">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>ออกจากระบบ</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</body>
</html>
