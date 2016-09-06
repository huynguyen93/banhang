<?php

if(!isset($_GET['idCL']) || $_GET['idCL'] < 1) header("location: index.php?a=chungloai-xem");
    
$idCL = $_GET['idCL'];

$chungloai = $qt->laychungloai($idCL);

if(isset($_POST['btnsuachungloai'])) $qt->suachungloai($idCL);

?>
<h2>Cập nhật chủng loại</h2>
<div class="">
    <?php foreach($qt->errors as $error){?>
    <p><?php echo $error;?></p>
    <?php }?>
    <form method="post" action="" class="col-md-6">
        <div class="form-group">
            <label for="TenCL">Tên chủng loại</label>
            <input type="text" name="TenCL" value="<?php echo $chungloai[0]['TenCL']; ?>" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="ThuTu">Thứ tự</label>
            <input type="text" name="ThuTu" value="<?php echo $chungloai[0]['ThuTu']; ?>" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="AnHien">Trạng thái</label>
            <select name="AnHien" class="form-control">
                <option value="0">Ẩn</option>
                <option value="1" <?php if($chungloai[0]['AnHien'] == 1) echo "selected='selected'";?>>Hiện</option>
            </select>
        </div>
        
        <div class="form-group">
            <input type="submit" name="btnsuachungloai" class="btn btn-primary" />
        </div>
    </form>
</div>