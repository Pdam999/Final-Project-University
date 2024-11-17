<?php

if(isset($_GET['id']) && $_GET['act']=='delete'){

    $tmid = $_GET['id'];
    //echo $id;

    $stmtDeTreatment = $condb->prepare('DELETE FROM tb_treatment WHERE tmid=:tmid');
    $stmtDeTreatment->bindParam(':tmid', $tmid , PDO::PARAM_INT);
    $stmtDeTreatment->execute();
    
    $condb = null; //close connect db
    //echo "จำนวน row ที่ลบได้ '.$stmtDeTreatment->rowCount();
        if($stmtDeTreatment->rowCount() == 1){
            echo '<script>
                setTimeout(function() {
                swal({
                    title: "ลบข้อมูลสำเร็จ",
                    type: "success"
                }, function() {
                    window.location = "treatment.php"; //หน้าที่ต้องการให้กระโดดไป
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
                    window.location = "treatment.php"; //หน้าที่ต้องการให้กระโดดไป
                });
                }, 1000);
            </script>';
        }
        } //isset
?>