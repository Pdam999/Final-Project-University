<?php
include 'header.php';
include 'navbar.php';
include 'sidebar_menu.php';

$act = (isset($_GET['act']) ? $_GET['act'] : '');
//สร้างเงื่อนไขในการเรียกใช้ไฟล์
if($act == 'add'){
    include 'student_form_add.php';
}else if($act == 'delete'){
    include 'student_delete.php';
}else if($act == 'edit'){
    include 'student_form_edit.php';
}else{
    include 'student_list.php';
}


include 'footer.php';
?>


<!-- Preloader -->
<!-- <div class="preloader flex-column justify-content-center align-items-center">
<img class="animation__shake" src="assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
</div> -->







