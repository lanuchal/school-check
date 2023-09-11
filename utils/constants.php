<?php


$SCHOOL_NAME = "โรงเรียนอนุบาลเชียงใหม่";

function alertMsg($msg)
{
    echo "<script>
            alert('$msg')
          </script>";
}
function goToPath($page)
{
    echo "<script>
    window.location.href = '?p=$page';
  </script>";
}

if ($_GET['action'] == "handleLogout") {
    session_destroy();
    alertMsg("ออกจากระบบสำเร็จ");
    goToPath("login");
}