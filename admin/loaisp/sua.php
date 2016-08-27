<?php

if(!isset($_GET['idLoai']) || $_GET['idLoai'] < 1) header("location: index.php?c=loaisp&a=xem");
    
$idLoai = $_GET['idLoai'];

$loaisp = $qt->layloaisp($idLoai);

if(isset($_POST['btnsualoaisp'])) $qt->sualoaisp($idLoai);

?>
<h2>Cập nhật loại sp</h2>
<div class="">
    <?php foreach($qt->errors as $error){?>
    <p><?php echo $error;?></p>
    <?php }?>
    <form method="post" action="" class="col-md-6">
        
        <div class="form-group">
            <label for="idCL">Chủng loại</label>
            <select name="idCL" class="form-control" onchange="this.form.submit()">
                <?php $listchungloai = $qt->laychungloai(0);
                foreach($listchungloai as $chungloai){
                ?>
                <option value="<?php echo $chungloai['idCL'] ?>" <?php if($loaisp[0]['idCL'] == $chungloai['idCL']) echo "selected";?>><?php echo $chungloai['TenCL'];?></option>
                <?php }?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="TenLoai">Tên loại</label>
            <input type="text" name="TenLoai" value="<?php echo $loaisp[0]['TenLoai']; ?>" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="ThuTu">Thứ tự</label>
            <input type="text" name="ThuTu" value="<?php echo $loaisp[0]['ThuTu']; ?>" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="AnHien">Trạng thái</label>
            <select name="AnHien" class="form-control">
                <option value="0">Ẩn</option>
                <option value="1" <?php if($loaisp[0]['AnHien'] == 1) echo "selected='selected'";?>>Hiện</option>
            </select>
        </div>
        
        <div class="form-group">
            <input type="submit" name="btnsualoaisp" class="btn btn-primary" />
        </div>
    </form>
</div>