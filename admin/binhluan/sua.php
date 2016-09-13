<?php
settype($_GET['id_comment'], "int");

if($_GET['id_comment'] <= 0) header("location: index.php?c=loaisp&a=xem");

$binhluan = $qt->lay1binhluan($_GET['id_comment']);

if(isset($_POST['suabinhluan'])) $qt->suabinhluan($_GET['id_comment']);

?>
<h2>Sửa comment</h2>
<div class="">
    <?php foreach($qt->errors as $error){?>
    <p><?php echo $error;?></p>
    <?php }?>
    <form method="post" action="" class="col-md-6">
        <div class="form-group">
            <label for="hoten">Tên</label>
            <input type="text" name="hoten" value="<?php echo $binhluan['hoten']; ?>" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" value="<?php echo $binhluan['email']; ?>" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="noidung">Nội dung</label>
            <textarea name="noidung" class="form-control" rows="5"><?php echo $binhluan['noidung']; ?></textarea>
        </div>
        
        <div class="form-group">
            <input type="submit" name="suabinhluan" class="btn btn-primary" />
        </div>
    </form>
</div>