<?php

if(!isset($_GET['idLoai']) || $_GET['idLoai'] < 1) header("location: index.php?a=loaisp-xem");

$loaisp = $qt->sualoaisp($_GET['idLoai']);

if(isset($_POST['btnsualoaisp'])) $qt->sualoaisp($_GET['idLoai']);

?>
<h2>Cập nhật loại sp</h2>
<div class="">
    <form method="post" action="" class="col-md-6">
        
        <div class="form-group">
            <label for="idCL">Chủng loại</label>
            <select name="idCL" class="form-control">
                <?php $listchungloai = $qt->laychungloai(0);
                foreach($listchungloai as $chungloai){
                ?>
                <option value="<?php echo $chungloai['idCL'] ?>" <?php if($loaisp['idCL'] == $chungloai['idCL']) echo "selected";?>><?php echo $chungloai['TenCL'];?></option>
                <?php }?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="TenLoai">Tên loại</label>
            <?php if(isset($qt->errors['TenLoai'])) echo " <i class='text-danger'>{$qt->errors['TenLoai']}</i>";?>
            <input type="text" name="TenLoai" value="<?php if(isset($_POST['TenLoai'])) echo $_POST['TenLoai']; echo $loaisp['TenLoai']; ?>" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="ThuTu">Thứ tự</label>
            <?php if(isset($qt->errors['ThuTu'])) echo " <i class='text-danger'>{$qt->errors['ThuTu']}</i>";?>
            <input type="text" name="ThuTu" value="<?php if(isset($_POST['TenCL'])) echo $_POST['ThuTu']; else echo $loaisp['ThuTu']; ?>" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="AnHien">Trạng thái</label>
            <select name="AnHien" class="form-control">
                <option value="0">Ẩn</option>
                <option value="1" <?php if(isset($_POST['AnHien']) && $_POST['AnHien']==1) echo "selected"; elseif($loaisp['AnHien'] == 1) echo "selected='selected'";?>>Hiện</option>
            </select>
        </div>
        
        <div class="form-group">
            <input type="submit" name="btnsualoaisp" class="btn btn-primary" />
            <a href="index.php?a=loaisp-xem" class="btn btn-default">Cancel</a>
        </div>
    </form>
</div>