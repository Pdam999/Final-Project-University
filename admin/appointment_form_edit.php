<?php
if (isset($_GET['id']) && $_GET['act'] == 'edit') {

    // single row query แสดงแค่ 1 รายการ
    $stmtAppointmentDetail = $condb->prepare("SELECT * FROM tb_appointment WHERE aid=?");
    $stmtAppointmentDetail->execute([$_GET['id']]);
    $row = $stmtAppointmentDetail->fetch(PDO::FETCH_ASSOC);

    // ถ้าคิวรี่ผิดพลาดให้หยุดการทำงาน
    if ($stmtAppointmentDetail->rowCount() != 1) {
        exit();
    }
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>แก้ไขข้อมูลการนัดหมาย</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-body">
                        <div class="card card-primary">
                            <!-- form start -->
                            <form action="" method="post">
                                <div class="card-body">

                                    <div class="form-group row">
                                        <label class="col-sm-2">รหัสการรักษา</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="tmid" class="form-control" required value="<?= $row['tmid']; ?>" placeholder="รหัสการรักษา">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">รายละเอียดการนัดตรวจ</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="tappointment" class="form-control" required value="<?= $row['tappointment']; ?>" placeholder="รายละเอียดการนัดตรวจ">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">คำแนะนำก่อนเข้าตรวจ</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="tadvice" class="form-control" value="<?= $row['tadvice']; ?>" placeholder="คำแนะนำก่อนเข้าตรวจ">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">วันที่นัด</label>
                                        <div class="col-sm-4">
                                            <input type="date" name="tdate" class="form-control" required value="<?= $row['tdate']; ?>" placeholder="วันที่นัด">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">เวลาที่นัด</label>
                                        <div class="col-sm-4">
                                            <input type="time" name="ttime" class="form-control" required value="<?= $row['ttime']; ?>" placeholder="เวลาที่นัด">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2"></label>
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                                            <a href="appointment.php" class="btn btn-danger">ยกเลิก</a>
                                        </div>
                                    </div>
                                </div><!-- /.card-body -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
if (isset($_POST['tmid']) && isset($_POST['tappointment']) && isset($_POST['tadvice']) 
    && isset($_POST['tdate']) && isset($_POST['ttime'])) {

    // ประกาศตัวแปรรับค่าจากฟอร์ม
    $tmid = $_POST['tmid'];
    $tappointment = $_POST['tappointment'];
    $tadvice = $_POST['tadvice'];
    $tdate = $_POST['tdate'];
    $ttime = $_POST['ttime'];
    $aid = $_GET['id']; // Assuming the id is passed via the URL

    // SQL update
    $stmtUpdate = $condb->prepare("UPDATE tb_appointment SET
        tmid = :tmid, 
        tappointment = :tappointment, 
        tadvice = :tadvice,
        tdate = :tdate,
        ttime = :ttime
        WHERE aid = :aid");

    // bindParam
    $stmtUpdate->bindParam(':aid', $_GET['id'], PDO::PARAM_INT);
    $stmtUpdate->bindParam(':tmid', $tmid, PDO::PARAM_STR);
    $stmtUpdate->bindParam(':tappointment', $tappointment, PDO::PARAM_STR);
    $stmtUpdate->bindParam(':tadvice', $tadvice, PDO::PARAM_STR);
    $stmtUpdate->bindParam(':tdate', $tdate, PDO::PARAM_STR);
    $stmtUpdate->bindParam(':ttime', $ttime, PDO::PARAM_STR);
    
    $result = $stmtUpdate->execute();
    $condb = null; // close connection to the database

    if ($result) {
        echo '<script>
            setTimeout(function() {
                swal({
                    title: "แก้ไขข้อมูลสำเร็จ",
                    type: "success"
                }, function() {
                    window.location = "appointment.php"; // หน้าที่ต้องการให้กระโดดไป
                });
            }, 1000);
        </script>';
    } else {
        echo '<script>
            setTimeout(function() {
                swal({
                    title: "เกิดข้อผิดพลาด",
                    type: "error"
                }, function() {
                    window.location = "appointment.php"; // หน้าที่ต้องการให้กระโดดไป
                });
            }, 1000);
        </script>';
    }
}
?>
