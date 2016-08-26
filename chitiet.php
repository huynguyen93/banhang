<?php
$sanpham = $sp->laysptheoid($_GET['idsp']);
?>
<h1><?php echo $sanpham['TenSP'] ?></h1><hr/>
<div class="row chitietsp">
    <div class="col-md-4">
        <img class="" src="upload/sanpham/hinhchinh/<?php echo $sanpham['urlHinh'];?>"/>

    </div>

    <div class="col-md-7">
        <i class="pull-right">Update: <?php echo date('d-m-Y', strtotime($sanpham['NgayCapNhat']));?></i>

        <h2 class="text-danger"><?php echo number_format($sanpham['Gia'], 0, ',', '.'); ?><small class="text-danger">đ</small></h2>

        <p><?php echo $sanpham['MoTa'];?></p>
        
        <a class="no-hover" href="process.php?action=them&idsp=<?php echo $_GET['idsp'];?>"><button class="btn btn-success btn-lg btn-block">Thêm vào giỏ hàng. <br/><small>(Còn <?php echo $sanpham['SoLuongTonKho'] ?> sản phẩm)</small><?php?></button></a>
        <button class="btn btn-default btn-lg btn-block">Thanh toán</button>
    </div>
</div>
<hr/>

<div class="row">
    <h4>Các sản phẩm tương đương:</h4>
    <?php
    $listsp = $sp->laysptuongduong($sanpham['Gia']);
    foreach($listsp as $sanpham){
        if($sanpham['idSP'] == $_GET['idsp']) continue;
    ?>
    <div class="col-md-5ths text-center">
        <img class="img-responsive" src="upload/sanpham/hinhchinh/<?php echo $sanpham['urlHinh'];?>">
        <b><?php echo $sanpham['TenSP']; ?></b>
        <p class="text-danger"><strong><?php echo number_format($sanpham['Gia'],0,',','.');?><small>đ</small></strong></p>
    </div>
    <?php
    }
    ?>
</div>
<p class="text-right"><a href="#">Xem thêm</a></p>
<hr/>
<script>
    $(document).ready(function(){
        $(".glyphicon-shopping-cart").css('font-size','20px');
    });
</script>