<?php
$_GET['p'] = !empty($_GET['p']) ? $_GET['p'] : 0;


if ($_GET['p'] != 0) {
    include './model/loginModel.php';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบบันทึกข้อมูลการมาเรียน -
        <?php echo $SCHOOL_NAME; ?>
    </title>
    <?php
    include './view/common/header.php'
        ?>
</head>

<body>

    <?php
    if ($_GET['p'] != 0) {
        include './controller/' . $_GET['p'] . 'Controller.php';
    }

    include './view/common/footer.php'
        ?>
</body>

</html>