<?php

$dsbinhluan = $sp->laydsbinhluan($_GET['idSP']);

?>
<?php if(count($dsbinhluan) > 0) {?>

<h3 id="binhluan">Bình luận</h3>
<div style="max-height: 320px; overflow:auto;">
    <?php foreach($dsbinhluan as $binhluan){?>
    <div>
        <p style="margin-bottomhp: 0;"><b><?php echo $binhluan['hoten'];?></b> - <i><?php echo date('d-m-Y', strtotime($binhluan['ngay_comment'])) ?></i></p>
        <p><?php echo $binhluan['noidung'];?></p>
        <hr>
    </div>
    <?php }?>
</div>
<?php }?>

<div>
    <p class='btn btn-primary' id='btn-thembinhluan' style="margin-top: 10px;">Gửi bình luận <i class='glyphicon glyphicon-pencil'></i></p>
    <form method="post" action="process.php" id="formbinhluan" style="display:none">
        <input type="hidden" name='chungloai' value="<?php echo $_GET['chungloai'];?>">
        <input type="hidden" name='loaisp' value="<?php echo $_GET['loaisp'];?>">
        <input type="hidden" name='idSP' value="<?php echo $_GET['idSP'];?>">
        <div clas="row">
            <div class="form-group col-md-6">
                <label for="Ten">Tên</label>
                <input type="text" name="hoten" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control">
            </div>    
        </div>
        <div class="form-group">
            <label for="noidung">Nội dung</label>
            <textarea name="noidung" class="form-control" rows="4"></textarea>
        </div>
        <div class="form-group">
            <input type="submit" name="guicomment" value="Gửi" id="guicomment" class="btn btn-default">
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){
        $("#btn-thembinhluan").click(function(){
            $("#formbinhluan").slideDown();
            $("#btn-thembinhluan").hide('slow');
        });
    });
</script>