<?php

if(isset($_POST['themsanpham'])) $qt->themsanpham();

?>
<h2>Thêm sản phẩm mới</h2>
<div class="">
    <form method="post" action="" class="row" enctype="multipart/form-data">
    <div class="col-md-6">
        <div class="form-group">
            <label for="idCL">Chủng loại</label>
            <select name="idCL" class="form-control" id="idCL">
                <?php $listchungloai = $qt->laychungloai(0, -1);
                foreach($listchungloai as $chungloai){
                ?>
                <option value="<?php echo $chungloai['idCL'] ?>" <?php if(isset($_POST['idCL']) && $_POST['idCL'] == $chungloai['idCL'])echo "selected";?>><?php echo $chungloai['TenCL'];?></option>
                <?php }?>
            </select>
        </div>
        
        <div class="form-group" >
            <label for="idCL">Loại sản phẩm</label>
            <?php if(isset($qt->errors['idLoai'])) echo " <i class='text-danger'>{$qt->errors['idLoai']}</i>";?>
            <input type="hidden" id="idLoai" value="<?php if(isset($_POST['idLoai'])) echo $_POST['idLoai'];?>">
            <select name="idLoai" class="form-control" id="loaisp">
                <option value="0">Chọn loại sản phẩm</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="TenSP">Tên sản phẩm</label>
            <?php if(isset($qt->errors['TenSP'])) echo " <i class='text-danger'>{$qt->errors['TenSP']}</i>";?>
            <p class="error-message"><?php if(!empty($qt->error['TenSP'])) echo $qt->error['TenSP'];?></p>
            <input type="text" name="TenSP" class="form-control" value="<?php if(isset($_POST['TenSP'])) echo $_POST['TenSP'];?>">
        </div>
        
        <div class="form-group">
            <label for="Gia">Giá</label>
            <?php if(isset($qt->errors['Gia'])) echo " <i class='text-danger'>{$qt->errors['Gia']}</i>";?>
            <input type="text" name="Gia" class="form-control" value="<?php if(isset($_POST['Gia'])) echo $_POST['Gia'];?>">
        </div>
        
        <div class="form-group" style="clear:both;">
            <label for="MoTa" >Mô tả</label>
            <textarea name="MoTa" class="form-control" rows="3"><?php if(isset($_POST['MoTa'])) echo $_POST['MoTa'];?></textarea>
        </div>
    </div>
        
    <div class="col-md-6" style="padding-left: 20px;">
        <div class="form-group">
            <label for="urlHinh">Hình</label>
            <?php if(isset($qt->errors['urlHinh'])) echo " <i class='text-danger'>{$qt->errors['urlHinh']}</i>";?>
            <input type="file" name="urlHinh" />
        </div>
        
        <div class="form-group">
            <label for="SoLuongTonKho">Số sản phẩm trong kho</label>
            <?php if(isset($qt->errors['SoLuongTonKho'])) echo " <i class='text-danger'>{$qt->errors['SoLuongTonKho']}</i>";?>
            <input type="text" name="SoLuongTonKho" class="form-control" value="<?php if(isset($_POST['SoLuongTonKho'])) echo $_POST['SoLuongTonKho'];?>">
        </div>
        
        <div class="form-group">
            <label for="AnHien">Trạng thái</label>
            <select name="AnHien" class="form-control">
                <option value="0">Ẩn</option>
                <option value="1" value="<?php if(isset($_POST['AnHien']) && $_POST['AnHien']==1) echo "selected";?>">Hiện</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="GhiChu">Ghi chú</label>
            <textarea name="GhiChu" class="form-control" rows="2"><?php if(isset($_POST['GhiChu'])) echo $_POST['GhiChu'];?></textarea>
        </div>
        
        <div class="form-group" style="clear:both;">
            <label for="thuoc_tinh" >Tính năng nổi bật</label>
            <textarea name="thuoc_tinh" class="form-control" rows="3"><?php if(isset($_POST['thuoc_tinh'])) echo $_POST['thuoc_tinh'];?></textarea>
        </div>
    </div>
        
        
        
        <div class="form-group" style="clear:both">
            <label for="baiviet">Bài viết</label>
            <textarea name="baiviet" class="form-control tinymce" rows="6"><?php if(isset($_POST['baiviet'])) echo $_POST['baiviet'];?></textarea>
        </div>
        <div class="form-group" >
            <input type="submit" name="themsanpham" class="btn btn-primary" />
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){
        layloaisp();
        $("#idCL").on('change',function(){
            layloaisp();
        });
    });
    
    function layloaisp(){
        $.ajax({
            url: 'process.php',
            async: true,
            type: 'get',
            data: 'a=layloaisp&idCL='+$("#idCL").val()+"&idLoai="+$("#idLoai").val(),
            success: function(data){
                $("#loaisp").html(data);
            }
        });
    }
</script>