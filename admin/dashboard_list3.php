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
            $link = mysqli_connect("localhost", "root", "", "data_health");

            if (!$link) {
                die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . mysqli_connect_error());
            }

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
    $selectedYear = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');
    $selectedMonth = isset($_GET['month']) ? (int)$_GET['month'] : date('n');

    $stmt = $link->prepare("SELECT bdrug, COUNT(*) AS count FROM tb_treatment WHERE YEAR(tdate) = ? AND MONTH(tdate) = ? AND bdrug IS NOT NULL AND bdrug != '' GROUP BY bdrug");
    if (!empty($selectedMonth)) {
        $stmt->bind_param("ii", $selectedYear, $selectedMonth);
    } else {
        $stmt->bind_param("i", $selectedYear);
    }
    $stmt->execute();
    $res = $stmt->get_result();

    $dataPoints = array();

    while ($row = mysqli_fetch_array($res)) {
        if (!empty($row['bdrug'])) {
            $dataPoints[] = array("label" => $row['bdrug'], "y" => $row['count']);
        }
    }

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
    
    <div id="chartContainer"></div>

    <script>
    window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            title: {
                text: "สถิติยาที่จ่ายให้นักศึกษา <?php echo $selectedYear; ?> <?php echo $monthNames[$selectedMonth]; ?>"
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
    $link = mysqli_connect("localhost", "root", "", "data_health");

    $stmt = $link->prepare("SELECT bdrug, COUNT(*) AS count FROM tb_treatment WHERE YEAR(tdate) = ? AND MONTH(tdate) = ? AND bdrug IS NOT NULL AND bdrug != '' GROUP BY bdrug ORDER BY count DESC");
    if (!empty($selectedMonth)) {
        $stmt->bind_param("ii", $selectedYear, $selectedMonth);
    } else {
        $stmt->bind_param("i", $selectedYear);
    }
    $stmt->execute();
    $res = $stmt->get_result();
    ?>
    
    <div class="chart-table">
        <table id="example1" class="table table-bordered table-striped table-sm">
            <thead>
                <tr class="table-success">
                    <th>ชื่อยา</th>
                    <th>จำนวนครั้งที่จ่ายยา</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($res)) {
                    if (!empty($row['bdrug'])) {
                        echo "<tr>";
                        echo "<td>" . $row['bdrug'] . "</td>";
                        echo "<td>" . $row['count'] . "</td>";
                        echo "</tr>";
                    }
                }
                mysqli_close($link);
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
