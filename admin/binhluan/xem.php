<?php

$dsbinhluan = $qt->laybinhluan(1, $totalrows, $current_page, $per_page);

?>
<h2 class="">Bình luận đã duyệt</h2>
<p><b>Tổng:</b> <?php echo $totalrows;?> bình luận</p>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Sản phẩm</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Nội dung <small>(Rê chuột để xem nhanh)</small></th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody id="dsbinhluan">
    <?php foreach($dsbinhluan as $binhluan){ ?>
        <tr>
            <td><?php echo $binhluan['id_comment'];?></td>
            <td><a class='text-primary' href="http://localhost/banhang/index.php?idSP=<?php echo $binhluan['idSP'];?>"><?php echo $qt->laytensanpham($binhluan['idSP']);?></a></td>
            <td><?php echo $binhluan['hoten'];?></td>
            <td><?php echo $binhluan['email'];?></td>
            <td><span title="<?php echo $binhluan['noidung'];?>"><?php if(strlen($binhluan['noidung']) > 30) echo mb_substr($binhluan['noidung'], 0, strpos($binhluan['noidung'], ' ', 30))."..."; else echo $binhluan['noidung'];?><span></span></td>
            <td><a href="index.php?a=binhluan-sua&id_comment=<?php echo $binhluan['id_comment'];?>">Sửa</a> / <a href="index.php?a=binhluan-xoa&id_comment=<?php echo $binhluan['id_comment'];?>">Xóa</a></td> 
        </tr>
    <?php }?>
    </tbody>
</table>

<div>
    <?php
    $url = "index.php?a=binhluan-xem";
    echo $qt->thanhphantrang($url, $totalrows, $current_page, $per_page, $pages_per_group);
    ?>
</div>
<script>
</script>