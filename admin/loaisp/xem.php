<?php 

if(isset($_POST['idCL'])) $listloaisp = $qt->layloaisptheochungloai($_POST['idCL']);
  else $listloaisp = $qt->layloaisp(0);

?>
<h2 class="">Loại sản phẩm </h2>

<form method="post" action="" class="col-md-6">
    <div class="form-group">
        <label for="idCL">Chủng loại</label>
        <select name="idCL" class="form-control" onchange="this.form.submit()">
            <?php $listchungloai = $qt->laychungloai(0);
            foreach($listchungloai as $chungloai){
            ?>
            <option value="<?php echo $chungloai['idCL'] ?>" <?php if(isset($_POST['idCL']) && $_POST['idCL'] == $chungloai['idCL']) echo "selected";?>><?php echo $chungloai['TenCL'];?></option>
            <?php }?>
        </select>
    </div>
</form>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>idCL</th>
            <th>Tên</th>
            <th>Thứ tự</th>
            <th>Ẩn/Hiện</th>
            <th><a class="btn btn-sm btn-success btn-them" href="index.php?c=loaisp&a=them"><span class="glyphicon glyphicon-plus"></span>Thêm mới</a></th>
        </tr>
    </thead>
    <?php foreach($listloaisp as $row){?>
    <tr>
        <td><?php echo $row['idLoai'];?></td>
        <td><?php echo $row['idCL'];?></td>
        <td><?php echo $row['TenLoai'];?></td>
        <td><?php echo $row['ThuTu'];?></td>
        <td><?php if($row['AnHien']==0) echo "Ẩn"; else echo "Hiện" ;?></td>
        <td><a href="index.php?c=loaisp&a=sua&idLoai=<?php echo $row['idLoai'];?>">Sửa</a> / <a href="index.php?c=loaisp&a=xoa&idLoai=<?php echo $row['idLoai'];?>">Xóa</a></td>
    </tr>
    <?php }?>
</table>