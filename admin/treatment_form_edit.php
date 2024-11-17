    <?php
    if (isset($_GET['id']) && $_GET['act'] == 'edit') {

        //sngle row query แสดงแค่ 1 รายการ
        $stmtMemberDetail = $condb->prepare("SELECT* FROM tb_treatment WHERE tmid=?");
        $stmtMemberDetail->execute([$_GET['id']]);
        $row = $stmtMemberDetail->fetch(PDO::FETCH_ASSOC);

        // echo '<pre>';
        // print_r($row);
        // exit;
        // echo $stmtMemberDetail->rowCount();
        // exit;

        //ถ้าคิวรี่ผิดพลาดให้หยุดการทำงาน
        if ($stmtMemberDetail->rowCount() != 1) {
            exit();
        }
    } //isset
    ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>แก้ไขข้อมูลการเข้ารักษา</h1>
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
                                            <label class="col-sm-2">รหัสนักศึกษา</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="tcodestudent" class="form-control" required value="<?= $row['tcodestudent'];?>" placeholder="รหัสนักศึกษา">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2">ส่วนสูง(ซ.ม.)</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="theight" class="form-control" required value="<?= $row['theight'];?>" placeholder="ส่วนสูง">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2">น้ำหนัก(ก.ม.)</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="tweight" class="form-control" required value="<?= $row['tweight'];?>" placeholder="น้ำหนัก">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2">อาการ</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="tsymptom" class="form-control" required value="<?= $row['tsymptom'];?>" placeholder="อาการ">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2">วิธีการรักษา</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="dhealth" class="form-control" required value="<?= $row['dhealth'];?>" placeholder="วิธีการรักษา">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2">การจ่ายยา</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="bdrug" class="form-control" value="<?= $row['bdrug'];?>" placeholder="การจ่ายยา">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2">ประวัติแพ้ยา</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="tdrug" class="form-control" value="<?= $row['tdrug'];?>" placeholder="ประวัติแพ้ยา">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2">โรคประจำตัว</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="tcd" class="form-control" value="<?= $row['tcd'];?>" placeholder="โรคประจำตัว">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2">วันที่การรักษา</label>
                                            <div class="col-sm-4">
                                                <input type="date" name="tdate" class="form-control" required value="<?= $row['tdate'];?>" placeholder="วันที่การรักษา">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2">เวลารักษา</label>
                                            <div class="col-sm-4">
                                                <input type="time" name="ttime" class="form-control" required value="<?= $row['ttime']; ?>" placeholder="เวลารักษา">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-sm-2"></label>
                                            <div class="col-sm-4">
                                                <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                                                <a href="treatment.php" class="btn btn-danger">ยกเลิก</a>
                                            </div>
                                        </div>

                                    </div><!-- /.card-body -->
                                </form>

                                <?php
                                // echo '<pre>';
                                // print_r($_POST);
                                // exit;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php
                                // echo '<pre>';
                                // print_r($_POST);
                                //exit;

    if (isset($_POST['tcodestudent']) && isset($_POST['theight']) && isset($_POST['tweight']) 
    && isset($_POST['tsymptom']) && isset($_POST['dhealth']) && isset($_POST['bdrug']) 
    && isset($_POST['tdrug']) && isset($_POST['tcd']) && isset($_POST['tdate']) && isset($_POST['ttime'])) {

    // รับค่าจากฟอร์ม
    $tcodestudent = $_POST['tcodestudent'];
    $theight = $_POST['theight'];
    $tweight = $_POST['tweight'];
    $tsymptom = $_POST['tsymptom'];
    $dhealth = $_POST['dhealth'];
    $bdrug = $_POST['bdrug'];
    $tdrug = $_POST['tdrug'];
    $tcd = $_POST['tcd'];
    $tdate = $_POST['tdate'];
    $ttime = $_POST['ttime'];

    // SQL สำหรับอัปเดตข้อมูล
    $stmtUpdate = $condb->prepare("UPDATE tb_treatment SET
        tcodestudent = :tcodestudent, 
        theight = :theight,
        tweight = :tweight, 
        tsymptom = :tsymptom, 
        dhealth = :dhealth,
        bdrug = :bdrug,
        tdrug = :tdrug,
        tcd = :tcd,
        tdate = :tdate,
        ttime = :ttime
        WHERE tmid = :tmid");

    // Bind parameters
    $stmtUpdate->bindParam(':tmid', $_GET['id'], PDO::PARAM_INT);
    $stmtUpdate->bindParam(':tcodestudent', $tcodestudent, PDO::PARAM_STR);
    $stmtUpdate->bindParam(':theight', $theight, PDO::PARAM_INT);
    $stmtUpdate->bindParam(':tweight', $tweight, PDO::PARAM_INT);
    $stmtUpdate->bindParam(':tsymptom', $tsymptom, PDO::PARAM_STR);
    $stmtUpdate->bindParam(':dhealth', $dhealth, PDO::PARAM_STR);
    $stmtUpdate->bindParam(':bdrug', $bdrug, PDO::PARAM_STR);
    $stmtUpdate->bindParam(':tdrug', $tdrug, PDO::PARAM_STR);
    $stmtUpdate->bindParam(':tcd', $tcd, PDO::PARAM_STR);
    $stmtUpdate->bindParam(':tdate', $tdate, PDO::PARAM_STR);
    $stmtUpdate->bindParam(':ttime', $ttime, PDO::PARAM_STR);

    // Execute and check result
    $result = $stmtUpdate->execute();

    // ปิดการเชื่อมต่อฐานข้อมูล
    $condb = null;

    if ($result) {
        echo '<script>
            setTimeout(function() {
                swal({
                    title: "แก้ไขข้อมูลสำเร็จ",
                    type: "success"
                }, function() {
                    window.location = "treatment.php";
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
                    window.location = "treatment.php";
                });
            }, 1000);
        </script>';
    }
}


                                
