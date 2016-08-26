<?php

if(isset($_POST['themchungloai'])) $qt->themchungloai();

?>

<h2>Thêm chủng loại mới</h2>
<div class="">
    <?php foreach($qt->errors as $error){?>
    <p><?php echo $error;?></p>
    <?php }?>
    <form method="post" action="" class="col-md-6">
        <div class="form-group">
            <label for="TenCL">Tên chủng loại</label>
            <input type="text" name="TenCL" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="ThuTu">Thứ tự</label>
            <input type="text" name="ThuTu" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="AnHien">Trạng thái</label>
            <select name="AnHien" class="form-control">
                <option value="0">Ẩn</option>
                <option value="1">Hiện</option>
            </select>
        </div>
        
        <div class="form-group">
            <input type="submit" name="themchungloai" class="btn btn-primary" />
        </div>
    </form>
</div>