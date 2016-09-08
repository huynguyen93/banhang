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
            <?php 
            if(count($listsp) == 0) echo "<h4>Đang cập nhật...!</h4>";
             else foreach($listsp as $sanpham)
            {
            ?>
            <a href="index.php?chungloai=<?php echo $sanpham['idCL'];?>&loaisp=<?php echo $sanpham['idLoai'];?>&idSP=<?php echo $sanpham['idSP'];?>">
            <div class="tomtatsp col-md-2 col-sm-3 thumbnail">
                <center>
                <?php if(in_array($sanpham['idSP'], $list_id_spmoi)){?><span class="spmoi">Mới</span><?php }?>
                <span class="luotmua"><?php echo $sanpham['SoLanMua'] ?> lượt mua</span>
                <img class="tomtatsp-hinh  img-responsive" src="upload/sanpham/hinhchinh/<?php echo $sanpham['urlHinh']; ?>" />
                <p><strong><?php echo $sanpham['TenSP'];?></strong></p>
                    <p class="text-danger"><strong><?php echo number_format($sanpham['Gia'],0,',','.');?></strong><small>đ</small></p>
                </center>
            </div>
            </a>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="panel-footer">
        <?php 
        $url = "http://localhost/banhang/index.php?chungloai=$idCL";
        if(isset($_GET['gia'])) $url .= "&loaisp=$idLoai&gia=$gia&order=$order";
        ?>
        <?php echo $sp->thanhphantrang($url, $totalrows, $current_page, $per_page, $pages_per_group); ?>
    </div>
</div>