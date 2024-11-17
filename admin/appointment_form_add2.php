    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>เพิ่มข้อมูลการนัดหมาย</h1>
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
                                                <input type="text" name="tmid" value=<?=$_GET['id']?> class="form-control" required placeholder="รหัสการรักษา">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2">รายละเอียดการนัดตรวจ</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="tappointment" class="form-control" required placeholder="รายละเอียดการนัดตรวจ">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2">คำแนะนนำก่อนเข้าตรวจ</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="tadvice" class="form-control"  placeholder="คำแนะนนำก่อนเข้าตรวจ">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2">วันที่นัด</label>
                                            <div class="col-sm-4">
                                                <input type="date" name="tdate" class="form-control" required placeholder="วันที่นัด">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2">เวลาที่นัด</label>
                                            <div class="col-sm-4">
                                                <input type="time" name="ttime" class="form-control" required placeholder="เวลาที่นัด">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2"></label>
                                            <div class="col-sm-4">
                                                <button type="submit" class="btn btn-primary">เพิ่มข้อมูล</button>
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
                                //เช็ค inputที่ส่งมา
                                // echo '<pre>';
                                // print_r($_POST);
                                // exit;
                                // isset($_POST['username']) && 

                                if(isset($_POST['tmid']) &&isset($_POST['tappointment']) && isset($_POST['tadvice']) 
                                && isset($_POST['tdate']) && isset($_POST['ttime'])) {

                                    // echo 'ถูกเงื่อนไข ส่งข้อมูลมาได้';
                                    // // ประกาศตัวแปรรับ่าจากฟอร์ม
                                    // // $username =$_POST['username'];
                                    // // $password =sha1($_POST['password']);
                                    // exit;
                                    $tmid =$_POST['tmid'];
                                    $tappointment = $_POST['tappointment'];
                                    $tadvice = $_POST['tadvice'];
                                    $tdate =$_POST['tdate'];
                                    $ttime =$_POST['ttime'];
                                    
                                    //sql insert
                                    $stmtInserAppointment = $condb->prepare("INSERT INTO tb_appointment
                                    (
                                        -- username,
                                        -- password,
                                        tmid,
                                        tappointment, 
                                        tadvice,
                                        tdate,
                                        ttime

                                    )
                                    VALUES 
                                    (
                                        -- :username,
                                        -- '$password',
                                        :tmid,
                                        :tappointment, 
                                        :tadvice,
                                        :tdate,
                                        :ttime

                                    )
                                    ");

                                    //bindParam
                                    // $stmtInserAppointment->bindParam(':username', $username, PDO::PARAM_STR);
                                    $stmtInserAppointment->bindParam(':tmid', $tmid, PDO::PARAM_STR);
                                    $stmtInserAppointment->bindParam(':tappointment', $tappointment, PDO::PARAM_STR);
                                    $stmtInserAppointment->bindParam(':tadvice', $tadvice, PDO::PARAM_STR);
                                    $stmtInserAppointment->bindParam(':tdate', $tdate, PDO::PARAM_STR);
                                    $stmtInserAppointment->bindParam(':ttime', $ttime, PDO::PARAM_STR);
                                    $result = $stmtInserAppointment->execute();

                                    $condb = null; //close connect db
                                    if ($result) {
                                        echo '<script>
                                                setTimeout(function() {
                                                swal({
                                                    title: "เพิ่มข้อมูลสำเร็จ",
                                                    type: "success"
                                                }, function() {
                                                    window.location = "appointment.php"; //หน้าที่ต้องการให้กระโดดไป
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
                                                    window.location = "appointment.php"; //หน้าที่ต้องการให้กระโดดไป
                                                });
                                                }, 1000);
                                            </script>';
                                    }
                                }//isset

                                ?>