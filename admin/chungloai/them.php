<?php
if(isset($_POST['themchungloai'])) $qt->themchungloai();
?>
<h2>Thêm chủng loại mới</h2>
<div class="">
    <form method="post" action="" class="col-md-6">
        <div class="form-group">
            <label for="TenCL">Tên chủng loại</label>
            <?php if(isset($qt->errors['TenCL'])) echo " <i class='text-danger'>{$qt->errors['TenCL']}</i>";?>
            <input type="text" name="TenCL" class="form-control" value="<?php if(isset($_POST['TenCL'])) echo $_POST['TenCL'];?>">
        </div>
        
        <div class="form-group">
            <label for="ThuTu">Thứ tự</label>
            <?php if(isset($qt->errors['ThuTu'])) echo " <i class='text-danger'>{$qt->errors['ThuTu']}</i>";?>
            <input type="text" name="ThuTu" class="form-control" value="<?php if(isset($_POST['TenCL'])) echo $_POST['ThuTu'];?>">
        </div>
        
        <div class="form-group">
            <label for="AnHien">Trạng thái</label>
            <select name="AnHien" class="form-control">
                <option value="0">Ẩn</option>
                <option value="1" <?php if(isset($_POST['AnHien']) && $_POST['AnHien']==1) echo "selected";?>>Hiện</option>
            </select>
        </div>
        
        <div class="form-group">
            <input type="submit" name="themchungloai" class="btn btn-primary" />
            <a href="index.php?a=chungloai-xem" class="btn btn-default">Cancel</a>
        </div>
    </form>
</div>