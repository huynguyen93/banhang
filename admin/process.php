<?php require_once("classquantri.php");
$qt = new quantri;

if(isset($_GET['duyetdonhang'])){
    $qt->duyetdonhang($_GET['duyetdonhang']);
}

elseif(isset($_GET['huydonhang'])){
    $qt->huydonhang($_GET['huydonhang']);
}

elseif(isset($_GET['datratien'])){
    $qt->datratien($_GET['datratien']);
}

elseif(isset($_GET['a']) && $_GET['a']=='layloaisp' && isset($_GET['idCL'])) {
?>
    <option value="0">Chọn loại sản phẩm</option>
    <?php 
    $listloaisp = $qt->layloaisp($_GET['idCL'], -1);
    foreach($listloaisp as $loaisp){
    ?>
    <option value="<?php echo $loaisp['idLoai'];?>" <?php if(isset($_GET['idLoai']) && $_GET['idLoai'] == $loaisp['idLoai']){echo "selected";}?>><?php echo $loaisp['TenLoai'];?></option>
    <?php }?>
<?php
}

elseif(isset($_GET['xoahinh'])){
    $qt->xoahinhphu($_GET['xoahinh'], $_GET['urlHinh'], $_GET['idSP']);
}

elseif(isset($_GET['duyetbinhluan'])){
    $qt->duyetbinhluan($_GET['duyetbinhluan']);
}

elseif(isset($_GET['xoabinhluan'])){
    $qt->xoabinhluan($_GET['xoabinhluan']);
}

elseif(isset($_GET['laybinhluan'])){
?>
    <?php $dsbinhluan = $qt->laybinhluan(0, $totalrows); foreach($dsbinhluan as $binhluan){ ?>
    <tr>
        <td><?php echo $binhluan['id_comment'];?></td>
        <td><a class='text-primary' href="../index.php?idSP=<?php echo $binhluan['idSP'];?>"><?php echo $qt->laytensanpham($binhluan['idSP']);?></a></td>
        <td><?php echo $binhluan['hoten'];?></td>
        <td><?php echo $binhluan['email'];?></td>
        <td><span title="<?php echo $binhluan['noidung'];?>"><?php if(strlen($binhluan['noidung']) > 30) echo mb_substr($binhluan['noidung'], 0, strpos($binhluan['noidung'], ' ', 30))."..."; else echo $binhluan['noidung'];?><span></span></td>
        <td><a href="#" class="duyet" idbl="<?php echo $binhluan['id_comment'];?>">Duyệt</a> / <a href="#" onclick="xacnhan();" class="xoa" idbl="<?php echo $binhluan['id_comment'];?>">Xóa</a></td> 
    </tr>
    <?php }?>
    <tr><td colspan="6"><b>Còn:</b> <?php echo $totalrows;?> bình luận chưa duyệt</td></tr>
<?php
}
