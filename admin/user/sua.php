<?php

settype($_GET['idUser'], "int");

if($_GET['idUser'] <= 0) header("location: index.php?a=user-xem");

$user = $qt->layusertheoid($_GET['idUser']);

if(isset($_POST['themuser'])) $qt->suauser($_GET['idUser']);

?>
<h2>Cập nhật thông tin user</h2>
<?php if(isset($_SESSION['message'])) echo "<p class='alert-success' style='padding:10px; margin: 10'>{$_SESSION['message']}</p>"; unset($_SESSION['message']);?>
<div class="">
    <form method="post" action="" class="col-md-6">
        <input type="hidden" name="idUser" value="<?php echo $_GET['idUser'];?>">
        <div class="form-group">
            <label for="HoTen">Họ Tên</label>
            <?php if(!empty($qt->errors['HoTen'])) echo "<i class='text-danger'>".$qt->errors['HoTen']."</i>";?>
            <input type="text" name="HoTen" class="form-control" value="<?php if(isset($_POST['HoTen'])) echo $_POST['HoTen']; else echo $user['HoTen'];?>">
        </div>

        <div class="form-group">
            <label for="Password">Password</label>
            <?php if(!empty($qt->errors['Password'])) echo "<i class='text-danger'>".$qt->errors['Password']."</i>";?>
            <input type="password" name="Password" class="form-control" value="<?php if(isset($_POST['Password'])) echo $_POST['Password']; else echo $user['Password'];?>">
        </div>

        <div class="form-group">
            <label for="DiaChi">Địa chỉ</label>
            <?php if(!empty($qt->errors['DiaChi'])) echo "<i class='text-danger'>".$qt->errors['DiaChi']."</i>";?>
            <input type="text" name="DiaChi" class="form-control" value="<?php if(isset($_POST['DiaChi'])) echo $_POST['DiaChi']; else echo $user['DiaChi'];?>">
        </div>

        <div class="form-group">
            <label for="DienThoai">Số điện thoại</label>
            <?php if(!empty($qt->errors['DienThoai'])) echo "<i class='text-danger'>".$qt->errors['DienThoai']."</i>";?>
            <input type="text" name="DienThoai" class="form-control" value="<?php if(isset($_POST['DienThoai'])) echo $_POST['DienThoai']; else echo $user['DienThoai'];?>">
        </div>

        <div class="form-group">
            <label for="Email">Email</label>
            <?php if(!empty($qt->errors['Email'])) echo"<i class='text-danger'>". $qt->errors['Email']."</i>";?>
            <input type="email" name="Email" class="form-control" value="<?php if(isset($_POST['Email'])) echo $_POST['Email']; else echo $user['Email'];?>">
        </div>

        <div class="form-group">
            <label for="AnHien">Group</label>
            <select name="idGroup" class="form-control">
                <option value="0">User</option>
                <option value="1" <?php if((isset($_POST['idGroup']) && $_POST['idGroup']==1) || ($user['idGroup'] == 1)) echo "selected";?>>Admin</option>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" name="themuser" class="btn btn-primary">
            <a href="index.php?a=user-xem" class="btn btn-default">Cancel</a>
        </div>
    </form>
</div>
