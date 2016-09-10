<?php

$listchungloai = $qt->laychungloai(0);

?>
<h2 class="">Chủng loại </h2>
<?php if(isset($_SESSION['fail'])) echo "<p class='alert alert-danger' style='padding:10px;'>{$_SESSION['fail']}</p>"; unset($_SESSION['fail']);?>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Thứ tự</th>
            <th>Ẩn/Hiện</th>
            <th><a class="btn btn-sm btn-success btn-them" href="index.php?a=chungloai-them"><span class="glyphicon glyphicon-plus"></span>Thêm mới</a></th>
        </tr>
    </thead>
    <?php foreach($listchungloai as $row){?>
    <tr>
        <td><?php echo $row['idCL'];?></td>
        <td><?php echo $row['TenCL'];?></td>
        <td><?php echo $row['ThuTu'];?></td>
        <td><?php if($row['AnHien']==0) echo "Ẩn"; else echo "Hiện" ;?></td>
        <td><a href="index.php?a=chungloai-sua&idCL=<?php echo $row['idCL'];?>">Sửa</a> / <a href="index.php?a=chungloai-xoa&idCL=<?php echo $row['idCL'];?>">Xóa</a></td>
    </tr>
    <?php }?>
</table>