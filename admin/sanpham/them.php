<?php

if(isset($_POST['themsanpham'])) $qt->themsanpham();

?>

<h2>Thêm sản phẩm mới</h2>
<div class="">
    <?php foreach($qt->errors as $error){?>
    <p><?php echo $error;?></p>
    <?php }?>
    <form method="post" action="" class="row" enctype="multipart/form-data">
    <div class="col-md-6">
        <div class="form-group">
            <label for="idCL">Chủng loại</label>
            <select name="idCL" class="form-control" id="idCL">
                <?php $listchungloai = $qt->laychungloai(0);
                foreach($listchungloai as $chungloai){
                ?>
                <option value="<?php echo $chungloai['idCL'] ?>"><?php echo $chungloai['TenCL'];?></option>
                <?php }?>
            </select>
        </div>
        
        <div class="form-group" >
            <label for="idCL">Loại sản phẩm</label>
            <select name="idLoai" class="form-control" id="loaisp">
                <option value="0">Chọn loại sản phẩm</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="TenSP">Tên sản phẩm</label>
            <input type="text" name="TenSP" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="Gia">Giá</label>
            <input type="text" name="Gia" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="SoLuongTonKho">Số sản phẩm trong kho</label>
            <input type="text" name="SoLuongTonKho" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="AnHien">Trạng thái</label>
            <select name="AnHien" class="form-control">
                <option value="0">Ẩn</option>
                <option value="1">Hiện</option>
            </select>
        </div>
        
    </div>
    <div class="col-md-6" style="padding-left: 20px;">
        <div class="form-group">
            <label for="urlHinh">Hình</label>
            <input type="file" name="urlHinh" />
        </div>
        
        <div class="form-group">
            <label for="GhiChu">Ghi chú</label>
            <textarea name="GhiChu" class="form-control" rows="2"></textarea>
        </div>
        
        <div class="form-group">
            <label for="MoTa">Mô tả</label>
            <textarea name="MoTa" class="form-control" rows="3"></textarea>
        </div>
        
        <div class="form-group">
            <label for="baiviet">Bài viết</label>
            <textarea name="baiviet" class="form-control" rows="6"></textarea>
        </div>
    </div>
        <div class="form-group" style="clear:both;">
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
            url: 'http://localhost/banhang/admin/process.php',
            type: 'get',
            data: 'a=layloaisp&idCL='+$("#idCL").val(),
            success: function(data){
                $("#loaisp").html(data);
            }
        });
    }
</script>