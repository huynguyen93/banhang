<h2 class="">Danh sách users </h2>

<table class="table table-striped" style="margin-bottom: 0px;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Số lần mua</th>
            <th>Ẩn/Hiện</th>
            <th><a class="btn btn-sm btn-success btn-them" href="index.php?c=sanpham&a=them"><span class="glyphicon glyphicon-plus"></span>Thêm mới</a></th>
        </tr>
    </thead>
    <?php foreach($listsanpham as $row){?>
    <tr>
        <td><?php echo $row['idSP'];?></td>
        <td><?php echo $row['TenSP'];?></td>
        <td><?php echo $row['SoLanMua'];?></td>
        <td><?php if($row['AnHien']==0) echo "Ẩn"; else echo "Hiện" ;?></td>
        <td><a href="index.php?c=sanpham&a=sua&idSP=<?php echo $row['idSP'];?>">Sửa</a> / <a href="index.php?c=sanpham&a=xoa&idSP=<?php echo $row['idSP'];?>">Xóa</a></td>
    </tr>
    <?php }?>
</table>