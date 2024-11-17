<!DOCTYPE HTML>
<html>
<head>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<style>
    #chartContainer {
        width: auto;
        height: 400px;
    }
</style>
</head>
<body>
<div class="container">
    <form action="" method="GET">
        <label for="year">เลือกปี:</label>
        <select id="year" name="year">
            <?php
            // เชื่อมต่อฐานข้อมูล MySQL
            $link = mysqli_connect("localhost", "root", "", "data_health");

            if (!$link) {
                die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . mysqli_connect_error());
            }

            // ดึงข้อมูลปีที่มีข้อมูลอยู่จากฐานข้อมูล
            $res = mysqli_query($link, "SELECT DISTINCT YEAR(tdate) AS year FROM tb_treatment ORDER BY year DESC");

            while ($row = mysqli_fetch_array($res)) {
                $selected = (isset($_GET['year']) && $_GET['year'] == $row['year']) ? "selected" : "";
                echo "<option value=\"" . $row['year'] . "\" $selected>" . $row['year'] . "</option>";
            }
            ?>
        </select>

        <label for="month">เลือกเดือน:</label>
        <select id="month" name="month">
            <?php
            // ดึงข้อมูลเดือนที่มีข้อมูลอยู่จากฐานข้อมูล
            $res = mysqli_query($link, "SELECT DISTINCT MONTH(tdate) AS month FROM tb_treatment ORDER BY month");

            while ($row = mysqli_fetch_array($res)) {
                $monthName = date("F", mktime(0, 0, 0, $row['month'], 1));
                $selected = (isset($_GET['month']) && $_GET['month'] == $row['month']) ? "selected" : "";
                echo "<option value=\"" . $row['month'] . "\" $selected>" . $monthName . "</option>";
            }
            ?>
        </select>

        <button type="submit" class="btn btn-primary">แสดงข้อมูล</button>
    </form>

    <?php
    // ตรวจสอบการส่งค่าปีและเดือนมาจากฟอร์ม
    $selectedYear = isset($_GET['year']) ? $_GET['year'] : date('Y');
    $selectedMonth = isset($_GET['month']) ? $_GET['month'] : date('n');

    // ดึงข้อมูลจากฐานข้อมูล
    $sql = "SELECT tsymptom, COUNT(*) AS count FROM tb_treatment WHERE YEAR(tdate) = $selectedYear";
    if (!empty($selectedMonth)) {
        $sql .= " AND MONTH(tdate) = $selectedMonth";
    }
    $sql .= " GROUP BY tsymptom";
    $res = mysqli_query($link, $sql);

    // สร้างอาร์เรย์สำหรับเก็บข้อมูล
    $dataPoints = array();

    // นำข้อมูลเข้าอาร์เรย์
    while ($row = mysqli_fetch_array($res)) {
        $dataPoints[] = array("label" => $row['tsymptom'], "y" => $row['count']);
    }
    ?>

    <div id="chartContainer"></div>

    <?php
    // ดึงชื่อของเดือนจากเลขของเดือน
    $monthNames = array(
        1 => "มกราคม",
        2 => "กุมภาพันธ์",
        3 => "มีนาคม",
        4 => "เมษายน",
        5 => "พฤษภาคม",
        6 => "มิถุนายน",
        7 => "กรกฎาคม",
        8 => "สิงหาคม",
        9 => "กันยายน",
        10 => "ตุลาคม",
        11 => "พฤศจิกายน",
        12 => "ธันวาคม"
    );

    mysqli_close($link);
    ?>
    
    <script>
    window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            title: {
                text: "สถิติอาการป่วย <?php echo $selectedYear; ?> <?php echo $monthNames[$selectedMonth]; ?>"
            },
            data: [{
                type: "pie",
                startAngle: 100,
                yValueFormatString: "##0",
                indexLabel: "{label} {y}",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
    }
    </script>

    <?php
    // ดึงข้อมูลจากฐานข้อมูลอีกครั้งเพื่อแสดงในตาราง
    $link = mysqli_connect("localhost", "root", "", "data_health");

    $sql = "SELECT tsymptom, COUNT(*) AS count FROM tb_treatment WHERE YEAR(tdate) = $selectedYear";
    if (!empty($selectedMonth)) {
        $sql .= " AND MONTH(tdate) = $selectedMonth";
    }
    $sql .= " GROUP BY tsymptom ORDER BY count DESC";
    $res = mysqli_query($link, $sql);
    ?>
    
    <div class="chart-table">
        <table id="example1" class="table table-bordered table-striped table-sm">
            <thead>
                <tr class="table-success">
                    <th>อาการ</th>
                    <th>จำนวนครั้ง</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($res)) {
                    echo "<tr>";
                    echo "<td>" . $row['tsymptom'] . "</td>";
                    echo "<td>" . $row['count'] . "</td>";
                    echo "</tr>";
                }
                mysqli_close($link);
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
