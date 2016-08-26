<?php

if(isset($_GET['idCL'])) $idCL = $_GET['idCL'];

$listsp = $sp->laysptheochungloai($idCL,$totalrows, $current_page , 5);
?>
<div class="list-sp panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $totalrows;?> sản phẩm</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php foreach($listsp as $row){?>
            <a href="index.php?action=chitiet&idsp=<?php echo $row['idSP'];?>">
            <div class="tomtatsp col-md-5ths col-sm-3">
                <center>
                <span class="luotmua"><?php echo $row['SoLanMua'] ?> lượt mua</span>
                <img class="tomtatsp-hinh thumbnail img-responsive" src="upload/sanpham/hinhchinh/<?php echo $row['urlHinh']; ?>" />
                <p><strong><?php echo $row['TenSP'];?></strong></p>
                    <p class="text-danger"><strong><?php echo number_format($row['Gia'],0,',','.');?></strong><small>đ</small></p>
                </center>
            </div>
            </a>
            <?php }?>
        </div>
    </div>
    <div class="panel-footer">
        <?php $url = "http://localhost/banhang/index.php?action=sptheochungloai&idCL=$idCL" ?>
        <?php echo $sp->thanhphantrang($url, $totalrows, $current_page, 5, 5); ?>
    </div>
</div>