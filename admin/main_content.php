<?php
// เชื่อมต่อฐานข้อมูล MySQL
$link = mysqli_connect("localhost", "root", "", "data_health");

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

// รับปีที่เลือกจาก GET parameter
$selectedYear1 = isset($_GET['year1']) ? $_GET['year1'] : date('Y');

// สร้างอาร์เรย์สำหรับข้อมูลรายเดือน
$monthlyData1 = array();

// ดึงข้อมูลการรักษารายเดือนจากฐานข้อมูล
$query1 = $link->prepare("SELECT MONTH(tdate) AS month, COUNT(*) AS total FROM tb_treatment WHERE YEAR(tdate) = ? GROUP BY MONTH(tdate)");
$query1->bind_param("i", $selectedYear1);
$query1->execute();
$result1 = $query1->get_result();

while ($row = $result1->fetch_assoc()) {
    $monthlyData1[] = array(
        "label" => date("F", mktime(0, 0, 0, $row["month"], 1)),
        "y" => $row["total"],
        "color" => "#4F81BC"
    );
}

$query1->close();

// ฟังก์ชันสำหรับดึงจำนวนข้อมูลในตาราง
function getCount($link, $table) {
    $sql = "SELECT COUNT(*) as count FROM $table";
    $query = $link->prepare($sql);
    $query->execute();
    $fetch = $query->get_result()->fetch_assoc();
    $query->close();
    return $fetch['count'];
}

$totalStudents = getCount($link, "tb_student");
$totalAppointments = getCount($link, "tb_appointment");

// ดึงจำนวนการเข้ารักษาตามปีที่เลือก
$query2 = $link->prepare("SELECT COUNT(*) as count FROM tb_treatment WHERE YEAR(tdate) = ?");
$query2->bind_param("i", $selectedYear1);
$query2->execute();
$fetch2 = $query2->get_result()->fetch_assoc();
$totalTreatments = $fetch2['count'];
$query2->close();

// ดึงข้อมูลเพศของนักศึกษาในปีที่เลือก
$maleCount = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(*) AS count FROM tb_student INNER JOIN tb_treatment ON tb_student.tcodestudent = tb_treatment.tcodestudent WHERE tsex = 'ชาย' AND YEAR(tb_treatment.tdate) = $selectedYear1"))['count'];
$femaleCount = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(*) AS count FROM tb_student INNER JOIN tb_treatment ON tb_student.tcodestudent = tb_treatment.tcodestudent WHERE tsex = 'หญิง' AND YEAR(tb_treatment.tdate) = $selectedYear1"))['count'];
$otherCount = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(*) AS count FROM tb_student INNER JOIN tb_treatment ON tb_student.tcodestudent = tb_treatment.tcodestudent WHERE tsex NOT IN ('ชาย', 'หญิง') AND YEAR(tb_treatment.tdate) = $selectedYear1"))['count'];

// ดึงข้อมูลนักศึกษาแยกตามคณะ
$facultyData = array();
$selstm = "SELECT tb_student.dname as dname, COUNT(*) AS count FROM tb_treatment 
        INNER JOIN tb_student ON tb_treatment.tcodestudent = tb_student.tcodestudent 
        WHERE YEAR(tdate) = ? GROUP BY tb_student.dname";
$query = $link->prepare($selstm);
$query->bind_param("i", $selectedYear1);
$query->execute();
$result = $query->get_result();

while($row = $result->fetch_assoc()) {
    $facultyData[$row['dname']] = $row['count'];
}

$query->close();
$link->close();
arsort($facultyData);
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">ระบบบริหารจัดการสุขภาพและบริการอนามัยนักศึกษามหาวิทยาลัย</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right"></ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo number_format($totalStudents); ?></h3>
                            <p>ข้อมูลนักศึกษา</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="student.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo number_format($totalTreatments); ?></h3>
                            <p>การเข้ารักษา <?php echo $selectedYear1; ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-archive"></i>
                        </div>
                        <a href="treatment.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo number_format($totalAppointments); ?></h3>
                            <p>การนัดหมาย</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-calendar"></i>
                        </div>
                        <a href="appointment.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <form class="year-form" action="" method="GET">
                <label for="year1">เลือกปีที่ต้องการแสดงข้อมูลปีที่ 1:</label>
                <select id="year1" name="year1">
                    <?php
                    $currentYear = date("Y");
                    for ($i = $currentYear; $i >= $currentYear - 10; $i--) {
                        $selected = ($selectedYear1 == $i) ? "selected" : "";
                        echo "<option value=\"$i\" $selected>$i</option>";
                    }
                    ?>
                </select>
                <button type="submit" class="btn btn-primary">แสดงข้อมูล</button>
            </form>

            <div class="container">
                <!DOCTYPE HTML>
                <html>
                <head>
                    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
                    <style>
                        .container {
                            display: flex;
                            flex-direction: row;
                            justify-content: center;
                            align-items: center;
                        }
                        .chart-container {
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            width: 40%;
                        }
                        .chart-table {
                            margin-top: 20px;
                            border-collapse: collapse;
                            width: 90%;
                            margin-left: auto;
                            margin-right: auto;
                        }
                        .chart-table th, .chart-table td {
                            border: 1px solid #ddd;
                            padding: 8px;
                            text-align: left;
                        }
                        .chart-table th {
                            background-color: #f2f2f2;
                        }
                        .chart-table tr:nth-child(even) {
                            background-color: #f2f2f2;
                        }
                        .chart-table tr:hover {
                            background-color: #ddd;
                        }
                    </style>
                </head>
                <body>
                <div class="container">
                    <div class="chart-container">
                        <div id="facultyChart" style="height: 370px; width: 100%;"></div>
                        <div id="genderChart" style="height: 370px; width: 100%;"></div>
                    </div>
                    <div>
                        <div class="chart-table">
                            <table id="example1" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr class="table-success">
                                        <th width="20%">คณะ</th>
                                        <th width="2%">จำนวน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($facultyData as $dname => $count) {
                                        echo "<tr>";
                                        echo "<td>{$dname}</td>";
                                        echo "<td>{$count}</td>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <script>
                    window.onload = function() {
                        var facultyChart = new CanvasJS.Chart("facultyChart", {
                            animationEnabled: true,
                            title: {
                                text: "จำนวนการรักษาแยกตามคณะ"
                            },
                            data: [{
                                type: "column",
                                dataPoints: [
                                    <?php
                                    foreach($facultyData as $dname => $count) {
                                        echo "{ label: '{$dname}', y: {$count} },";
                                    }
                                    ?>
                                ]
                            }]
                        });
                        facultyChart.render();

                        var genderChart = new CanvasJS.Chart("genderChart", {
                            animationEnabled: true,
                            title: {
                                text: "จำนวนการรักษาแยกตามเพศ"
                            },
                            data: [{
                                type: "pie",
                                startAngle: 100,
                                yValueFormatString: "##0 คน",
                                indexLabel: "{label} {y}",
                                dataPoints: [
                                    { label: 'ชาย', y: <?php echo $maleCount; ?>, color: "#007bff" },
                                    { label: 'หญิง', y: <?php echo $femaleCount; ?>, color: "#ff69b4" },
                                    // { label: 'อื่น ๆ', y: <?php echo $otherCount; ?>, color: "#4F81BC" }
                                ]
                            }]
                        });
                        genderChart.render();
                    }
                </script>
                </body>
                </html>
            </div>
        </div>
    </section>
</div>
