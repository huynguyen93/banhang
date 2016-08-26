<?php 

$per_page = 8; 

?>

<div class="list-sp panel panel-primary">
    <div class="panel-heading">
        <?php $listsp = $sp->laysptheogia(100000000, 0, $totalrows); ?>
        <h3 class="panel-title">Sản phẩm trên 100 triệu (<?php echo $totalrows; ?> sản phẩm)</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php
            for($i=0; $i<$per_page; $i++){
                if(isset($listsp[$i])){ $row = $listsp[$i];
            ?>
            <a href="index.php?c=sanpham&a=chitiet&idsp=<?php echo $row['idSP'];?>">
            <div class="tomtatsp col-md-3 col-sm-3 thumbnail">
                <center>
                <span class="luotmua"><?php echo $row['SoLanMua'] ?> lượt mua</span>
                <img class="tomtatsp-hinh img-responsive" src="upload/sanpham/hinhchinh/<?php echo $row['urlHinh']; ?>" />
                <p><strong><?php echo $row['TenSP'];?></strong></p>
                    <p class="text-danger"><strong><?php echo number_format($row['Gia'],0,',','.');?></strong><small>đ</small></p>
                </center>
            </div>
            </a>
            <?php }}?>
        </div>
    </div>
</div>

<div class="list-sp panel panel-primary">
    <div class="panel-heading">
        <?php $listsp = $sp->laysptheogia(50000000, 100000000, $totalrows); ?>
        <h3 class="panel-title">Sản phẩm từ 50 -> 100 triệu (<?php echo $totalrows ?> sản phẩm)</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php foreach($listsp as $row){?>
            <a href="index.php?c=sanpham&a=chitiet&idsp=<?php echo $row['idSP'];?>">
            <div class="tomtatsp col-md-3 col-sm-3 col-xs-6 thumbnail">
                <center>
                <span class="luotmua"><?php echo $row['SoLanMua'] ?> lượt mua</span>
                <img class="tomtatsp-hinh img-responsive" src="upload/sanpham/hinhchinh/<?php echo $row['urlHinh']; ?>" />
                <p><strong><?php echo $row['TenSP'];?></strong></p>
                <p class="text-danger"><strong><?php echo number_format($row['Gia'],0,',','.');?><small>đ</small></strong></p>
                </center>
            </div>
            </a>
            <?php }?>
        </div>
    </div>
</div>

<div class="list-sp panel panel-primary">
    <div class="panel-heading">
        <?php $listsp = $sp->laysptheogia(20000000, 50000000, $totalrows); ?>
        <h3 class="panel-title">Sản phẩm từ 20 -> 50 triệu (<?php echo $totalrows ?> sản phẩm)</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php foreach($listsp as $row){?>
            <a href="index.php?c=sanpham&a=chitiet&idsp=<?php echo $row['idSP'];?>">
            <div class="tomtatsp col-md-3 col-sm-3 thumbnail">
                <center>
                <span class="luotmua"><?php echo $row['SoLanMua'] ?> lượt mua</span>
                <img class="tomtatsp-hinh img-responsive" src="upload/sanpham/hinhchinh/<?php echo $row['urlHinh']; ?>" />
                <p><strong><?php echo $row['TenSP'];?></strong></p>
                    <p class="text-danger"><strong><?php echo number_format($row['Gia'],0,',','.');?><small>đ</small></strong></p>
                </center>
            </div>
            </a>
            <?php }?>
        </div>
    </div>
</div>

<div class="list-sp panel panel-primary">
    <div class="panel-heading">
        <?php $listsp = $sp->laysptheogia(0, 20000000, $totalrows); ?>
        <h3 class="panel-title">Sản phẩm dưới 20 triệu (<?php echo $totalrows ?> sản phẩm)</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php 
            for($i=0; $i<$per_page; $i++){
                if(isset($listsp[$i])){ $row = $listsp[$i];
            ?>
            <a href="index.php?c=sanpham&a=chitiet&idsp=<?php echo $row['idSP'];?>">
            <div class="tomtatsp col-md-3 col-sm-3 thumbnail">
                <center>
                <span class="luotmua"><?php echo $row['SoLanMua'] ?> lượt mua</span>
                <img class="tomtatsp-hinh  img-responsive" src="upload/sanpham/hinhchinh/<?php echo $row['urlHinh']; ?>" />
                <p><strong><?php echo $row['TenSP'];?></strong></p>
                <p class="text-danger"><strong><?php echo number_format($row['Gia'],0,',','.');?><small>đ</small></strong></p>
                </center>
            </div>
            </a>
            <?php }}?>
        </div>
    </div>
</div>