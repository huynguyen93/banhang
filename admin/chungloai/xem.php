<?php 

$listchungloai = $qt->laydschungloai();

?>
<h2 class="">Chủng loại </h2>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Thứ tự</th>
            <th>Ẩn/Hiện</th>
            <th><a class="btn btn-sm btn-success btn-them" href="index.php?c=chungloai&a=them"><span class="glyphicon glyphicon-plus"></span>Thêm mới</a></th>
        </tr>
    </thead>
    <?php foreach($listchungloai as $row){?>
    <tr>
        <td><?php echo $row['idCL'];?></td>
        <td><?php echo $row['TenCL'];?></td>
        <td><?php echo $row['ThuTu'];?></td>
        <td><?php if($row['AnHien']==0) echo "Ẩn"; else echo "Hiện" ;?></td>
        <td><a href="#">Sửa</a> / <a href="#">Xóa</a></td>
    </tr>
    <?php }?>
</table>