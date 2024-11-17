<?php
include 'header.php';
include 'navbar.php';
include 'sidebar_menu.php';

$act = (isset($_GET['act']) ? $_GET['act'] : '');
//สร้างเงื่อนไขในการเรียกใช้ไฟล์
if($act == 'add'){
    if (isset($_GET['id'])) {
    include 'appointment_form_add2.php';
    } else {
    include 'appointment_form_add.php';
    }
}else if($act == 'delete'){
    include 'appointment_delete.php';
}else if($act == 'edit'){
    include 'appointment_form_edit.php';
}else{
    include 'appointment_list.php';
}

include 'footer.php';
?>









