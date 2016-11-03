<?php

if(!isset($_GET['idSP']) || $_GET['idSP'] < 1) header("location: index.php?a=sanpham-xem");

$list_hinhphu = $qt->layhinhsp($_GET['idSP']);

if(isset($_POST['uphinhphu'])){
    $qt->uphinhphu($_GET['idSP']);
}
?>

<h2>Cập nhật hình phụ của sản phẩm #<?php echo $_GET['idSP'];?></h2>
<?php if(isset($_SESSION['success'])) echo "<p class='alert alert-success' style='padding:10px;'>{$_SESSION['success']}</p>"; unset($_SESSION['success']);?>

<div class="row">
    <?php foreach($list_hinhphu as $img){?>
    <div class="col-md-3 tomtatsp">
        <center>
        <img class="tomtatsp-hinh" src="../upload/sanpham/hinhphu/<?php echo $img['urlHinh'];?>" />
        <p><?php echo $img['urlHinh'];?></p>
        <p><a class="btn btn-sm btn-default" href="process.php?xoahinh=<?php echo $img['id_hinh']; ?>&urlHinh=<?php echo $img['urlHinh'];?>&idSP=<?php echo $_GET['idSP'];?>">Xóa</a></p>
        </center>
    </div>
    <?php }?>
</div>
<h4>Up hình mới</h4>
<?php if(isset($_SESSION['fail'])) {echo $_SESSION['fail']; unset($_SESSION['fail']);}?>
<form method="post" action="" enctype="multipart/form-data">
    <input type="hidden" name="idSP" value="<?php echo $_GET['idSP'];?>">
    <input type="file" name="hinhphu[]" multiple style="display:inline">
    <input type="submit" name="uphinhphu" class="btn btn-sm btn-success">
    <a href="index.php?a=sanpham-sua&idSP=<?php echo $_GET['idSP'];?>" class="btn btn-sm btn-default">Cập nhật các thông tin khác</a>
</form>

