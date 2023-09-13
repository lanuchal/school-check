<!-- <div class="content">
    <div class="container-fluid"> -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-left">
                <h4 class="card-title font-1 mb-1" align="left">
                    <strong><i class="fas fa-check"></i>
                        บันทึกการมาเรียน
                    </strong>
                </h4>
            </div>
            <div class="card-body">
                <form action="?p=dashboard" method="POST" enctype="multipart/form-data" target="_parent">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="rate">ช่วงชั้น</label>
                            <select name="rate" id="rate" class="form-control">
                                <?php
                                $old_reat = '';
                                foreach ($resultsIDYearData as $row) {
                                    if ($old_reat != substr($row['IDYearData'], 0, 1)) {
                                        $old_reat = substr($row['IDYearData'], 0, 1);
                                        ?>
                                        <option value="<?php echo substr($row['IDYearData'], 0, 1) ?>" <?php if ($valRate == substr($row['IDYearData'], 0, 1))
                                                 echo "selected"; ?>>
                                            <?php echo substr($row['IDYearData'], 0, 1); ?>
                                        </option>
                                    <?php }
                                } ?>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="yaer">ปีการศึกษา</label>
                            <select name="yaer" id="yaer" class="form-control">
                                <?php
                                $old_yaer = '';
                                foreach ($resultsIDYearData as $row) {
                                    if ($old_yaer != substr($row['IDYearData'], 1, 4)) {
                                        $old_yaer = substr($row['IDYearData'], 1, 4);
                                        ?>
                                        <option value="<?php echo substr($row['IDYearData'], 1, 4) ?>" <?php if ($valYear == substr($row['IDYearData'], 1, 4))
                                                 echo "selected"; ?>>
                                            <?php echo substr($row['IDYearData'], 1, 4); ?>
                                        </option>
                                    <?php }
                                } ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="PSubjectCode">วิชา</label>
                            <select name="PSubjectCode" id="PSubjectCode" class="form-control">
                                <?php

                                foreach ($resultsPSubjectCode as $row) { ?>
                                    <option value="<?php echo $row['PSubjectCode'] ?>" <?php if ($valPSubjectCode == $row['PSubjectCode'])
                                           echo "selected"; ?>>
                                        <?php echo $row['PSubjectCode'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-1">
                            <label for="term">เทอม</label>
                            <select name="term" id="term" class="form-control">
                                <?php
                                $old_term = '';
                                foreach ($resultsIDYearData as $row) {
                                    if ($old_term != substr($row['IDYearData'], 5, 1)) {
                                        $old_term = substr($row['IDYearData'], 5, 1);
                                        ?>
                                        <option value="<?php echo substr($row['IDYearData'], 5, 1) ?>" <?php if ($valTerm == substr($row['IDYearData'], 5, 1))
                                                 echo "selected"; ?>>
                                            <?php echo substr($row['IDYearData'], 5, 1); ?>
                                        </option>
                                    <?php }
                                } ?>
                            </select>
                        </div>


                        <div class="col-md-1">
                            <label for="class">ชั้น</label>
                            <select name="class" id="class" class="form-control">
                                <?php
                                $old_class = '';
                                foreach ($resultsIDYearData as $row) {
                                    if ($old_class != substr($row['IDYearData'], 6, 5)) {
                                        $old_class = substr($row['IDYearData'], 6, 5);
                                        ?>
                                        <option value="<?php echo substr($row['IDYearData'], 6, 5) ?>" <?php if ($valClass == substr($row['IDYearData'], 6, 5))
                                                 echo "selected"; ?>>
                                            <?php echo substr($row['IDYearData'], 6, 5); ?>
                                        </option>
                                    <?php }
                                } ?>
                            </select>
                        </div>

                        <div class="col-md-1">
                            <label for="room">ห้อง</label>
                            <select name="room" id="room" class="form-control">
                                <?php
                                $old_room = '';
                                foreach ($resultsIDYearData as $row) {
                                    if ($old_room != substr($row['IDYearData'], 11, 2)) {
                                        $old_room = substr($row['IDYearData'], 11, 2);
                                        ?>
                                        <option value="<?php echo substr($row['IDYearData'], 11, 2) ?>" <?php if ($valRoom == substr($row['IDYearData'], 11, 2))
                                                 echo "selected"; ?>>
                                            <?php echo substr($row['IDYearData'], 11, 2); ?>
                                        </option>
                                    <?php }
                                } ?>
                            </select>
                        </div>


                        <div class="col-md-1">
                            <label for="period">คาบที่</label>
                            <input type="number" id="period" class="form-control mt-1" name="period"
                                value="<?php echo $valPeriod ?>" required>
                        </div>


                        <div class="col-md-2">
                            <button class="btn btn-success mt-4 w-100" type="submit">ค้นหา</button>
                        </div>
                    </div>
                </form>
                <br>
                <hr>
                <div class="row">
                    <?php
                    if (count($resultStudent) != 0) {
                        foreach ($resultStudent as $key => $rowStudent) {
                            $idStuden = $rowStudent['IDStudent']; ?>
                            <div class="col-md-2 col-12 text-right text-primary"><b>คาบที่ : </b>
                                <?php echo $valPeriod ?>
                            </div>
                            <div class="col-md-4 col-12 text-center">
                                <h4>รหัส :
                                    <?php echo $idStuden ?> ->
                                    <?php echo $rowStudent['PreName'] ?>
                                    <?php echo $rowStudent['NameFirst'] ?>
                                    <?php echo $rowStudent['NameLast'] ?>
                                </h4>
                            </div>
                            <div class="col-md-5 col-12 text-center">
                                <button class="btn-md btn  py-2 px-3 <?php if ($resultgetSetColorToView[$key]['CodeReasonAbsent'] == '4') {
                                    echo "btn-success ";
                                } else {
                                    echo "btn-outline-success ";
                                } ?>" id="btnOn<?php echo $resultgetSetColorToView[$key]['ID'] ?>"
                                    onclick="handleCilckOn('<?php echo $resultgetSetColorToView[$key]['ID'] ?>','<?php echo $rowStudent['IDYearData'] ?>','<?php echo $rowStudent['PSubjectCode'] ?>','<?php echo $idStuden ?>')">
                                    <h5 class="p-0 m-0">มา</h5>
                                </button>
                                <button class="btn-md btn py-2 px-3 <?php if ($resultgetSetColorToView[$key]['CodeReasonAbsent'] == '1') {
                                    echo "btn-primary ";
                                } else {
                                    echo "btn-outline-primary ";
                                } ?>" id="btnMiss<?php echo $resultgetSetColorToView[$key]['ID'] ?>"
                                    onclick="handleCilckMiss('<?php echo $resultgetSetColorToView[$key]['ID'] ?>','<?php echo $rowStudent['IDYearData'] ?>','<?php echo $rowStudent['PSubjectCode'] ?>','<?php echo $idStuden ?>')">
                                    <h5 class="p-0 m-0">ขาด</h5>
                                </button>
                                <button class="btn-md btn  py-2 px-3 <?php if ($resultgetSetColorToView[$key]['CodeReasonAbsent'] == '3') {
                                    echo "btn-warning ";
                                } else {
                                    echo "btn-outline-warning ";
                                } ?>" id="btnLeave<?php echo $resultgetSetColorToView[$key]['ID'] ?>"
                                    onclick="handleCilckLeave('<?php echo $resultgetSetColorToView[$key]['ID'] ?>','<?php echo $rowStudent['IDYearData'] ?>','<?php echo $rowStudent['PSubjectCode'] ?>','<?php echo $idStuden ?>')">
                                    <h5 class="p-0 m-0">ลา</h5>
                                </button>
                                <button class="btn-md btn py-2 px-3 <?php if ($resultgetSetColorToView[$key]['CodeReasonAbsent'] == '2') {
                                    echo "btn-info ";
                                } else {
                                    echo "btn-outline-info ";
                                } ?>" id="btnSick<?php echo $resultgetSetColorToView[$key]['ID'] ?>"
                                    onclick="handleCilckSick('<?php echo $resultgetSetColorToView[$key]['ID'] ?>','<?php echo $rowStudent['IDYearData'] ?>','<?php echo $rowStudent['PSubjectCode'] ?>','<?php echo $idStuden ?>')">
                                    <h5 class="p-0 m-0">ป่วย</h5>
                                </button>
                            </div>
                            <div class="col-md-1 col-12 text-center"></div>
                            <hr>
                        <?php }
                    } else {
                        echo "<h4 class='text-danger text-center my-5 w-100'>ไม่มีข้อมูลนักเรียนที่ลงทะเบียน</h4>";
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- </div>
</div> -->