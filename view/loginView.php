<div class="d-flex justify-content-center align-items-center h-full">
    <div class="card w-fix">
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" target="_parent" action="?action=checkLogin">
                <div class="row">
                    <div class="col-md-12 pb-2" align="center">
                        <img src="./assets/img/logo.png" width="200" />
                        <h4 class="font-1 mt-4 mb-0 text-primary">
                            <strong>ระบบเช็คชื่อออนไลน์</strong>
                        </h4>
                        <div class="font-1 mt-0">
                            <?php echo $SCHOOL_NAME; ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="bmd-label-floating">Username</label>
                            <input name="f_username" type="text" required="required" class="form-control"
                                id="f_username">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="bmd-label-floating">Password</label>
                            <input name="f_password" type="password" class="form-control" id="f_password">
                        </div>
                    </div>
                </div>
                <div align="center">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-sign-in-alt"></i>
                        เข้าสู่ระบบ</button>
                </div>
                <div class="clearfix">
                </div>
            </form>
        </div>
    </div>
</div>