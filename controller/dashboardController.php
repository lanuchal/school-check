<?php

$IDYeadDataSelect = "";
$resultStudent = array();
$resultgetSetColorToView = array();

$valRate = !empty($_POST['rate']) ? $_POST['rate'] : '';
$valYear = !empty($_POST['yaer']) ? $_POST['yaer'] : '';
$valTerm = !empty($_POST['term']) ? $_POST['term'] : '';
$valClass = !empty($_POST['class']) ? $_POST['class'] : '';
$valRoom = !empty($_POST['room']) ? $_POST['room'] : '';
$valPeriod = !empty($_POST['period']) ? $_POST['period'] : '1';

if (!empty($_POST['rate']) && !empty($_POST['yaer']) && !empty($_POST['term']) && !empty($_POST['class']) && !empty($_POST['room'])) {
    $IDYeadDataSelect = $_POST['rate'] . $_POST['yaer'] . $_POST['term'] . $_POST['class'] . $_POST['room'];
    $resultStudent = getIDYearDataById($IDYeadDataSelect, $valPeriod);
    $resultgetSetColorToView = getSetColorToView($IDYeadDataSelect, $valPeriod);
    // print_r($resultgetSetColorToView[0]['CodeReasonAbsent']);
    // exit();

}


$resultsIDYearData = getIDYearData();

if (empty($resultsIDYearData)) {
    echo " <div class='card text-danger p-5 text-center'> <h3>ไม่มีข้อมูลการลงทะเบียน</h3> </div> ";
} else {
    include './view/dashboardView.php';
}

?>

<script>

    function setBtnColor(idStudent, nameBtn) {
        var btnOn = document.getElementById("btnOn" + idStudent);
        var btnMiss = document.getElementById("btnMiss" + idStudent);
        var btnLeave = document.getElementById("btnLeave" + idStudent);
        var btnSick = document.getElementById("btnSick" + idStudent);

        // ลบคลาสทั้งหมดจากทุกปุ่มก่อน
        btnOn.classList.remove("btn-outline-success", "btn-success");
        btnMiss.classList.remove("btn-outline-primary", "btn-primary");
        btnLeave.classList.remove("btn-outline-warning", "btn-warning");
        btnSick.classList.remove("btn-outline-info", "btn-info");

        // ตั้งค่าคลาสตามปุ่มที่ถูกคลิก
        if (nameBtn == "btnOn") {
            btnOn.classList.add("btn-success");
            btnMiss.classList.add("btn-outline-primary");
            btnLeave.classList.add("btn-outline-warning");
            btnSick.classList.add("btn-outline-info");
        } else if (nameBtn == "btnMiss") {
            btnOn.classList.add("btn-outline-success");
            btnMiss.classList.add("btn-primary");
            btnLeave.classList.add("btn-outline-warning");
            btnSick.classList.add("btn-outline-info");
        } else if (nameBtn == "btnLeave") {
            btnOn.classList.add("btn-outline-success");
            btnMiss.classList.add("btn-outline-primary");
            btnLeave.classList.add("btn-warning");
            btnSick.classList.add("btn-outline-info");
        } else if (nameBtn == "btnSick") {
            btnOn.classList.add("btn-outline-success");
            btnMiss.classList.add("btn-outline-primary");
            btnLeave.classList.add("btn-outline-warning");
            btnSick.classList.add("btn-info");
        }
    }
    const handleCilckOn = (id) => {
        $.ajax({
            type: "POST",
            url: "?p=dashboard&action=checkOn",
            data: {
                id: id,
                detail: "มาทันเวลา",
                code: 4,
            },
            dataType: "json",
            success: function (response) {
                if (response.result) {
                    setBtnColor(id, "btnOn")
                } else {
                    alert("เกิดข้อผิดพลาดในการอัปเดตข้อมูล")
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
            },
        });
    }

    const handleCilckMiss = (id) => {
        $.ajax({
            type: "POST",
            url: "?p=dashboard&action=checkOn",
            data: {
                id: id,
                detail: "ขาด",
                code: 1,
            },
            dataType: "json",
            success: function (response) {
                if (response.result) {
                    setBtnColor(id, "btnMiss")
                } else {
                    alert("เกิดข้อผิดพลาดในการอัปเดตข้อมูล")
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
            },
        });

    }

    const handleCilckLeave = (id) => {
        $.ajax({
            type: "POST",
            url: "?p=dashboard&action=checkOn",
            data: {
                id: id,
                detail: "ลา",
                code: 3,
            },
            dataType: "json",
            success: function (response) {
                if (response.result) {
                    setBtnColor(id, "btnLeave")
                } else {
                    alert("เกิดข้อผิดพลาดในการอัปเดตข้อมูล")
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
            },
        });
    }

    const handleCilckSick = (id) => {
        $.ajax({
            type: "POST",
            url: "?p=dashboard&action=checkOn",
            data: {
                id: id,
                detail: "ป่วย",
                code: 2,
            },
            dataType: "json",
            success: function (response) {
                if (response.result) {
                    setBtnColor(id, "btnSick")
                } else {
                    alert("เกิดข้อผิดพลาดในการอัปเดตข้อมูล")
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
            },
        });
    }


</script>