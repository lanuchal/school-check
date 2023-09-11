<?php
$_GET['p'] = !empty($_GET['p']) ? $_GET['p'] : 0;


if ($_GET['p'] != 0) {
    include './model/' . $_GET['p'] . 'Model.php';
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

    <div class="wrapper ">

        <?php include './view/common/sidebar.php'; ?>
        <div class="main-panel">
            <?php include './view/common/navbar.php'; ?>

            <!-- <div class="m-connent"> -->

            <div class="content">
                <div class="container-fluid">

                    <?php
                    if ($_GET['p'] != 0) {
                        include './controller/' . $_GET['p'] . 'Controller.php';
                    } ?>

                </div>
            </div>
        </div>
    </div>
    <?php include './view/common/footer.php' ?>
</body>

</html>