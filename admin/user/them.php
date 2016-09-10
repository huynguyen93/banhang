<?php

if(isset($_POST['themuser'])) $qt->themuser();

?>
<h2>Thêm user mới</h2>
<div class="">
    <form method="post" action="" class="col-md-6">
        <div class="form-group">
            <label for="HoTen">Họ Tên</label>
            <?php if(!empty($qt->errors['HoTen'])) echo "<i class='text-danger'>".$qt->errors['HoTen']."</i>";?>
            <input type="text" name="HoTen" class="form-control" value="<?php if(isset($_POST['HoTen'])) echo $_POST['HoTen'];?>">
        </div>

        <div class="form-group">
            <label for="Password">Password</label>
            <?php if(!empty($qt->errors['Password'])) echo "<i class='text-danger'>".$qt->errors['Password']."</i>";?>
            <input type="password" name="Password" class="form-control" value="<?php if(isset($_POST['Password'])) echo $_POST['Password'];?>">
        </div>

        <div class="form-group">
            <label for="DiaChi">Địa chỉ</label>
            <?php if(!empty($qt->errors['DiaChi'])) echo "<i class='text-danger'>".$qt->errors['DiaChi']."</i>";?>
            <input type="text" name="DiaChi" class="form-control" value="<?php if(isset($_POST['DiaChi'])) echo $_POST['DiaChi'];?>">
        </div>

        <div class="form-group">
            <label for="DienThoai">Số điện thoại</label>
            <?php if(!empty($qt->errors['DienThoai'])) echo "<i class='text-danger'>".$qt->errors['DienThoai']."</i>";?>
            <input type="text" name="DienThoai" class="form-control" value="<?php if(isset($_POST['DienThoai'])) echo $_POST['DienThoai'];?>">
        </div>

        <div class="form-group">
            <label for="Email">Email</label>
            <?php if(!empty($qt->errors['Email'])) echo"<i class='text-danger'>". $qt->errors['Email']."</i>";?>
            <input type="email" name="Email" class="form-control" value="<?php if(isset($_POST['Email'])) echo $_POST['Email'];?>">
        </div>

        <div class="form-group">
            <label for="AnHien">Group</label>
            <select name="idGroup" class="form-control">
                <option value="0">User</option>
                <option value="1" value="<?php if(isset($_POST['idGroup']) && $_POST['idGroup']==1) echo "selected";?>">Admin</option>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" name="themuser" class="btn btn-primary">
            <a href="index.php?a=user-xem" class="btn btn-default">Cancel</a>
        </div>
    </form>
</div>
