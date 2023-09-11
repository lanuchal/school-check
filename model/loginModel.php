<?php

if ($_GET['action'] == "checkLogin") {

    $user = htmlspecialchars($_POST['f_username']);
    $pass = empty($_POST['f_password']) ? "IS NULL" : "LIKE '" . htmlspecialchars($_POST['f_password']) . "'";

    $query = "SELECT * FROM TTeacher WHERE IDTeacher = '$user' AND PWS $pass";
    $params = array($user, $pass);
    $result = sqlsrv_query($conn, $query, $params);

    if (sqlsrv_has_rows($result)) {
        $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
        $_SESSION['userId'] = $row['IDTeacher'];
        alertMsg("เข้าสู่ระบบสำเร็จ");
        goToPath("dashboard");
    } else {
        alertMsg("รหัสผู้ใช้งานไม่ถูกต้อง");
        goToPath("login");
    }
    exit();

}