<?php
settype($_GET['idSP'], "int");

if($_GET['idSP'] <= 0) header("location: index.php?a=sanpham-xem");

if(isset($_POST['suasanpham'])) $result= $qt->suasanpham($_GET['idSP']);

$sanpham = $qt->laysptheoid($_GET['idSP']);
$sanpham['youtube'] = $qt->layvideo($_GET['idSP']);
?>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'.tinymce' });</script>
<h2>Cập nhật sản phẩm</h2>

<div class="">
    <?php 
    foreach($qt->errors as $error => $message){
        if($error == 'thanhcong') echo "<p class='alert alert-success'>$message</p>";
            else echo "<p class='alert alert-danger'>$message</p>";
    }
    ?>
    <form method="post" action="" class="row" enctype="multipart/form-data">
    <div class="col-md-6">
        <div class="form-group">
            <label for="idCL">Chủng loại</label>
            <select name="idCL" class="form-control" id="idCL">
                <?php $listchungloai = $qt->laychungloai(0);
                foreach($listchungloai as $chungloai){
                ?>
                <option value="<?php echo $chungloai['idCL'] ?>" <?php if($sanpham['idCL'] == $chungloai['idCL'])echo "selected";?>><?php echo $chungloai['TenCL'];?></option>
                <?php }?>
            </select>
        </div>
        
        <div class="form-group" >
            <label for="idCL">Loại sản phẩm</label>
            <input type="hidden" id="idLoai" value="<?php if(isset($_POST['idLoai'])) echo $_POST['idLoai']; else echo $sanpham['idLoai'];?>">
            <select name="idLoai" class="form-control" id="loaisp">
                <option value="0">Chọn loại sản phẩm</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="TenSP">Tên sản phẩm</label>
            <input type="text" name="TenSP" class="form-control" value="<?php if(isset($_POST['TenSP'])) echo $_POST['TenSP']; else echo $sanpham['TenSP'];?>">
        </div>
        
        <div class="form-group">
            <label for="Gia">Giá</label>
            <input type="text" name="Gia" class="form-control" value="<?php if(isset($_POST['Gia'])) echo $_POST['Gia']; else echo $sanpham['Gia'];?>">
        </div>
        <div class="form-group"  style="clear:both;">
            <label for="MoTa">Mô tả</label>
            <textarea  class="form-control" name="MoTa" rows="5"><?php if(isset($_POST['MoTa'])) echo $_POST['MoTa']; else echo $sanpham['MoTa'];?></textarea>
        </div> 
    </div>
    <div class="col-md-6" style="padding-left: 20px;">
        
        <div class="form-group">
            <label for="urlHinh">Hình</label>
            <p class="error-message"><?php if(!empty($qt->error['urlHinh'])) echo $qt->error['urlHinh'];?></p>
            <p><a href="#" class="xemhinhnhanh">Xem hình cũ<img src="http://localhost/banhang/upload/sanpham/hinhchinh/<?php echo $sanpham['urlHinh'];?>"/></a>
            / <a href="#" id="chonhinhmoi">Chọn hình chính mới</a> / <a href="index.php?a=sanpham-hinhphu&idSP=<?php echo $_GET['idSP'];?>">Hình phụ</a></p>
            <input type="file" name="urlHinh" id="uphinh" style="display: none;"/>
        </div>
        
        <div class="form-group">
            <label for="AnHien">Trạng thái</label>
            <select name="AnHien" class="form-control">
                <option value="0">Ẩn</option>
                <option value="1" <?php if(isset($_POST['AnHien']) && $_POST['AnHien']==1) echo "selected"; elseif($sanpham['AnHien'] == 1)echo "selected";?>>Hiện</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="SoLuongTonKho">Số sản phẩm trong kho</label>
            <input type="text" name="SoLuongTonKho" class="form-control" value="<?php if(isset($_POST['SoLuongTonKho'])) echo $_POST['SoLuongTonKho']; else echo $sanpham['SoLuongTonKho'];?>">
        </div>
        
        <div class="form-group">
            <label for="GhiChu">Ghi chú</label>
            <textarea name="GhiChu" class="form-control" rows="2"><?php if(isset($_POST['GhiChu'])) echo $_POST['GhiChu']; else echo $sanpham['GhiChu'];?></textarea>
        </div>
        
        <div class="form-group" style="clear:both;">
            <label for="thuoc_tinh" >Tính năng nổi bật</label>
            <textarea name="thuoc_tinh" class="form-control" rows="3"><?php if(isset($_POST['thuoc_tinh'])) echo $_POST['thuoc_tinh']; else echo $sanpham['thuoc_tinh'];?></textarea>
        </div>
        
        <div class="form-group">
            <label for="youtube">Link youtube</label>
            <input type="text" name="youtube" class="form-control" value="<?php if(isset($_POST['youtube'])) echo "http://youtube.com/watch?v=".$_POST['youtube']; elseif(!empty($sanpham['youtube'])) echo "http://youtube.com/watch?v=".$sanpham['youtube'];?>">
        </div>
        
    </div>
        <div class="form-group" style="clear:both">
            <label for="baiviet">Bài viết</label>
            <textarea class="tinymce form-control" name="baiviet" class="form-control" rows="15"><?php if(isset($_POST['baiviet'])) echo $_POST['baiviet']; else echo $sanpham['baiviet'];?></textarea>
        </div>
        <div class="form-group" >
            <input type="submit" name="suasanpham" class="btn btn-primary" />
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){
        $("#chonhinhmoi").click(function(){
            $("#uphinh").click();
            return false;
        });
        
        layloaisp();
        $("#idCL").on('change',function(){
            layloaisp();
        });
    });
    
    function layloaisp(){
        $.ajax({
            url: 'http://localhost/banhang/admin/process.php',
            type: 'get',
            data: "a=layloaisp&idCL="+$("#idCL").val()+"&idLoai="+$("#idLoai").val(),
            success: function(data){
                $("#loaisp").html(data);
            }
        });
    }
</script>