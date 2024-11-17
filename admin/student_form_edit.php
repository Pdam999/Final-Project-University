    <?php
    if (isset($_GET['id']) && $_GET['act'] == 'edit') {

        //sngle row query แสดงแค่ 1 รายการ
        $stmtMemberDetail = $condb->prepare("SELECT * FROM tb_student WHERE id=?");
        $stmtMemberDetail->execute([$_GET['id']]);
        $row = $stmtMemberDetail->fetch(PDO::FETCH_ASSOC);

        // echo '<pre>';
        // print_r($row);
        // exit;
        // echo $stmtMemberDetail->rowCount();
        // exit;

        //ถ้าคิวรี่ผิดพลาดให้หยุดการทำงาน
        if ($stmtMemberDetail->rowCount() != 1) {
            exit();
        }
    } //isset
    ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>แก้ไขข้อมูลนักศึกษา</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-body">
                            <div class="card card-primary">

                                <!-- form start -->
                                <form action="" method="post">
                                    <div class="card-body">

                                        <div class="form-group row">
                                            <label class="col-sm-2">รหัสนักศึกษา</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="tcodestudent" class="form-control" required value="<?= $row['tcodestudent'];?>" placeholder="รหัสนักศึกษา">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2">คำนำหน้า</label>
                                                <div class="col-sm-2">
                                                <select name="title_name" class="form-control" required value="<?= $row['title_name'];?>">
                                                    <option value="">-- เลือกข้อมูล --</option>
                                                    <option value="นาย" <?= $row['title_name'] == 'นาย' ? 'selected' : ''; ?>>-- นาย --</option>
                                                    <option value="นางสาว" <?= $row['title_name'] == 'นางสาว' ? 'selected' : ''; ?>>-- นางสาว --</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-sm-2">ชื่อ</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="tname" class="form-control" required value="<?= $row['tname'];?>" placeholder="ชื่อ">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2">นามสกุล</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="tsurname" class="form-control" required value="<?= $row['tsurname'];?>" placeholder="นามสกุล">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2">เพศ</label>
                                            <div class="col-sm-2">
                                                <select name="tsex" class="form-control" required value="<?= $row['tsex'];?>">
                                                    <option value="">-- เลือกข้อมูล --</option>
                                                    <option value="ชาย" <?= $row['tsex'] == 'ชาย' ? 'selected' : ''; ?>>-- ชาย --</option>
                                                    <option value="หญิง"<?= $row['tsex'] == 'หญิง' ? 'selected' : ''; ?>>-- หญิง --</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2">วันเกิด</label>
                                            <div class="col-sm-4">
                                                <input type="date" name="tbirthbate" class="form-control" required value="<?= $row['tbirthbate'];?>" placeholder="วันเกิด">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2">เบอร์โทรศัพท์</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="tphone" class="form-control" required value="<?= $row['tphone'];?>" placeholder="เบอร์โทศัพท์">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2">คณะ</label>
                                            <div class="col-sm-4">
                                            <select name="dname" class="form-control" required>
                                                    <option value="">-- เลือกคณะ --</option>
                                                    <option value="เทคโนโลยีการประมงและทรัพยากรทางน้ำ" <?= $row['dname'] == 'เทคโนโลยีการประมงและทรัพยากรทางน้ำ' ? 'selected' : ''; ?>>-- เทคโนโลยีการประมงและทรัพยากรทางน้ำ --</option>
                                                    <option value="เศรษฐศาสตร์" <?= $row['dname'] == 'เศรษฐศาสตร์' ? 'selected' : ''; ?>>-- เศรษฐศาสตร์ --</option>
                                                    <option value="บริหารธุรกิจ" <?= $row['dname'] == 'บริหารธุรกิจ' ? 'selected' : ''; ?>>-- บริหารธุรกิจ --</option>
                                                    <option value="ผลิตกรรมการเกษตร" <?= $row['dname'] == 'ผลิตกรรมการเกษตร' ? 'selected' : ''; ?>>-- ผลิตกรรมการเกษตร --</option>
                                                    <option value="พัฒนาการท่องเที่ยว" <?= $row['dname'] == 'พัฒนาการท่องเที่ยว' ? 'selected' : ''; ?>>-- พัฒนาการท่องเที่ยว --</option>
                                                    <option value="มหาวิทยาลัยแม่โจ้ - แพร่ เฉลิมพระเกียรติ" <?= $row['dname'] == 'มหาวิทยาลัยแม่โจ้ - แพร่ เฉลิมพระเกียรติ' ? 'selected' : ''; ?>>-- มหาวิทยาลัยแม่โจ้ - แพร่ เฉลิมพระเกียรติ --</option>
                                                    <option value="มหาวิทยาลัยแม่โจ้-ชุมพร" <?= $row['dname'] == 'มหาวิทยาลัยแม่โจ้-ชุมพร' ? 'selected' : ''; ?>>-- มหาวิทยาลัยแม่โจ้-ชุมพร --</option>
                                                    <option value="วิทยาลัยนานาชาติ" <?= $row['dname'] == 'วิทยาลัยนานาชาติ' ? 'selected' : ''; ?>>-- วิทยาลัยนานาชาติ --</option>
                                                    <option value="วิทยาลัยบริหารศาสตร์" <?= $row['dname'] == 'วิทยาลัยบริหารศาสตร์' ? 'selected' : ''; ?>>-- วิทยาลัยบริหารศาสตร์ --</option>
                                                    <option value="วิทยาลัยพลังงานทดแทน" <?= $row['dname'] == 'วิทยาลัยพลังงานทดแทน' ? 'selected' : ''; ?>>-- วิทยาลัยพลังงานทดแทน --</option>
                                                    <option value="วิทยาศาสตร์" <?= $row['dname'] == 'วิทยาศาสตร์' ? 'selected' : ''; ?>>-- วิทยาศาสตร์ --</option>
                                                    <option value="วิศวกรรมและอุตสาหกรรมเกษตร" <?= $row['dname'] == 'วิศวกรรมและอุตสาหกรรมเกษตร' ? 'selected' : ''; ?>>-- วิศวกรรมและอุตสาหกรรมเกษตร --</option>
                                                    <option value="ศิลปศาสตร์" <?= $row['dname'] == 'ศิลปศาสตร์' ? 'selected' : ''; ?>>-- ศิลปศาสตร์ --</option>
                                                    <option value="สถาปัตยกรรมศาสตร์และการออกแบบสิ่งแวดล้อม" <?= $row['dname'] == 'สถาปัตยกรรมศาสตร์และการออกแบบสิ่งแวดล้อม' ? 'selected' : ''; ?>>-- สถาปัตยกรรมศาสตร์และการออกแบบสิ่งแวดล้อม --</option>
                                                    <option value="สัตวศาสตร์และเทคโนโลยี" <?= $row['dname'] == 'สัตวศาสตร์และเทคโนโลยี' ? 'selected' : ''; ?>>-- สัตวศาสตร์และเทคโนโลยี --</option>
                                                    <option value="สารสนเทศและการสื่อสาร" <?= $row['dname'] == 'สารสนเทศและการสื่อสาร' ? 'selected' : ''; ?>>-- สารสนเทศและการสื่อสาร --</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2">สาขา</label>
                                            <div class="col-sm-4">
                                                <select name="dbranch" class="form-control" required>
                                                    <option value="">-- เลือกสาขา --</option>
                                                    <!-- เทคโนโลยีการประมงและทรัพยากรทางน้ำ -->
                                                    <optgroup label="--เทคโนโลยีการประมงและทรัพยากรทางน้ำ--">
                                                        <option value="เทคโนโลยีการประมงและทรัพยากรทางน้ำ" <?= $row['dbranch'] == 'เทคโนโลยีการประมงและทรัพยากรทางน้ำ' ? 'selected' : ''; ?>>เทคโนโลยีการประมงและทรัพยากรทางน้ำ</option>
                                                        <option value="การประมง" <?= $row['dbranch'] == 'การประมง' ? 'selected' : ''; ?>>การประมง</option>
                                                        <option value="นวัตกรรมการจัดการธุรกิจประมง" <?= $row['dbranch'] == 'นวัตกรรมการจัดการธุรกิจประมง' ? 'selected' : ''; ?>>นวัตกรรมการจัดการธุรกิจประมง</option>
                                                    </optgroup>
                                                    <!-- เศรษฐศาสตร์ -->
                                                    <optgroup label="--เศรษฐศาสตร์--">
                                                        <option value="เศรษฐศาสตร์" <?= $row['dbranch'] == 'เศรษฐศาสตร์' ? 'selected' : ''; ?>>เศรษฐศาสตร์</option>
                                                        <option value="เศรษฐศาสตร์เกษตรและสิ่งแวดล้อม" <?= $row['dbranch'] == 'เศรษฐศาสตร์เกษตรและสิ่งแวดล้อม' ? 'selected' : ''; ?>>เศรษฐศาสตร์เกษตรและสิ่งแวดล้อม</option>
                                                        <option value="เศรษฐศาสตร์ประยุกต์" <?= $row['dbranch'] == 'เศรษฐศาสตร์ประยุกต์' ? 'selected' : ''; ?>>เศรษฐศาสตร์ประยุกต์</option>
                                                        <option value="เศรษฐศาสตร์ระหว่างประเทศ" <?= $row['dbranch'] == 'เศรษฐศาสตร์ระหว่างประเทศ' ? 'selected' : ''; ?>>เศรษฐศาสตร์ระหว่างประเทศ</option>
                                                        <option value="เศรษฐศาสตร์สหกรณ์"<?= $row['dbranch'] == 'เศรษฐศาสตร์สหกรณ์' ? 'selected' : ''; ?>>เศรษฐศาสตร์สหกรณ์</option>
                                                    </optgroup>
                                                    <!-- บริหารธุรกิจ -->
                                                    <optgroup label="--บริหารธุรกิจ--">
                                                        <option value="การเงิน" <?= $row['dbranch'] == 'การเงิน' ? 'selected' : ''; ?>>การเงิน</option>
                                                        <option value="การจัดการ" <?= $row['dbranch'] == 'การจัดการ' ? 'selected' : ''; ?>>การจัดการ</option>
                                                        <option value="การตลาด" <?= $row['dbranch'] == 'การตลาด' ? 'selected' : ''; ?>>การตลาด</option>
                                                        <option value="การบัญชี" <?= $row['dbranch'] == 'การบัญชี' ? 'selected' : ''; ?>>การบัญชี</option>
                                                        <option value="นวัตกรรมธุรกิจค้าปลีกสมัยใหม่" <?= $row['dbranch'] == 'นวัตกรรมธุรกิจค้าปลีกสมัยใหม่' ? 'selected' : ''; ?>>นวัตกรรมธุรกิจค้าปลีกสมัยใหม่</option>
                                                        <option value="บริหารธุรกิจ" <?= $row['dbranch'] == 'บริหารธุรกิจ' ? 'selected' : ''; ?>>บริหารธุรกิจ</option>
                                                        <option value="บัญชี" <?= $row['dbranch'] == 'บัญชี' ? 'selected' : ''; ?>>บัญชี</option>
                                                        <option value="ระบบสารสนเทศทางธุรกิจ" <?= $row['dbranch'] == 'ระบบสารสนเทศทางธุรกิจ' ? 'selected' : ''; ?>>ระบบสารสนเทศทางธุรกิจ</option>
                                                    </optgroup>
                                                    <!-- ผลิตกรรมการเกษตร -->
                                                    <optgroup label="--ผลิตกรรมการเกษตร--">
                                                        <option value="เกษตรเคมี" <?= $row['dbranch'] == 'เกษตรเคมี' ? 'selected' : ''; ?>>เกษตรเคมี</option>
                                                        <option value="การพัฒนาภูมิสังคมอย่างยั่งยืน" <?= $row['dbranch'] == 'การพัฒนาภูมิสังคมอย่างยั่งยืน' ? 'selected' : ''; ?>>การพัฒนาภูมิสังคมอย่างยั่งยืน</option>
                                                        <option value="การพัฒนาส่งเสริมและนิเทศศาสตร์เกษตร" <?= $row['dbranch'] == 'การพัฒนาส่งเสริมและนิเทศศาสตร์เกษตร' ? 'selected' : ''; ?>>การพัฒนาส่งเสริมและนิเทศศาสตร์เกษตร</option>
                                                        <option value="การส่งเสริมและสื่อสารเกษตร" <?= $row['dbranch'] == 'การส่งเสริมและสื่อสารเกษตร' ? 'selected' : ''; ?>>การส่งเสริมและสื่อสารเกษตร</option>
                                                        <option value="ปฐพีศาสตร์" <?= $row['dbranch'] == 'ปฐพีศาสตร์' ? 'selected' : ''; ?>>ปฐพีศาสตร์</option>
                                                        <option value="พัฒนาทรัพยากรและส่งเสริมการเกษตร" <?= $row['dbranch'] == 'พัฒนาทรัพยากรและส่งเสริมการเกษตร' ? 'selected' : ''; ?>>พัฒนาทรัพยากรและส่งเสริมการเกษตร</option>
                                                        <option value="พืชไร่" <?= $row['dbranch'] == 'พืชไร่' ? 'selected' : ''; ?>>พืชไร่</option>
                                                        <option value="พืชสวน" <?= $row['dbranch'] == 'พืชสวน' ? 'selected' : ''; ?>>พืชสวน</option>
                                                        <option value="พืชสวน (ไม้ผล)" <?= $row['dbranch'] == 'พืชสวน (ไม้ผล)' ? 'selected' : ''; ?>>พืชสวน (ไม้ผล)</option>
                                                        <option value="พืชสวน (พืชสวนประดับ)" <?= $row['dbranch'] == 'พืชสวน (พืชสวนประดับ)' ? 'selected' : ''; ?>>พืชสวน (พืชสวนประดับ)</option>
                                                        <option value="วิทยาการสมุนไพร" <?= $row['dbranch'] == 'วิทยาการสมุนไพร' ? 'selected' : ''; ?>>วิทยาการสมุนไพร</option>
                                                        <option value="ส่งเสริมการเกษตรและการพัฒนาชนบท" <?= $row['dbranch'] == 'ส่งเสริมการเกษตรและการพัฒนาชนบท' ? 'selected' : ''; ?>>ส่งเสริมการเกษตรและการพัฒนาชนบท</option>
                                                        <option value="อารักขาพืช" <?= $row['dbranch'] == 'อารักขาพืช' ? 'selected' : ''; ?>>อารักขาพืช</option>
                                                        <option value="อารักขาพืช (โรคพืชวิทยา)" <?= $row['dbranch'] == 'อารักขาพืช (โรคพืชวิทยา)' ? 'selected' : ''; ?>>อารักขาพืช (โรคพืชวิทยา)</option>
                                                        <option value="อารักขาพืช (กีฏวิทยา)" <?= $row['dbranch'] == 'อารักขาพืช (กีฏวิทยา)' ? 'selected' : ''; ?>>อารักขาพืช (กีฏวิทยา)</option>
                                                        <option value="อารักขาพืช (วัชพืชวิทยา)" <?= $row['dbranch'] == 'อารักขาพืช (วัชพืชวิทยา)' ? 'selected' : ''; ?>>อารักขาพืช (วัชพืชวิทยา)</option>
                                                    </optgroup>
                                                    <!-- พัฒนาการท่องเที่ยว -->
                                                    <optgroup label="--พัฒนาการท่องเที่ยว--">
                                                        <option value="การจัดการธุรกิจท่องเที่ยว" <?= $row['dbranch'] == 'การจัดการธุรกิจท่องเที่ยว' ? 'selected' : ''; ?>>การจัดการธุรกิจท่องเที่ยว</option>
                                                        <option value="การจัดการธุรกิจท่องเที่ยวและบริการ" <?= $row['dbranch'] == 'การจัดการธุรกิจท่องเที่ยวและบริการ' ? 'selected' : ''; ?>>การจัดการธุรกิจท่องเที่ยวและบริการ</option>
                                                        <option value="พัฒนาการท่องเที่ยว" <?= $row['dbranch'] == 'พัฒนาการท่องเที่ยว' ? 'selected' : ''; ?>>พัฒนาการท่องเที่ยว</option>
                                                    </optgroup>
                                                    <!-- มหาวิทยาลัยแม่โจ้ - แพร่ เฉลิมพระเกียรติ -->
                                                    <optgroup label="--มหาวิทยาลัยแม่โจ้ - แพร่ เฉลิมพระเกียรติ--">
                                                        <option value="เกษตรป่าไม้" <?= $row['dbranch'] == 'เกษตรป่าไม้' ? 'selected' : ''; ?>>เกษตรป่าไม้</option>
                                                        <option value="เทคโนโลยีการผลิตพืช" <?= $row['dbranch'] == 'เทคโนโลยีการผลิตพืช' ? 'selected' : ''; ?>>เทคโนโลยีการผลิตพืช</option>
                                                        <option value="เทคโนโลยีการผลิตสัตว์" <?= $row['dbranch'] == 'เทคโนโลยีการผลิตสัตว์' ? 'selected' : ''; ?>>เทคโนโลยีการผลิตสัตว์</option>
                                                        <option value="เทคโนโลยีการอาหาร" <?= $row['dbranch'] == 'เทคโนโลยีการอาหาร' ? 'selected' : ''; ?>>เทคโนโลยีการอาหาร</option>
                                                        <option value="เทคโนโลยีชีวภาพทางอุตสาหกรรมเกษตร" <?= $row['dbranch'] == 'เทคโนโลยีชีวภาพทางอุตสาหกรรมเกษตร' ? 'selected' : ''; ?>>เทคโนโลยีชีวภาพทางอุตสาหกรรมเกษตร</option>
                                                        <option value="เทคโนโลยีอุตสาหกรรมป่าไม้" <?= $row['dbranch'] == 'เทคโนโลยีอุตสาหกรรมป่าไม้' ? 'selected' : ''; ?>>เทคโนโลยีอุตสาหกรรมป่าไม้</option>
                                                        <option value="เศรษฐศาสตร์ประยุกต์เพื่อการพัฒนาชุมชน" <?= $row['dbranch'] == 'เศรษฐศาสตร์ประยุกต์เพื่อการพัฒนาชุมชน' ? 'selected' : ''; ?>>เศรษฐศาสตร์ประยุกต์เพื่อการพัฒนาชุมชน</option>
                                                        <option value="การจัดการชุมชน" <?= $row['dbranch'] == 'การจัดการชุมชน' ? 'selected' : ''; ?>>การจัดการชุมชน</option>
                                                        <option value="การจัดการป่าไม้" <?= $row['dbranch'] == 'การจัดการป่าไม้' ? 'selected' : ''; ?>>การจัดการป่าไม้</option>
                                                        <option value="การตลาด" <?= $row['dbranch'] == 'การตลาด' ? 'selected' : ''; ?>>การตลาด</option>
                                                        <option value="ชีววิทยาประยุกต์" <?= $row['dbranch'] == 'ชีววิทยาประยุกต์' ? 'selected' : ''; ?>>ชีววิทยาประยุกต์</option>
                                                        <option value="บัญชี" <?= $row['dbranch'] == 'บัญชี' ? 'selected' : ''; ?>>บัญชี</option>
                                                        <option value="พัฒนาการท่องเที่ยว" <?= $row['dbranch'] == 'พัฒนาการท่องเที่ยว' ? 'selected' : ''; ?>>พัฒนาการท่องเที่ยว</option>
                                                        <option value="รัฐศาสตร์" <?= $row['dbranch'] == 'รัฐศาสตร์' ? 'selected' : ''; ?>>รัฐศาสตร์</option>
                                                        <option value="วิทยาศาสตร์และเทคโนโลยีการอาหาร" <?= $row['dbranch'] == 'วิทยาศาสตร์และเทคโนโลยีการอาหาร' ? 'selected' : ''; ?>>วิทยาศาสตร์และเทคโนโลยีการอาหาร</option>
                                                    </optgroup>
                                                    <!-- มหาวิทยาลัยแม่โจ้-ชุมพร -->
                                                    <optgroup label="--มหาวิทยาลัยแม่โจ้-ชุมพร--">
                                                        <option value="เทคโนโลยีการผลิตพืช" <?= $row['dbranch'] == 'เทคโนโลยีการผลิตพืช' ? 'selected' : ''; ?>>เทคโนโลยีการผลิตพืช</option>
                                                        <option value="การเพาะเลี้ยงสัตว์น้ำชายฝั่ง" <?= $row['dbranch'] == 'การเพาะเลี้ยงสัตว์น้ำชายฝั่ง' ? 'selected' : ''; ?>>การเพาะเลี้ยงสัตว์น้ำชายฝั่ง</option>
                                                        <option value="การเมืองและการปกครองท้องถิ่น" <?= $row['dbranch'] == 'การเมืองและการปกครองท้องถิ่น' ? 'selected' : ''; ?>>การเมืองและการปกครองท้องถิ่น</option>
                                                        <option value="การจัดการสำหรับผู้ประกอบการ" <?= $row['dbranch'] == 'การจัดการสำหรับผู้ประกอบการ' ? 'selected' : ''; ?>>การจัดการสำหรับผู้ประกอบการ</option>
                                                        <option value="การท่องเที่ยวเชิงบูรณาการ" <?= $row['dbranch'] == 'การท่องเที่ยวเชิงบูรณาการ' ? 'selected' : ''; ?>>การท่องเที่ยวเชิงบูรณาการ</option>
                                                        <option value="การประมง" <?= $row['dbranch'] == 'การประมง' ? 'selected' : ''; ?>>การประมง</option>
                                                        <option value="พัฒนาการท่องเที่ยว" <?= $row['dbranch'] == 'พัฒนาการท่องเที่ยว' ? 'selected' : ''; ?>>พัฒนาการท่องเที่ยว</option>
                                                        <option value="รัฐศาสตร์" <?= $row['dbranch'] == 'รัฐศาสตร์' ? 'selected' : ''; ?>>รัฐศาสตร์</option>
                                                    </optgroup>
                                                    <!-- วิทยาลัยนานาชาติ -->
                                                    <optgroup label="--วิทยาลัยนานาชาติ--">
                                                        <option value="การจัดการการท่องเที่ยว" <?= $row['dbranch'] == 'การจัดการการท่องเที่ยว' ? 'selected' : ''; ?>>การจัดการการท่องเที่ยว</option>
                                                        <option value="การจัดการเกษตรอินทรีย์" <?= $row['dbranch'] == 'การจัดการเกษตรอินทรีย์' ? 'selected' : ''; ?>>การจัดการเกษตรอินทรีย์</option>
                                                    </optgroup>
                                                    <!-- วิทยาลัยบริหารศาสตร์ -->
                                                    <optgroup label="--วิทยาลัยบริหารศาสตร์--">
                                                        <option value="การบริหารท้องถิ่น" <?= $row['dbranch'] == 'การบริหารท้องถิ่น' ? 'selected' : ''; ?>>การบริหารท้องถิ่น</option>
                                                        <option value="การบริหารสาธารณะ" <?= $row['dbranch'] == 'การบริหารสาธารณะ' ? 'selected' : ''; ?>>การบริหารสาธารณะ</option>
                                                        <option value="บริหารศาสตร์" <?= $row['dbranch'] == 'บริหารศาสตร์' ? 'selected' : ''; ?>>บริหารศาสตร์</option>
                                                        <option value="รัฐประศาสนศาสตร์" <?= $row['dbranch'] == 'รัฐประศาสนศาสตร์' ? 'selected' : ''; ?>>รัฐประศาสนศาสตร์</option>
                                                        <option value="รัฐศาสตร์" <?= $row['dbranch'] == 'รัฐศาสตร์' ? 'selected' : ''; ?>>รัฐศาสตร์</option>
                                                    </optgroup>
                                                    <!-- วิทยาลัยพลังงานทดแทน -->
                                                    <optgroup label="--วิทยาลัยพลังงานทดแทน--">
                                                        <option value="พลังงานทดแทน" <?= $row['dbranch'] == 'พลังงานทดแทน' ? 'selected' : ''; ?>>พลังงานทดแทน</option>
                                                        <option value="วิศวกรรมการอนุรักษ์พลังงาน" <?= $row['dbranch'] == 'วิศวกรรมการอนุรักษ์พลังงาน' ? 'selected' : ''; ?>>วิศวกรรมการอนุรักษ์พลังงาน</option>
                                                        <option value="วิศวกรรมพลังงานทดแทน" <?= $row['dbranch'] == 'วิศวกรรมพลังงานทดแทน' ? 'selected' : ''; ?>>วิศวกรรมพลังงานทดแทน</option>
                                                    </optgroup>
                                                    <!-- วิทยาศาสตร์ -->
                                                    <optgroup label="--วิทยาศาสตร์--">
                                                        <option value="เคมี" <?= $row['dbranch'] == 'เคมี' ? 'selected' : ''; ?>>เคมี</option>
                                                        <option value="เคมีประยุกต์" <?= $row['dbranch'] == 'เคมีประยุกต์' ? 'selected' : ''; ?>>เคมีประยุกต์</option>
                                                        <option value="เคมีอุตสาหกรรมและเทคโนโลยีสิ่งทอ" <?= $row['dbranch'] == 'เคมีอุตสาหกรรมและเทคโนโลยีสิ่งทอ' ? 'selected' : ''; ?>>เคมีอุตสาหกรรมและเทคโนโลยีสิ่งทอ</option>
                                                        <option value="เทคโนโลยีชีวภาพ"  <?= $row['dbranch'] == 'เทคโนโลยีชีวภาพ' ? 'selected' : ''; ?>>เทคโนโลยีชีวภาพ</option>
                                                        <option value="เทคโนโลยีสารสนเทศ" <?= $row['dbranch'] == 'เทคโนโลยีสารสนเทศ' ? 'selected' : ''; ?>>เทคโนโลยีสารสนเทศ</option>
                                                        <option value="เทคโนโลยีสิ่งแวดล้อม" <?= $row['dbranch'] == 'เทคโนโลยีสิ่งแวดล้อม' ? 'selected' : ''; ?>>เทคโนโลยีสิ่งแวดล้อม</option>
                                                        <option value="กนวัตกรรมเทคโนโลยีดิจิทัล" <?= $row['dbranch'] == 'กนวัตกรรมเทคโนโลยีดิจิทัล' ? 'selected' : ''; ?>>กนวัตกรรมเทคโนโลยีดิจิทัล</option>
                                                        <option value="คณิตศาสตร์" <?= $row['dbranch'] == 'คณิตศาสตร์' ? 'selected' : ''; ?>>คณิตศาสตร์</option>
                                                        <option value="นวัตกรรมเทคโนโลยีดิจิทัล" <?= $row['dbranch'] == 'นวัตกรรมเทคโนโลยีดิจิทัล' ? 'selected' : ''; ?>>นวัตกรรมเทคโนโลยีดิจิทัล</option>
                                                        <option value="พันธุศาสตร์" <?= $row['dbranch'] == 'พันธุศาสตร์' ? 'selected' : ''; ?>>พันธุศาสตร์</option>
                                                        <option value="ฟิสิกส์ประยุกต์" <?= $row['dbranch'] == 'ฟิสิกส์ประยุกต์' ? 'selected' : ''; ?>>ฟิสิกส์ประยุกต์</option>
                                                        <option value="วัสดุศาสตร์" <?= $row['dbranch'] == 'วัสดุศาสตร์' ? 'selected' : ''; ?>>วัสดุศาสตร์</option>
                                                        <option value="วิทยาการคอมพิวเตอร์" <?= $row['dbranch'] == 'วิทยาการคอมพิวเตอร์' ? 'selected' : ''; ?>>วิทยาการคอมพิวเตอร์</option>
                                                        <option value="วิทยาศาสตร์และเทคโนโลยีนาโน" <?= $row['dbranch'] == 'วิทยาศาสตร์และเทคโนโลยีนาโน' ? 'selected' : ''; ?>>วิทยาศาสตร์และเทคโนโลยีนาโน</option>
                                                        <option value="สถิติ" <?= $row['dbranch'] == 'สถิติ' ? 'selected' : ''; ?>>สถิติ</option>
                                                    </optgroup>
                                                    <!-- วิศวกรรมและอุตสาหกรรมเกษตร -->
                                                    <optgroup label="--วิศวกรรมและอุตสาหกรรมเกษตร--">
                                                        <option value="เทคโนโลยียางและพอลิเมอร์" <?= $row['dbranch'] == 'เทคโนโลยียางและพอลิเมอร์' ? 'selected' : ''; ?>>เทคโนโลยียางและพอลิเมอร์</option>
                                                        <option value="เทคโนโลยีหลังการเก็บเกี่ยว" <?= $row['dbranch'] == 'เทคโนโลยีหลังการเก็บเกี่ยว' ? 'selected' : ''; ?>>เทคโนโลยีหลังการเก็บเกี่ยว</option>
                                                        <option value="วิทยาศาสตร์และเทคโนโลยีการอาหาร" <?= $row['dbranch'] == 'วิทยาศาสตร์และเทคโนโลยีการอาหาร' ? 'selected' : ''; ?>>วิทยาศาสตร์และเทคโนโลยีการอาหาร</option>
                                                        <option value="วิศวกรรมเกษตร" <?= $row['dbranch'] == 'วิศวกรรมเกษตร' ? 'selected' : ''; ?>>วิศวกรรมเกษตร</option>
                                                        <option value="วิศวกรรมอาหาร" <?= $row['dbranch'] == 'วิศวกรรมอาหาร' ? 'selected' : ''; ?>>วิศวกรรมอาหาร</option>
                                                        <option value="สหวิทยาการเกษตร" <?= $row['dbranch'] == 'สหวิทยาการเกษตร' ? 'selected' : ''; ?>>สหวิทยาการเกษตร</option>
                                                    </optgroup>
                                                    <!-- ศิลปศาสตร์ -->
                                                    <optgroup label="--ศิลปศาสตร์--">
                                                        <option value="การพัฒนาสุขภาพชุมชน" <?= $row['dbranch'] == 'การพัฒนาสุขภาพชุมชน' ? 'selected' : ''; ?>>การพัฒนาสุขภาพชุมชน</option>
                                                        <option value="นิเทศศาสตร์บูรณาการ" <?= $row['dbranch'] == 'นิเทศศาสตร์บูรณาการ' ? 'selected' : ''; ?>>นิเทศศาสตร์บูรณาการ</option>
                                                        <option value="ภาษาอังกฤษ" <?= $row['dbranch'] == 'ภาษาอังกฤษ' ? 'selected' : ''; ?>>ภาษาอังกฤษ</option>
                                                    </optgroup>
                                                    <!-- สถาปัตยกรรมศาสตร์และการออกแบบสิ่งแวดล้อม -->
                                                    <optgroup label="--สถาปัตยกรรมศาสตร์และการออกแบบสิ่งแวดล้อม--">
                                                        <option value="เทคโนโลยีภูมิทัศน์" <?= $row['dbranch'] == 'เทคโนโลยีภูมิทัศน์' ? 'selected' : ''; ?>>เทคโนโลยีภูมิทัศน์</option>
                                                        <option value="การวางผังเมืองและสภาพแวดล้อม" <?= $row['dbranch'] == 'การวางผังเมืองและสภาพแวดล้อม' ? 'selected' : ''; ?>>การวางผังเมืองและสภาพแวดล้อม</option>
                                                        <option value="การออกแบบและวางแผนสิ่งแวดล้อม" <?= $row['dbranch'] == 'การออกแบบและวางแผนสิ่งแวดล้อม' ? 'selected' : ''; ?>>การออกแบบและวางแผนสิ่งแวดล้อม</option>
                                                        <option value="ภูมิสถาปัตยกรรม" <?= $row['dbranch'] == 'ภูมิสถาปัตยกรรม' ? 'selected' : ''; ?>>ภูมิสถาปัตยกรรม</option>
                                                        <option value="สถาปัตยกรรม" <?= $row['dbranch'] == 'สถาปัตยกรรม' ? 'selected' : ''; ?>>สถาปัตยกรรม</option>
                                                    </optgroup>
                                                    <!-- สัตวศาสตร์และเทคโนโลยี -->
                                                    <optgroup label="--สัตวศาสตร์และเทคโนโลยี--">
                                                        <option value="สัตวศาสตร์" <?= $row['dbranch'] == 'สัตวศาสตร์' ? 'selected' : ''; ?>>สัตวศาสตร์</option>
                                                        <option value="สัตวศาสตร์ (โคนมและโคเนื้อ)" <?= $row['dbranch'] == 'สัตวศาสตร์ (โคนมและโคเนื้อ)' ? 'selected' : ''; ?>>สัตวศาสตร์ (โคนมและโคเนื้อ)</option>
                                                        <option value="สัตวศาสตร์ (การผลิตสุกร)" <?= $row['dbranch'] == 'สัตวศาสตร์ (การผลิตสุกร)' ? 'selected' : ''; ?>>สัตวศาสตร์ (การผลิตสุกร)</option>
                                                        <option value="สัตวศาสตร์ (สัตว์ปีก)" <?= $row['dbranch'] == 'สัตวศาสตร์ (สัตว์ปีก)' ? 'selected' : ''; ?>>สัตวศาสตร์ (สัตว์ปีก)</option>
                                                        <option value="สัตวศาสตร์ (อาหารสัตว์)" <?= $row['dbranch'] == 'สัตวศาสตร์ (อาหารสัตว์)' ? 'selected' : ''; ?>>สัตวศาสตร์ (อาหารสัตว์)</option>
                                                    </optgroup>
                                                    <!-- สารสนเทศและการสื่อสาร -->
                                                    <optgroup label="--สารสนเทศและการสื่อสาร--">
                                                        <option value="การสื่อสารดิจิทัล" <?= $row['dbranch'] == 'การสื่อสารดิจิทัล' ? 'selected' : ''; ?>>การสื่อสารดิจิทัล</option>
                                                    </optgroup>
                                                    
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-sm-2"></label>
                                            <div class="col-sm-4">
                                                <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                                                <a href="student.php" class="btn btn-danger">ยกเลิก</a>
                                            </div>
                                        </div>

                                    </div><!-- /.card-body -->
                                </form>

                                <?php
                                // echo '<pre>';
                                // print_r($_POST);
                                // exit;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php
                                // echo '<pre>';
                                // print_r($_POST);
                                //exit;

                                if (isset($_POST['title_name']) &&isset($_POST['tcodestudent']) && isset($_POST['tname'])  
                                && isset($_POST['tsurname']) && isset($_POST['tsex']) && isset($_POST['tbirthbate']) 
                                && isset($_POST['tphone']) && isset($_POST['dname']) && isset($_POST['dbranch'])) {

                                    // echo'เข้ามาในเงื่อนไขได้';
                                    // exit;

                                    //ประกาศตัวแปรรับค่าจากฟอร์ม
                                    $id = $_POST['id'];
                                    $title_name =$_POST['title_name'];
                                    $tcodestudent =$_POST['tcodestudent'];
                                    $tname = $_POST['tname'];
                                    $tsurname = $_POST['tsurname'];
                                    $tsex =$_POST['tsex'];
                                    $tbirthbate =$_POST['tbirthbate'];
                                    $tphone =$_POST['tphone'];
                                    $dname =$_POST['dname'];
                                    $dbranch =$_POST['dbranch'];

                                    //sql update
                                    $stmtUpdate = $condb->prepare("UPDATE  tb_student SET
                                    title_name=:title_name, 
                                    tname=:tname,
                                    tcodestudent=:tcodestudent, 
                                    tsurname=:tsurname, 
                                    tsex=:tsex,
                                    tbirthbate=:tbirthbate,
                                    tphone=:tphone,
                                    dname=:dname,
                                    dbranch=:dbranch
                                    WHERE id=:id
                                    ");
                                    //bindParam
                                    $stmtUpdate->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
                                    $stmtUpdate->bindParam(':title_name', $title_name, PDO::PARAM_STR);
                                    $stmtUpdate->bindParam(':tcodestudent', $tcodestudent, PDO::PARAM_STR);
                                    $stmtUpdate->bindParam(':tname', $tname, PDO::PARAM_STR);
                                    $stmtUpdate->bindParam(':tsurname', $tsurname, PDO::PARAM_STR);
                                    $stmtUpdate->bindParam(':tsex', $tsex, PDO::PARAM_STR);
                                    $stmtUpdate->bindParam(':tbirthbate', $tbirthbate, PDO::PARAM_STR);
                                    $stmtUpdate->bindParam(':tphone', $tphone, PDO::PARAM_STR);
                                    $stmtUpdate->bindParam(':dname', $dname, PDO::PARAM_STR);
                                    $stmtUpdate->bindParam(':dbranch', $dbranch, PDO::PARAM_STR);
                                    
                                    $result = $stmtUpdate->execute();

                                    $condb = null; //close connect db

                                        if($result){
                                            echo '<script>
                                                setTimeout(function() {
                                                swal({
                                                    title: "แก้ไขข้อมูลสำเร็จ",
                                                    type: "success"
                                                }, function() {
                                                    window.location = "student.php"; //หน้าที่ต้องการให้กระโดดไป
                                                });
                                                }, 1000);
                                            </script>';
                                        }else{
                                        echo '<script>
                                                setTimeout(function() {
                                                swal({
                                                    title: "เกิดข้อผิดพลาด",
                                                    type: "error"
                                                }, function() {
                                                    window.location = "student.php"; //หน้าที่ต้องการให้กระโดดไป
                                                });
                                                }, 1000);
                                            </script>';
                                        }
                                }//isset
                                //window.location ="student.php?id='.$id.'&act=edit";//หน้าที่ต้องการให้กระโดดไป
                                ?>

                                
