<?php

$IDYeadDataSelect = "";
$resultStudent = 0;
if (!empty($_POST['rate']) && !empty($_POST['yaer']) && !empty($_POST['term']) && !empty($_POST['class']) && !empty($_POST['room'])) {
    $IDYeadDataSelect = $_POST['rate'] . $_POST['yaer'] . $_POST['term'] . $_POST['class'] . $_POST['room'];
    $resultStudent = getIDYearDataById($IDYeadDataSelect);
}

print_r( count($resultStudent) );

$resultsIDYearData = getIDYearData();

if (empty($resultsIDYearData)) {
    echo " <div class='card text-danger p-5 text-center'> <h3>ไม่มีข้อมูลการลงทะเบียน</h3> </div> ";
} else {
    include './view/dashboardView.php';
}

?>

<script>


</script>