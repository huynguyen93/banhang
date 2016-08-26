<?php

if(isset($_POST['themloaisp'])) $qt->themloaisp();

?>

<h2>Thêm loại sản phẩm mới</h2>
<div class="">
    <?php foreach($qt->errors as $error){?>
    <p><?php echo $error;?></p>
    <?php }?>
    <form method="post" action="" class="col-md-6">
        <div class="form-group">
            <label for="idCL">Chủng loại</label>
            <select name="idCL" class="form-control">
                <?php $listchungloai = $qt->laychungloai(0);
                foreach($listchungloai as $chungloai){
                ?>
                <option value="<?php echo $chungloai['idCL'] ?>"><?php echo $chungloai['TenCL'];?></option>
                <?php }?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="TenLoai">Tên loại sản phẩm</label>
            <input type="text" name="TenLoai" class="form-control">
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
            <input type="submit" name="themloaisp" class="btn btn-primary" />
        </div>
    </form>
</div>