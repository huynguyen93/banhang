<?php

if(!isset($_GET['idCL']) || $_GET['idCL'] < 1) header("location: index.php?a=chungloai-xem");

$chungloai = $qt->laychungloai($_GET['idCL']);

if(isset($_POST['btnsuachungloai'])) $qt->suachungloai($_GET['idCL']);

?>
<h2>Cập nhật chủng loại</h2>
<div class="">
    <form method="post" action="" class="col-md-6">
        <div class="form-group">
            <label for="TenCL">Tên chủng loại</label>
            <?php if(isset($qt->errors['TenCL'])) echo " <i class='text-danger'>{$qt->errors['TenCL']}</i>";?>
            <input type="text" name="TenCL" value="<?php if(isset($_POST['TenCL'])) echo $_POST['TenCL']; else echo $chungloai[0]['TenCL']; ?>" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="ThuTu">Thứ tự</label>
            <?php if(isset($qt->errors['ThuTu'])) echo " <i class='text-danger'>{$qt->errors['ThuTu']}</i>";?>
            <input type="text" name="ThuTu" value="<?php if(isset($_POST['ThuTu'])) echo $_POST['ThuTu']; else echo $chungloai[0]['ThuTu']; ?>" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="AnHien">Trạng thái</label>
            <select name="AnHien" class="form-control">
                <option value="0">Ẩn</option>
                <option value="1" <?php if(isset($_POST['AnHien']) && $_POST['AnHien']==1) echo "selected"; elseif($chungloai[0]['AnHien'] == 1) echo "selected='selected'";?>>Hiện</option>
            </select>
        </div>
        
        <div class="form-group">
            <input type="submit" name="btnsuachungloai" class="btn btn-primary" />
            <a href="index.php?a=chungloai-xem" class="btn btn-default">Cancel</a>
        </div>
    </form>
</div>