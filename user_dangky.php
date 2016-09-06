<div class="container" id="formdk" style="display: none;">
    <span class="close">x</span>
    <div class="row" style="margin: 5px;">
        <h2 style="margin: 5px 0;">Đăng ký thành viên</h2>
        <b id="error" class="text-danger"></b>
        <form method="post" action="" id="formdangky">
            <div class="form-group">
                <label for="Email">Email</label>
                <input type="text" name="Email" class="form-control">
            </div>
            <div class="form-group">
                <label for="Password">Password</label>
                <input type="password" name="Password" class="form-control">
            </div>
            <div class="form-group">
                <label for="RePassword">Confirm password</label>
                <input type="password" name="RePassword" class="form-control">
            </div>
            <div class="form-group">
                <label for="HoTen">Họ tên</label>
                <input type="text" name="HoTen" class="form-control">
            </div>
            <div class="form-group">
                <label for="DiaChi">Địa chỉ</label>
                <input type="text" name="DiaChi" class="form-control">
            </div>
            <div class="form-group">
                <label for="DienThoai">Điện thoại</label>
                <input type="text" name="DienThoai" class="form-control">
            </div>
            <div class="form-group">
                <div class="col-xs-4" style="padding:0;"> 
                    <label for="captcha">Mã xác nhận</label>
                    <input type="text" name="captcha" class="form-control">
                </div>
                <div class="col-xs-4"> 
                    <label for="Gia"></label>
                    <h4><?php echo $_SESSION['captcha'];?></h4>
                </div>
                <div class="col-xs-4">
                    <label for="dangky"></label>
                    <a name="dangky" href="#" class="btn btn-success btn-block" id="btn-dk">Sign Up</a>
                </div>
            </div>
        </form>
    </div>
</div>