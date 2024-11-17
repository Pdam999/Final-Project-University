<?php
session_start();
session_unset(); // ลบข้อมูลเซสชันทั้งหมด
session_destroy(); // ทำลายเซสชัน

// พาผู้ใช้กลับไปที่หน้าล็อกอิน
header("Location:login.php");
exit();
?>
