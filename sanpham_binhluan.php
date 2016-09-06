<?php

$dsbinhluan = $sp->laydsbinhluan($_GET['idSP']);

?>
<?php if(count($dsbinhluan) > 0) {?>
<div>
    <h3 id="binhluan">Bình luận</h3>
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
    <h3>Để lại bình luận</h3>
    <form method="post" action="process.php">
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
            <textarea name="noidung" class="form-control" rows="4"></textarea>
        </div>
        <div class="form-group">
            <input type="submit" name="guicomment" value="Gửi" id="guicomment" class="btn btn-default">
        </div>
    </form>
</div>
<script>
</script>