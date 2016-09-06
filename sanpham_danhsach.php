<?php

$gia = 0;
if(isset($_GET['gia'])) $gia = $_GET['gia'];

$order = 'Gia DESC';
if(isset($_GET['order'])) $order = $_GET['order'];

$listsp = $sp->laydssanpham($idCL, $idLoai, $gia, $order, $totalrows, $current_page , $per_page);

$list_id_spmoi = $sp->layidspmoi($idCL, 10);
?>
<div class="list-sp panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $totalrows;?> sản phẩm</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php foreach($listsp as $row){?>
            <a href="index.php?chungloai=<?php echo $row['idCL'];?>&loaisp=<?php echo $row['idLoai'];?>&idSP=<?php echo $row['idSP'];?>">
            <div class="tomtatsp col-md-2 col-sm-3 thumbnail">
                <center>
                <?php if(in_array($row['idSP'], $list_id_spmoi)){?><span class="spmoi">Mới</span><?php }?>
                <span class="luotmua"><?php echo $row['SoLanMua'] ?> lượt mua</span>
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
        <?php 
        $url = "http://localhost/banhang/index.php?action=sptheoloai&idloai=$idLoai";
        if(isset($_GET['gia'])) $url .= "&gia=$gia&order=$order";
        ?>
        <?php echo $sp->thanhphantrang($url, $totalrows, $current_page, $per_page, $pages_per_group); ?>
    </div>
</div>