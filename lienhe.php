<?php
if(isset($_POST['guimail'])) $sp->guimail();
?>


<div class="col-md-6" style="margin-bottom: 30px;">
    <h2>Gửi email cho chúng tôi</h2>
    <?php if(isset($_SESSION['fail'])) echo $_SESSION['fail']; unset($_SESSION['fail']);?>
    <?php if(isset($_SESSION['success'])) echo $_SESSION['success']; ?>
    <form method="post" action="index.php?action=lienhe" id="formdangky" style="<?php if(isset($_SESSION['success'])) echo 'display:none'; unset($_SESSION['success']);?>">
        <div class="form-group">
            <label for="HoTen">Họ tên</label>
            <input type="text" name="HoTen" class="form-control" value="<?php if(isset($_POST['HoTen'])) echo $_POST['HoTen'] ?>">
        </div>
        <div class="form-group">
            <label for="Email">Email</label>
            <input type="text" name="Email" class="form-control" value="<?php if(isset($_POST['Email'])) echo $_POST['Email'] ?>">
        </div>
        <div class="form-group">
            <label for="tieude">Tiêu đề</label>
            <input type="text" name="tieude" class="form-control" value="<?php if(isset($_POST['tieude'])) echo $_POST['tieude'] ?>">
        </div>
        <div class="form-group">
            <label for="noidung">Nội dung</label>
            <textarea class="form-control" name="noidung" rows="6"><?php if(isset($_POST['noidung'])) echo $_POST['noidung'] ?></textarea>
        </div>
        <div class="form-group">
            <div class="col-xs-4" style="padding:0;"> 
                <label for="captcha">Mã xác nhận</label>
                <input type="text" name="captcha" class="form-control" value="<?php if(isset($_POST['captcha'])) echo $_POST['captcha'] ?>">
            </div>
            <div class="col-xs-4"> 
                <label for="Gia"></label>
                <h4><?php echo $_SESSION['captcha'];?></h4>
            </div>
            <div class="col-xs-4">
                <label for="dangky"></label>
                <button type="submit" name="guimail" class="btn btn-success btn-block" id="btn-dk">Gửi</button>
            </div>
        </div>
    </form>
</div>
<div class="col-md-6">
    <h2>Thông tin liên hệ</h2>
    <p><b>Số 105, đường Bà Huyện Thanh Quan, Quận 3, TPHCM</b></p>
    <p><b>Email: cskh@nhatnghe.com</b></p>
    <p><b>Hotline: 19008198</b></p>
</div>
