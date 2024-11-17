<?php
//คิวรี่ข้อมูลสมาชิก
// $quryAppointment = $condb->prepare("SELECT * tcodestudent FROM tb_appointment order by tdate DESC,ttime");
$selstm="SELECT tb_appointment.*,tb_treatment.tcodestudent FROM `tb_appointment`  INNER JOIN tb_treatment ";
$selstm.="on tb_treatment.`tmid`=tb_appointment.tmid ORDER BY tdate DESC,ttime ;";
$quryAppointment = $condb->prepare($selstm);
$quryAppointment->execute();
$rsAppointment = $quryAppointment->fetchAll();
//echo'<pre>';
//$quryAppointment->debugDumpParams();
//exit;
?>
    
    
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>ข้อมูลการนัดหมาย
                <a href="appointment.php?act=add" class="btn btn-primary">เพิ่มข้อมูล</a>
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
                        <!-- <th width="2%" class="text-center">No.</th> -->
                        <th width="5%">รหัสการรักษา</th>
                        <th width="5%" class="text-center">วันที่นัด</th>
                        <th width="5%" class="text-center">เวลาที่นัด</th>
                        <th width="5%">รหัสนักศึกษา</th>
                        <th width="15%" class="text-center">รายละเอียดการนัดตรวจ</th>
                        <th width="15%" class="text-center">คำแนะนำก่อนเข้าตรวจ</th>
                        <th width="5%" class="text-center">แก้ไข</th>
                        <th width="5%" class="text-center">ลบ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i = 1; //start number
                    foreach($rsAppointment as $row){ ?>
                    <tr>
                        <!-- <td align="center"> <?php echo $i++ ?></td> -->
                        <td align="center"><?=$row['tmid']?></td>
                        <td align="center"><?=$row['tdate']?></td>
                        <td align="center"><?=$row['ttime']?></td>
                        <td align="center"><?=$row['tcodestudent']?></td>
                        <td align="center"><?=$row['tappointment']?></td>
                        <td align="center"><?=$row['tadvice']?></td>
                        <td align="center"><a href="appointment.php?id=<?=$row['aid'];?>&act=edit" class="btn btn-warning btn-sm">แก้ไข</a></td>
                        <td align="center"><a href="appointment.php?id=<?=$row['aid'];?>&act=delete" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบข้อมูล??');" >ลบ</a>
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