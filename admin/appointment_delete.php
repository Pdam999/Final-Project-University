<?php

if(isset($_GET['id']) && $_GET['act']=='delete'){

    $aid = $_GET['id'];
    //echo $id;

    $stmtDeAppointment = $condb->prepare('DELETE FROM tb_appointment WHERE aid=:aid');
    $stmtDeAppointment->bindParam(':aid', $aid , PDO::PARAM_INT);
    $stmtDeAppointment->execute();
    
    $condb = null; //close connect db
    //echo "จำนวน row ที่ลบได้ '.$stmtDeAppointment->rowCount();
        if($stmtDeAppointment->rowCount() == 1){
            echo '<script>
                setTimeout(function() {
                swal({
                    title: "ลบข้อมูลสำเร็จ",
                    type: "success"
                }, function() {
                    window.location = "appointment.php"; //หน้าที่ต้องการให้กระโดดไป
                });
                }, 1000);
            </script>';
            exit();
        }else{
            echo '<script>
                setTimeout(function() {
                swal({
                    title: "เกิดข้อผิดพลาด",
                    type: "error"
                }, function() {
                    window.location = "appointment.php"; //หน้าที่ต้องการให้กระโดดไป
                });
                }, 1000);
            </script>';
        }
        } //isset
?>