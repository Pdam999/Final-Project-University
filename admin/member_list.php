<?php
//คิวรี่ข้อมูลสมาชิก
$quryMember = $condb->prepare("SELECT* FROM tbl_member");
$quryMember->execute();
$rsMember = $quryMember->fetchAll();
//echo'<pre>';
//$quryMember->debugDumpParams();
//exit;
?>
    
    
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>จัดการข้อมูลนักศึกษา
                <a href="member.php?act=add" class="btn btn-primary">เพิ่มข้อมูล</a>
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
                        <th width="5%" class="text-center">No.</th>
                        <th width="15%">ชื่อ-นามสกุล</th>
                        <th width="10%" class="text-center">คณะ/สาขา</th>
                        <th width="10%" class="text-center">เบอร์โทรศัท์</th>
                        <th width="5%" class="text-center">เวลา</th>
                        <th width="10%" class="text-center">อาการป่วย</th>
                        <th width="10%" class="text-center">การรักษาพยาบาล</th>
                        <th width="10%" class="text-center">การจ่ายยา</th>
                        <th width="5%" class="text-center">แก้ไข</th>
                        <th width="5%" class="text-center">ลบ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i = 1; //start number
                    foreach($rsMember as $row){ ?>
                    <tr>
                        <td align="center"> <?php echo $i++ ?></td>
                        <td><?=$row['title_name'].' '.$row['name'].' '.$row['surname'];?></td>
                        <td align="center">
                        <td align="center">
                        <td align="center">
                        <td align="center">
                        <td align="center">
                        <td align="center">
                        <td align="center">
                            <a href="member.php?id=<?=$row['id'];?>&act=edit" class="btn btn-warning btn-sm">แก้ไข</a></td>
                        <td align="center">
                            <a href="member.php?id=<?=$row['id'];?>&act=delete" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบข้อมูล??');" >ลบ</a>
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