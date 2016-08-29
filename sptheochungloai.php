<?php


$order = 'Gia DESC';

$listsp = $sp->laysptheochungloai($idCL, $order, $totalrows, $current_page , $per_page);

$idspmoi = $sp->layid10spmoi($idCL);
?>
<div class="list-sp panel panel-default">
    <div class="panel-heading">
        <span class="panel-title"><?php echo $totalrows;?> sản phẩm</span>
        
        
    </div>
    <div class="panel-body">
        <div class="row">
            <?php foreach($listsp as $row){?>
            <a href="index.php?action=chitiet&idsp=<?php echo $row['idSP'];?>">
            <div class="tomtatsp col-md-2 col-sm-3 thumbnail">
                <center>
                <span class="luotmua"><?php echo $row['SoLanMua'] ?> lượt mua</span>
                <?php if(in_array($row['idSP'], $idspmoi)){?>
                <span class="spmoi">Mới</span>
                <?php }?>
<!--                <div class="xemnhanh"><a href="#" class="text-muted">Xem nhanh <i class="glyphicon glyphicon-search"></i></a><br/> </div>-->
                <img class="tomtatsp-hinh  img-responsive" src="upload/sanpham/hinhchinh/<?php echo $row['urlHinh']; ?>" />
                <p><strong><?php echo $row['TenSP'];?></strong></p>
                    <p class="text-danger"><strong><?php echo number_format($row['Gia'],0,',','.');?></strong><small>đ</small></p>
                </center>
            </div>
            </a>
            <?php }?>
        </div>
    </div>
    <div class="panel-footer">
        <?php $url = "http://localhost/banhang/index.php?c=sanpham&a=sptheochungloai&idCL=$idCL" ?>
        <?php echo $sp->thanhphantrang($url, $totalrows, $current_page, $per_page, 5); ?>
    </div>
</div>