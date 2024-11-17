<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตรวจสอบรหัสนักศึกษา</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>ตรวจสอบรหัสนักศึกษา</h1>
        <form action="" method="post">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">รหัสนักศึกษา</label>
                <div class="col-sm-4">
                    <input type="text" name="tcodestudent" class="form-control" required placeholder="กรอกรหัสนักศึกษา">
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary">ตรวจสอบ</button>
                    <a href="treatment.php" class="btn btn-danger">ยกเลิก</a>
                </div>
            </div>
        </form>
        <?php
        try {
            $condb = new PDO('mysql:host=localhost;dbname=data_health', 'root', '');
            $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit();
        }

        if (isset($_POST['tcodestudent'])) {
            $student_id = $_POST['tcodestudent'];
            $stmtCheckStudent = $condb->prepare("SELECT * FROM tb_student WHERE tcodestudent = :student_id");
            $stmtCheckStudent->bindParam(':student_id', $student_id, PDO::PARAM_STR);
            $stmtCheckStudent->execute();
            $row = $stmtCheckStudent->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                // echo '<div class="mt-4">';
                echo '<h3 class="mt-2">ข้อมูลนักศึกษา</h3>';
                echo '<table class="table table-bordered">';
                echo '<tr><th>รหัสนักศึกษา</th><td>' . htmlspecialchars($student_id) . '</td></tr>';
                echo '<tr><th>ชื่อ</th><td>' . htmlspecialchars($row['title_name'] . ' ' . $row['tname'] . ' ' . $row['tsurname']) . '</td></tr>';
                echo '<tr><th>สาขา</th><td>' . htmlspecialchars($row['dbranch']) . '</td></tr>';
                echo '<tr><th>คณะ</th><td>' . htmlspecialchars($row['dname']) . '</td></tr>';
                echo '</table>';
                // echo '</div>';

                echo '<h3 class="mt-2">เพิ่มข้อมูลการรักษา</h3>';
                echo '<form action="" method="post">';
                echo '<div class="form-group row">';
                // echo '<label class="col-sm-2 col-form-label">รหัสนักศึกษา</label>';
                echo '<div class="col-sm-4">';
                // echo '<input type="text" name="tcodestudent" class="form-control" value="'.$student_id.'" disabled="disabled">';
                echo '<input type="hidden" name="tcodestudent" value="'.$student_id.'">';
                echo '</div>';
                echo '</div>';
                echo '<div class="form-group row">';
                echo '<label class="col-sm-2 col-form-label">ส่วนสูง(ซ.ม.)</label>';
                echo '<div class="col-sm-4">';
                echo '<input type="text" name="theight" class="form-control" required placeholder="ส่วนสูง">';
                
                echo '</div>';
                echo '</div>';
                echo '<div class="form-group row">';
                echo '<label class="col-sm-2 col-form-label">น้ำหนัก(ก.ม.)</label>';
                echo '<div class="col-sm-4">';
                echo '<input type="text" name="tweight" class="form-control" required placeholder="น้ำหนัก">';
                echo '</div>';
                echo '</div>';
                echo '<div class="form-group row">';
                echo '<label class="col-sm-2 col-form-label">อาการ</label>';
                echo '<div class="col-sm-4">';
                echo '<input type="text" name="tsymptom" class="form-control" required placeholder="อาการ">';
                echo '</div>';
                echo '</div>';
                echo '<div class="form-group row">';
                echo '<label class="col-sm-2 col-form-label">วิธีการรักษา</label>';
                echo '<div class="col-sm-4">';
                echo '<input type="text" name="dhealth" class="form-control" required placeholder="วิธีการรักษา">';
                echo '</div>';
                echo '</div>';
                echo '<div class="form-group row">';
                echo '<label class="col-sm-2 col-form-label">การจ่ายยา</label>';
                echo '<div class="col-sm-4">';
                echo '<input type="text" name="bdrug" class="form-control" placeholder="การจ่ายยา">';
                echo '</div>';
                echo '</div>';
                echo '<div class="form-group row">';
                echo '<label class="col-sm-2 col-form-label">ประวัติแพ้ยา</label>';
                echo '<div class="col-sm-4">';
                echo '<input type="text" name="tdrug" class="form-control" placeholder="ประวัติแพ้ยา">';
                echo '</div>';
                echo '</div>';
                echo '<div class="form-group row">';
                echo '<label class="col-sm-2 col-form-label">โรคประจำตัว</label>';
                echo '<div class="col-sm-4">';
                echo '<input type="text" name="tcd" class="form-control" placeholder="โรคประจำตัว">';
                echo '</div>';
                echo '</div>';
                echo '<div class="form-group row">';
                echo '<label class="col-sm-2 col-form-label">วันที่การรักษา</label>';
                echo '<div class="col-sm-4">';
                echo '<input type="date" name="tdate" class="form-control" required>';
                echo '</div>';
                echo '</div>';
                echo '<div class="form-group row">';
                echo '<label class="col-sm-2 col-form-label">เวลารักษา</label>';
                echo '<div class="col-sm-4">';
                echo '<input type="time" name="ttime" class="form-control" required>';
                echo '</div>';
                echo '</div>';
                echo '<div class="form-group row">';
                echo '<div class="col-sm-2"></div>';
                echo '<div class="col-sm-4">';
                echo '<button type="submit" class="btn btn-primary">เพิ่มข้อมูล</button>';
                echo '</div>';
                echo '</div>';
                echo '</form>';
            } else {
                echo '<script>
                    setTimeout(function() {
                        Swal.fire({
                            title: "รหัสนักศึกษาไม่ถูกต้อง",
                            icon: "error"
                        }).then(function() {
                            window.location = "treatment.php"; // หน้าที่ต้องการให้กระโดดไป
                        });
                    }, 1000);
                </script>';
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['theight']) && !empty($_POST['tweight']) && !empty($_POST['tsymptom']) && !empty($_POST['dhealth']) && !empty($_POST['tdate']) && !empty($_POST['ttime'])) {
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

            $stmtInserTreatment = $condb->prepare("INSERT INTO tb_treatment
            (
                tcodestudent,
                theight,
                tweight, 
                tsymptom,
                dhealth,
                bdrug,
                tdrug,
                tcd,
                tdate,
                ttime
            )
            VALUES 
            (
                :tcodestudent,
                :theight,
                :tweight, 
                :tsymptom,
                :dhealth,
                :bdrug,
                :tdrug,
                :tcd,
                :tdate,
                :ttime
            )");

            $stmtInserTreatment->bindParam(':tcodestudent', $tcodestudent, PDO::PARAM_STR);
            $stmtInserTreatment->bindParam(':theight', $theight, PDO::PARAM_INT);
            $stmtInserTreatment->bindParam(':tweight', $tweight, PDO::PARAM_INT);
            $stmtInserTreatment->bindParam(':tsymptom', $tsymptom, PDO::PARAM_STR);
            $stmtInserTreatment->bindParam(':dhealth', $dhealth, PDO::PARAM_STR);
            $stmtInserTreatment->bindParam(':bdrug', $bdrug, PDO::PARAM_STR);
            $stmtInserTreatment->bindParam(':tdrug', $tdrug, PDO::PARAM_STR);
            $stmtInserTreatment->bindParam(':tcd', $tcd, PDO::PARAM_STR);
            $stmtInserTreatment->bindParam(':tdate', $tdate, PDO::PARAM_STR);
            $stmtInserTreatment->bindParam(':ttime', $ttime, PDO::PARAM_STR);
            $result = $stmtInserTreatment->execute();

            $condb = null;
            if ($result) {
                echo '<script>
                    setTimeout(function() {
                        Swal.fire({
                            title: "เพิ่มข้อมูลสำเร็จ",
                            icon: "success"
                        }).then(function() {
                            window.location = "treatment.php"; // หน้าที่ต้องการให้กระโดดไป
                        });
                    }, 1000);
                </script>';
            } else {
                echo '<script>
                    setTimeout(function() {
                        Swal.fire({
                            title: "เกิดข้อผิดพลาด",
                            icon: "error"
                        }).then(function() {
                            window.location = "treatment.php"; // หน้าที่ต้องการให้กระโดดไป
                        });
                    }, 1000);
                </script>';
            }
        }
        ?>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
