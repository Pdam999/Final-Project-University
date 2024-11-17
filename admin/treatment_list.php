<?php
//คิวรี่ข้อมูลสมาชิก
// $quryTreatment = $condb->prepare("SELECT* FROM tb_treatment order by tdate DESC,ttime  ");
$selst="SELECT tb_treatment.*,tb_student.title_name,tb_student.tname,tb_student.tsurname from tb_treatment inner join tb_student "; 
$selst.="on tb_treatment.tcodestudent=tb_student.tcodestudent order by tb_treatment.tdate DESC,tb_treatment.ttime  LIMIT 3000 ;";
$quryTreatment = $condb->prepare($selst);
$quryTreatment->execute();
$rsTreatment = $quryTreatment->fetchAll();
//echo'<pre>';
//$quryTreatment->debugDumpParams();
//exit;
?>
    
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>ข้อมูลการเข้ารักษา
                <a href="treatment.php?act=add" class="btn btn-primary">เพิ่มข้อมูล</a>
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
                    <table id="example1" class="table table-bordered table-striped table-sm" >
                    <thead>
                    <tr class="table-success">
                        <th width="4%" class="text-center">รหัสรักษา</th>
                        <th width="8%" class="text-center">วันที่การรักษา</th>
                        <th width="8%" class="text-center">เวลารักษา</th>
                        <th width="5%" class="text-center">รหัสนักศึกษา</th>
                        <th width="10%" class="text-center">ชื่อ-นามสกุล</th>
                        <th width="7%" class="text-center">ส่วนสูง/นน.</th>
                        <th width="10%" class="text-center">อาการ</th>
                        <th width="10%" class="text-center">วิธีการรักษา</th>
                        <th width="10%" class="text-center">การจ่ายยา</th>
                        <th width="10%" class="text-center">ประวัติแพ้ยา</th>
                        <th width="10%" class="text-center">โรคประจำตัว</th>
                        <th width="5%" class="text-center">แก้ไข</th>
                        <th width="9%" class="text-center">นัดหมาย</th>
                        <th width="3%" class="text-center">ลบ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i = 1; //start number
                    foreach($rsTreatment as $row){ ?>
                    <tr>
                        <!-- <td align="center"> <?php echo $i++ ?></td> -->
                        <td align="center"><?=$row['tmid']?></td>
                        <td align="center"><?=$row['tdate']?></td>
                        <td align="center"><?=$row['ttime']?></td>
                        <td align="center"><?=$row['tcodestudent']?></td>
                        <td align="center"><?=$row['title_name'].$row['tname'].' '.$row['tsurname'];?></td>
                        <td align="center"><?=$row['theight'].'/'.$row['tweight'];?></td>
                        <td align="center"><?=$row['tsymptom']?></td>
                        <td align="center"><?=$row['dhealth']?></td>
                        <td align="center"><?=$row['bdrug']?></td>
                        <td align="center"><?=$row['tdrug']?></td>
                        <td align="center"><?=$row['tcd']?></td>
                        <td align="center"><a href="treatment.php?id=<?=$row['tmid'];?>&act=edit" class="btn btn-warning btn-sm">แก้ไข</a></td>
                        <td align="center"><a href="appointment.php?id=<?=$row['tmid'];?>&act=add" class="btn btn-success btn-sm">นัดหมาย</a></td>
                        <td align="center"><a href="treatment.php?id=<?=$row['tmid'];?>&act=delete" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบข้อมูล??');" >ลบ</a>
                        </td>
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