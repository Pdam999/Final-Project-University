<?php
// คิวรี่ข้อมูลสมาชิก
$quryStudent = $condb->prepare("SELECT * FROM tb_student LIMIT 1000");
$quryStudent->execute();
$rsStudent = $quryStudent->fetchAll();

// ฟังก์ชันคำนวณอายุจากวันเกิด
function calculateAge($birthdate) {
    $birthdate = new DateTime($birthdate);
    $today = new DateTime('today');
    $age = $today->diff($birthdate)->y;
    return $age;
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ข้อมูลนักศึกษา
                        <a href="student.php?act=add" class="btn btn-primary">เพิ่มข้อมูล</a>
                    </h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr class="table-success">
                                        <th width="2%" class="text-center">No.</th>
                                        <th width="6%">รหัสนักศึกษา</th>
                                        <th width="9%">ชื่อ-นามสกุล</th>
                                        <th width="5%" class="text-center">เพศ</th>
                                        <th width="5%" class="text-center">วันเกิด</th>
                                        <th width="5%" class="text-center">อายุ</th>
                                        <th width="6%" class="text-center">เบอร์โทรศัพท์</th>
                                        <th width="15%" class="text-center">คณะ/สาขา</th>
                                        <th width="4%" class="text-center">แก้ไข</th>
                                        <th width="4%" class="text-center">ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 1; // start number
                                    foreach ($rsStudent as $row) { 
                                        $age = calculateAge($row['tbirthbate']);
                                    ?>
                                    <tr>
                                        <td align="center"> <?php echo $i++ ?></td>
                                        <td align="center"><?=$row['tcodestudent']?></td>
                                        <td><?=$row['title_name'].' '.$row['tname'].' '.$row['tsurname'];?></td>
                                        <td align="center"><?=$row['tsex']?></td>
                                        <td align="center"><?=$row['tbirthbate']?></td>
                                        <td align="center"><?=$age?></td>
                                        <td align="center"><?=$row['tphone']?></td>
                                        <td align="center"><?=$row['dname'].'/'.$row['dbranch']?></td>
                                        <td align="center"><a href="student.php?id=<?=$row['id'];?>&act=edit" class="btn btn-warning btn-sm">แก้ไข</a></td>
                                        <td align="center"><a href="student.php?id=<?=$row['id'];?>&act=delete" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบข้อมูล??');">ลบ</a></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
