<?php
include 'header.php';
include 'navbar.php';
include 'sidebar_menu.php';
include 'footer.php';
?>
<?php
// เชื่อมต่อฐานข้อมูล MySQL
$link = mysqli_connect("localhost", "root", "");
mysqli_select_db($link, "data_health");

$selectedYear1 = isset($_GET['year1']) ? $_GET['year1'] : date('Y');
// $selectedYear2 = isset($_GET['year2']) ? $_GET['year2'] : '';

$monthlyData1 = array();
// $monthlyData2 = array();

$res1 = mysqli_query($link, "SELECT MONTH(tdate) AS month, COUNT(*) AS total FROM tb_treatment WHERE YEAR(tdate) = $selectedYear1 GROUP BY MONTH(tdate)");
while ($row = mysqli_fetch_array($res1)) {
    $monthlyData1[] = array(
        "label" => date("F", mktime(0, 0, 0, $row["month"], 1)),
        "y" => $row["total"],
        "color" => "#4F81BC"
    );
}

// if ($selectedYear2 != '') {
//     $res2 = mysqli_query($link, "SELECT MONTH(tdate) AS month, COUNT(*) AS total FROM tb_treatment WHERE YEAR(tdate) = $selectedYear2 GROUP BY MONTH(tdate)");
//     while ($row = mysqli_fetch_array($res2)) {
//         $monthlyData2[] = array(
//             "label" => date("F", mktime(0, 0, 0, $row["month"], 1)),
//             "y" => $row["total"],
//             "color" => "#50C878"
//         );
//     }
// }

mysqli_close($link);
?>

<!DOCTYPE HTML>
<html>
<head>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<style>
    .year-form {
        margin-bottom: 20px;
    }
    .container {
        max-width: 1200px;
        margin: 0 auto;
    }
    .chart-container {
        margin-top: 50px;
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
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">ระบบบริหารจัดการสุขภาพและบริการอนามัยนักศึกษามหาวิทยาลัย</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>
                            <?php
                                // เตรียมคำสั่ง SQL
                                $sql = "SELECT COUNT(*) as users FROM tb_student";
                                $query = $condb->prepare($sql);
                                // ดำเนินการคำสั่ง SQL
                                $query->execute();
                                // ดึงข้อมูลที่ได้จากการดำเนินการ
                                $fetch = $query->fetch(); 
                                // แสดงจำนวนผู้ใช้ พร้อมใส่ลูกน้ำ
                                echo number_format($fetch['users']);
                            ?>
                            </h3>
                            <p>ข้อมูลนักศึกษา</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="student.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>
                            <?php
                                // แสดงจำนวนการเข้ารักษาตามปีที่เลือกในฟอร์ม
                                $sql = "SELECT COUNT(*) as treatments FROM tb_treatment WHERE YEAR(tdate) = ?";
                                $query = $condb->prepare($sql);
                                $query->execute([$selectedYear1]);
                                $fetch = $query->fetch(); 
                                echo number_format($fetch['treatments']);
                            ?>
                            </h3>
                            <p>การเข้ารักษาในปี <?php echo $selectedYear1; ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-archive"></i>
                        </div>
                        <a href="treatment.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>
                            <?php
                                $sql = "SELECT COUNT(*) as appointments FROM tb_appointment";
                                $query = $condb->prepare($sql);
                                $query->execute();
                                $fetch = $query->fetch(); 
                                echo $fetch['appointments'];
                            ?>
                            </h3>
                            <p>การนัดหมาย</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-calendar"></i>
                        </div>
                        <a href="appointment.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- ./col -->
                <!-- <div class="col-lg-3 col-6"> -->
                    <!-- small box -->
                    <!-- <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?php
                            $sql = "SELECT COUNT(*) as treatments FROM tb_treatment";
                            $query = $condb->prepare($sql);
                            $query->execute();
                            $fetch = $query->fetch(); 
                            echo $fetch['treatments'];
                        ?></h3>
                        <p>กราฟรายงานผล</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="dashboard.php" class="small-box-footer">สถิติการเข้ารักษา <i class="fas fa-arrow-circle-right"></i></a>
                    <a href="dashboard2.php" class="small-box-footer">สถิติอาการป่วย <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div> -->
                <!-- ./col -->

            </div>
            <!-- /.row -->
            <div class="container">

                <!-- Form for selecting years -->
                <form class="year-form" action="" method="GET">
                    <label for="year1">เลือกปีที่ต้องการแสดงข้อมูล:</label>
                    <select id="year1" name="year1">
                        <?php
                            $currentYear = date("Y");
                            for ($i = $currentYear; $i >= $currentYear - 10; $i--) {
                                $selected = (isset($_GET['year1']) && $_GET['year1'] == $i) ? "selected" : "";
                                echo "<option value=\"$i\" $selected>$i</option>";
                            }
                        ?>
                    </select>

                    <!-- <label for="year2">เลือกปีที่ต้องการแสดงข้อมูลปีที่ 2:</label>
                    <select id="year2" name="year2">
                        <option value="">-- เลือกปี --</option>
                        <?php
                            for ($i = $currentYear; $i >= $currentYear - 10; $i--) {
                                $selected = (isset($_GET['year2']) && $_GET['year2'] == $i) ? "selected" : "";
                                echo "<option value=\"$i\" $selected>$i</option>";
                            }
                        ?>
                    </select>
                     -->
                    <button type="submit" class="btn btn-primary">แสดงข้อมูล</button>
                </form>
                
                <!-- Chart Container -->
                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
            </div>

            <div class="chart-container">
                <!-- Chart Container -->
                <div id="facultyChart" style="height: 370px; width: 100%;"></div>
                <!-- Chart Container -->
                <div id="genderChart" style="height: 370px; width: 100%;"></div>
                <!-- Chart Container -->
                <div id="treatmentTable" style="height: 370px; width: 100%;"></div>
            </div>

<div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>
                                <?php
                                    $sql = "SELECT COUNT(*) as treatments FROM tb_treatment WHERE YEAR(tdate) = ?";
                                    $query = $condb->prepare($sql);
                                    $query->execute([$selectedYear1]);
                                    $fetch = $query->fetch();
                                    echo number_format ($fetch['treatments']);
                                ?>
                            </h3>
                            <p>การเข้ารักษาในปี <?php echo $selectedYear1; ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-archive"></i>
                        </div>
                        <a href="treatment.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Chart scripts -->
                <script>
                    window.onload = function() {
                        var chart = new CanvasJS.Chart("chartContainer", {
                            animationEnabled: true,
                            title: {
                                text: "จำนวนการเข้ารักษาต่อเดือน"
                            },
                            axisY: {
                                title: "จำนวนการเข้ารักษา"
                            },
                            data: [
                                {
                                    type: "spline",
                                    name: "ปี <?php echo $selectedYear1; ?>",
                                    showInLegend: true,
                                    dataPoints: <?php echo json_encode($monthlyData1, JSON_NUMERIC_CHECK); ?>
                                },
                                <?php if (!empty($monthlyData2)) { ?>
                                {
                                    type: "spline",
                                    name: "ปี <?php echo $selectedYear2; ?>",
                                    showInLegend: true,
                                    dataPoints: <?php echo json_encode($monthlyData2, JSON_NUMERIC_CHECK); ?>
                                }
                                <?php } ?>
                            ]
                        });
                        chart.render();
                    }
                </script>
                
                <!-- Additional chart and table scripts -->
                <script>
                    window.onload = function() {
                        // แสดงแผนภูมิ Column Chart ของจำนวนนักเรียนแต่ละคณะ
                        var facultyChart = new CanvasJS.Chart("facultyChart", {
                            animationEnabled: true,
                            title: {
                                text: "จำนวนนักศึกษาแยกตามคณะ"
                            },
                            data: [{
                                type: "column",
                                dataPoints: [
                                    <?php
                                    // ดึงข้อมูลจำนวนนักเรียนและคณะ
                                    $result = mysqli_query($link, "SELECT dname, COUNT(*) AS count FROM tb_student GROUP BY dname");

                                    // เก็บข้อมูลไว้ใน array เพื่อเรียงลำดับ
                                    $facultyData = array();
                                    while($row = mysqli_fetch_assoc($result)) {
                                        $facultyData[$row['dname']] = $row['count'];
                                    }

                                    // เรียงลำดับ array ตามจำนวนนักเรียนจากมากไปน้อย
                                    arsort($facultyData);

                                    // วนลูปเพื่อสร้างข้อมูลสำหรับ Column Chart
                                    foreach($facultyData as $dname => $count) {
                                        echo "{ label: '{$dname}', y: {$count} },";
                                    }
                                    ?>
                                ]
                            }]
                        });
                        facultyChart.render();

                        // แสดงแผนภูมิ Pie Chart ของจำนวนนักเรียนแต่ละเพศ
                        var genderChart = new CanvasJS.Chart("genderChart", {
                            animationEnabled: true,
                            title: {
                                text: "จำนวนนักศึกษาแยกตามเพศ"
                            },
                            data: [{
                                type: "pie",
                                startAngle: 100,
                                yValueFormatString: "##0 คน",
                                indexLabel: "{label} {y}",
                                dataPoints: [
                                <?php
                                // ดึงข้อมูลจำนวนนักเรียนและเพศ
                                $result = mysqli_query($link, "SELECT tsex, COUNT(*) AS count FROM tb_student GROUP BY tsex");

                                // วนลูปเพื่อสร้างข้อมูลสำหรับ Pie Chart
                                while($row = mysqli_fetch_assoc($result)) {
                                    $color = ($row['tsex'] == 'ชาย') ? "#007bff" : "#ff69b4"; // เลือกสีตามเพศ
                                    echo "{ label: '{$row['tsex']}', y: {$row['count']}, color: '{$color}' },";
                                }
                                ?>
                                ]
                            }]
                        });
                        genderChart.render();
                    }
                </script>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
</body>
</html>
