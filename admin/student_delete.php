<?php

if(isset($_GET['id']) && $_GET['act']=='delete'){

    $id = $_GET['id'];
    //echo $id;

    $stmtDeStudent = $condb->prepare('DELETE FROM tb_student WHERE id=:id');
    $stmtDeStudent->bindParam(':id', $id , PDO::PARAM_INT);
    $stmtDeStudent->execute();
    
    $condb = null; //close connect db
    //echo "จำนวน row ที่ลบได้ '.$stmtDeStudent->rowCount();
        if($stmtDeStudent->rowCount() == 1){
            echo '<script>
                setTimeout(function() {
                swal({
                    title: "ลบข้อมูลสำเร็จ",
                    type: "success"
                }, function() {
                    window.location = "student.php"; //หน้าที่ต้องการให้กระโดดไป
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
                    window.location = "student.php"; //หน้าที่ต้องการให้กระโดดไป
                });
                }, 1000);
            </script>';
        }
        } //isset
?>