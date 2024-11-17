<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // กำหนดค่าเชื่อมต่อฐานข้อมูล
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "data_health";

    try {
        // สร้างการเชื่อมต่อ PDO
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        
        // กำหนดการเชื่อมต่อ PDO ให้เป็นโหมด exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // รับค่าจากฟอร์ม
        $username = $_POST['username'];
        $password = $_POST['password'];

        // สร้างคำสั่ง SQL ด้วย prepared statement
        $stmt = $pdo->prepare("SELECT * FROM admin_user WHERE username = :username AND password = :password");

        // ผูกค่าพารามิเตอร์
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', md5($password));

        // ดำเนินการคำสั่ง SQL
        $stmt->execute();

        // ตรวจสอบผลลัพธ์
        if ($stmt->rowCount() == 1) {
            // เข้าสู่ระบบสำเร็จ
            session_start();
            $_SESSION['username'] = $username;
            header("location: admin/index.php"); // แก้ไขตามไฟล์ที่ต้องการให้ไปหลังบ้าน
            exit();
        } else {
            // เข้าสู่ระบบไม่สำเร็จ
            $loginError = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
        }
    } catch(PDOException $e) {
        // การเชื่อมต่อฐานข้อมูลผิดพลาด
        die("ERROR: Could not connect. " . $e->getMessage());
    }

    // ปิดการเชื่อมต่อ PDO
    unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css?v=3.2.0">
</head>

<body class="hold-transition login-page">
    <div class="login-box">

        <div class="card">
        <div class="login-logo">
            <b>Health Service</b> Login
        </div>
            <!-- เพิ่มรูปภาพ -->
        <div class="login-logo">
            <img src="assets/dist/img/MaejoUniversityLogo.png" alt="Health Service Logo" style="width: 100px; height: auto;">
        </div>
            <div class="card-body login-card-body">
                <?php if (isset($loginError)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($loginError); ?>
                    </div>
                    
                <?php endif; ?>
                <p class="login-box-msg">กรุณา Login เข้าระบบอนามัย</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success btn-block">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
