<?php
include 'header.php';
include 'navbar.php';
include 'sidebar_menu.php';

$act = (isset($_GET['act']) ? $_GET['act'] : '');
//สร้างเงื่อนไขในการเรียกใช้ไฟล์
if($act == 'add'){
    include 'member_form_add.php';
}else if($act == 'delete'){
    include 'member_delete.php';
}else if($act == 'edit'){
    include 'member_form_edit.php';
}else{
    include 'member_list.php';
}


include 'footer.php';
?>


<!-- Preloader -->
<!-- <div class="preloader flex-column justify-content-center align-items-center">
<img class="animation__shake" src="assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
</div> -->






