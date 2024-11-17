<!DOCTYPE HTML>
<html>
<head>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<style>
    .year-form {
        margin-bottom: 130px;
    }
</style>
</head>
<body>
<div class="container">
    <form class="year-form" action="" method="GET">
        <label for="year1">เลือกปีที่ต้องการแสดงข้อมูลปีที่ 1:</label>
        <select id="year1" name="year1">
            <?php
                $currentYear = date("Y");
                for ($i = $currentYear; $i >= $currentYear - 10; $i--) {
                    $selected = (isset($_GET['year1']) && $_GET['year1'] == $i) ? "selected" : "";
                    echo "<option value=\"$i\" $selected>$i</option>";
                }
            ?>
        </select>

        <label for="year2">เลือกปีที่ต้องการแสดงข้อมูลปีที่ 2:</label>
        <select id="year2" name="year2">
            <option value="">-- เลือกปี --</option>
            <?php
                for ($i = $currentYear; $i >= $currentYear - 10; $i--) {
                    $selected = (isset($_GET['year2']) && $_GET['year2'] == $i) ? "selected" : "";
                    echo "<option value=\"$i\" $selected>$i</option>";
                }
            ?>
        </select>
        
        <button type="submit" class="btn btn-primary">แสดงข้อมูล</button>
    </form>

    <?php
        $selectedYear1 = isset($_GET['year1']) ? $_GET['year1'] : date('Y');
        $selectedYear2 = isset($_GET['year2']) ? $_GET['year2'] : '';

        $link = mysqli_connect("localhost", "root", "", "data_health");
        if (!$link) {
            die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . mysqli_connect_error());
        }

        $monthlyData1 = array();
        $monthlyData2 = array();

        $res1 = mysqli_query($link, "SELECT MONTH(tdate) AS month, COUNT(*) AS total FROM tb_treatment WHERE YEAR(tdate) = $selectedYear1 GROUP BY MONTH(tdate)");
        while ($row = mysqli_fetch_array($res1)) {
            $monthlyData1[] = array(
                "label" => date("F", mktime(0, 0, 0, $row["month"], 1)),
                "y" => $row["total"],
                "color" => "#4F81BC"
            );
        }

        if ($selectedYear2 != '') {
            $res2 = mysqli_query($link, "SELECT MONTH(tdate) AS month, COUNT(*) AS total FROM tb_treatment WHERE YEAR(tdate) = $selectedYear2 GROUP BY MONTH(tdate)");
            while ($row = mysqli_fetch_array($res2)) {
                $monthlyData2[] = array(
                    "label" => date("F", mktime(0, 0, 0, $row["month"], 1)),
                    "y" => $row["total"],
                    "color" => "#50C878"
                );
            }
        }

        mysqli_close($link);
    ?>

    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    <script>
        window.onload = function () {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2",
                title: {
                    text: "สถิติการเข้ารักษา ปี <?php echo $selectedYear1; ?> <?php echo $selectedYear2 != '' ? '/ ' . $selectedYear2 : ''; ?>"
                },
                axisX: {
                    title: "เดือน",
                    interval: 1
                },
                axisY: {
                    title: "จำนวนผู้เข้ารักษา",
                    includeZero: true
                },
                data: [{
                    type: "spline",
                    name: "<?php echo $selectedYear1; ?>",
                    showInLegend: true,
                    dataPoints: <?php echo json_encode($monthlyData1, JSON_NUMERIC_CHECK); ?>
                },
                <?php if ($selectedYear2 != ''): ?>
                {
                    type: "spline",
                    name: "<?php echo $selectedYear2; ?>",
                    showInLegend: true,
                    dataPoints: <?php echo json_encode($monthlyData2, JSON_NUMERIC_CHECK); ?>
                }
                <?php endif; ?>
                ]
            });

            chart.render();
        }
    </script>

</div>
</body>
</html>
