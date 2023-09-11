<div class="sidebar" data-color="purple" data-background-color="white" data-image="assets/img/sidebar-1.jpg">
    <div class="logo" align="center">
        <img src="./assets/img/logo.png" width="150" />


    </div>
    <div class="sidebar-wrapper font-1">
        <ul class="nav">

            <li class="nav-item <?php if ($_GET['p'] == "dashboard") {
                echo "active";
            } ?> ">
                <a class="nav-link" href="./?p=dashboard">
                    <i class="fas fa-clipboard-check"></i>
                    <p>
                        เช็คชื่อ
                    </p>
                </a>
            </li>
            <li class="nav-item <?php if ($_GET['p'] == "reportall") {
                echo "active";
            } ?> ">
                <a class="nav-link" href="./?p=reportall">
                    <i class="fas fa-clipboard-check"></i>
                    <p>
                        รายงานยืนยันการเช็คชื่อ
                    </p>
                </a>
            </li>
            <li class="nav-item <?php if ($_GET['p'] == "reportcometoschool") {
                echo "active";
            } ?>">
                <a class="nav-link" href="?p=reportcometoschool">
                    <i class="material-icons">dashboard</i>
                    <p>
                        รายงานการ ขาด/ลา
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?action=handleLogout">
                    <i class="fas fa-sign-in-alt"></i>
                    <p>
                        ออกจากระบบ
                    </p>
                </a>
            </li>

        </ul>
    </div>
</div>