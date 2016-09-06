<div class="container" id="formdn" style="display: none;">
    <span class="close">x</span>
    <div class="row" style="margin: 5px;">
        <h2 style="margin: 5px 0;">Đăng nhập</h2>
        <b id="error" class="text-danger"></b>
        <form method="post" action="process.php" id="formdangnhap">
            <div class="form-group">
                <label for="Email">Email</label>
                <input type="text" name="Email" class="form-control">
            </div>
            <div class="form-group">
                <label for="Password">Password</label>
                <input type="password" name="Password" class="form-control">
            </div>
            <div class="form-group">
                <div class="col-xs-4" style="padding:0;"> 
                    <label for="captcha">Mã xác nhận</label>
                    <input type="text" name="captcha" class="form-control">
                </div>
                <div class="col-xs-4"> 
                    <label for=""></label>
                    <h4><?php echo $_SESSION['captcha'];?></h4>
                </div>
                <div class="col-xs-4">
                    <label for="btndn"></label>
                    <button type="button" name="btn-dn" class="btn btn-success btn-block" id="btn-dn">Sign In</button>
                </div>
            </div>
        </form>
    </div>
</div>