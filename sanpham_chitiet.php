<?php
$sanpham = $sp->laysptheoid($_GET['idSP']);

if($sanpham == false) return false;

?>
<h1 style="margin-top:0;"><b><?php echo $sanpham['TenSP'] ?></b></h1><hr/>
<div class="row chitietsp">
    <div class="col-xs-6 col-sm-6 col-md-3">
        <?php require_once("sanpham_hinhanh.php");?>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-4">
        <div style="padding: 0 20px;">
        <h2 class="text-danger"><b><?php echo number_format($sanpham['Gia'], 0, ',', '.'); ?></b><small class="text-danger">đ</small></h2>

        <p><?php echo nl2br($sanpham['MoTa']);?></p>
        <p>Còn <b><?php echo $sanpham['SoLuongTonKho'];?></b> sản phẩm</p>
        <a idsp="<?php echo $_GET['idSP'];?>" class="btn btn-success btn-lg btn-block" id="themvaogiohang">Thêm vào giỏ hàng <i class="glyphicon glyphicon-ok" id="plus"></i></a>
        <button class="btn btn-default btn-lg btn-block" style="margin-top:10px;">Đặt mua sản phẩm này</button>
        </div>
    </div>
    
    <div class="col-sm-12 col-md-5 text-muted">
        <h2 class="">Chức năng nổi bật</h2>
        <?php
        echo $sp->laythuoctinhsp($_GET['idSP']);
        ?>
    </div>
</div>
<hr/>
<div class="row">
    <div class="col-md-7"><?php require_once("sanpham_binhluan.php");?></div>
    
    <div class="col-md-5">
        <?php $video = $sp->layvideo($_GET['idSP']); if($video != ''){?>
        <h3>Video sản phẩm</h3>
        <iframe width="480" height="320" src="https://www.youtube.com/embed/<?php echo $video;?>">
        </iframe>
        <?php }?>
    </div>
</div>
<?php 
    $listsptuongduong = $sp->laysptuongduong($idCL, $sanpham['idSP'], 10, 12);
    if(count($listsptuongduong)>0){
?>
<div class="row">
    <h4>Các sản phẩm tương đương:</h4>
    <?php
    
    foreach($listsptuongduong as $sanpham){
        if($sanpham['idSP'] == $_GET['idSP']) continue;
    ?>
    <a href="index.php?idSP=<?php echo $sanpham['idSP']?>"><div class="col-md-2 text-center">
        <center>
        <img class="tomtatsp-hinh img-responsive" src="/banhang/upload/sanpham/hinhchinh/<?php echo $sanpham['urlHinh'];?>">
        <b style="font-size: 12px;"><?php echo ucwords(strtolower($sanpham['TenSP'])); ?></b>
        <p class="text-danger" ><strong><?php echo number_format($sanpham['Gia'],0,',','.');?><small>đ</small></strong></p>
        </center>
    </div></a>
    <?php
    }
    ?>
</div>
<hr/>
<?php }//if count listsptuongduong?>


<script>
    $(document).ready(function(){
        $("#themvaogiohang").click(function(){
            themvaogiohang();
            $("#plus").css('opacity', '1');
            $("#cart").css({'font-size': '30px', 'color':'green'});
            setTimeout(function(){
                $("#plus").css('opacity', '0');
                $("#cart").css({'font-size': '25px', 'color':'#140044'});
                giohangtomtat();
            }, 1000);
        });
    });
</script>