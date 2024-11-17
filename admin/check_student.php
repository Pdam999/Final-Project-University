<?php
try {
    $condb = new PDO('mysql:host=localhost;dbname=yourdbname', 'username', 'password');
    $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

if (isset($_POST['tcodestudent '])) {
    $student_id = $_POST['tcodestudent '];

    // ตรวจสอบรหัสนักศึกษาในฐานข้อมูล
    $stmtCheckStudent = $condb->prepare("SELECT COUNT(*) FROM tb_students WHERE tcodestudent  = :tcodestudent ");
    $stmtCheckStudent->bindParam(':tcodestudent ', $student_id, PDO::PARAM_STR);
    $stmtCheckStudent->execute();
    $studentExists = $stmtCheckStudent->fetchColumn();

    if ($studentExists) {
        echo 'exists';
    } else {
        echo 'not_exists';
    }
}
?>
