<?php
$idCL = isset($_POST['idCL']) ? $_POST['idCL'] : 0;

$listloaisp = $qt->layloaisp($idCL);

?>
<h2 class="">Loại sản phẩm </h2>

<form method="post" action="" class="col-md-6">
    <div class="form-group">
        <label for="idCL">Chủng loại</label>
        <select name="idCL" class="form-control" onchange="this.form.submit()">
            <option value="0">Tất cả chủng loại</option>
            <?php $listchungloai = $qt->laychungloai(0);
            foreach($listchungloai as $chungloai){
            ?>
            <option value="<?php echo $chungloai['idCL'] ?>" <?php if(isset($_POST['idCL']) && $_POST['idCL'] == $chungloai['idCL']) echo "selected";?>><?php echo $chungloai['TenCL'];?></option>
            <?php }?>
        </select>
    </div>
</form>

<table class="table table-striped">
    <thead>
        <tr>
            <th>STT</th>
            <?php if($idCL==0) echo "<th>Chủng loại</th>"; ?>
            <th>Tên</th>
            <th>Thứ tự</th>
            <th>Ẩn/Hiện</th>
            <th><a class="btn btn-sm btn-success btn-them" href="index.php?a=loaisp-them"><span class="glyphicon glyphicon-plus"></span>Thêm mới</a></th>
        </tr>
    </thead>
    <?php $i=1; foreach($listloaisp as $row){?>
    <tr>
        <td><?php echo $i++;?></td>
        <?php if($idCL==0) echo "<td>".$qt->laytenchungloai($row['idCL'])."</td>";?>
        <td><?php echo $row['TenLoai'];?></td>
        <td><?php echo $row['ThuTu'];?></td>
        <td><?php if($row['AnHien']==0) echo "Ẩn"; else echo "Hiện" ;?></td>
        <td><a href="index.php?a=loaisp-sua&idLoai=<?php echo $row['idLoai'];?>">Sửa</a> / <a href="index.php?a=loaisp-xoa&idLoai=<?php echo $row['idLoai'];?>">Xóa</a></td>
    </tr>
    <?php }?>
</table>