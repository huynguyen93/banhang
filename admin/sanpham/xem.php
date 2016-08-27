

<h2 class="">Sản phẩm </h2>

<form method="get" action="" class="form-inline" style="margin: 20px 0px;">
    <input type="hidden" name="c" value="<?php echo $c;?>">
    <input type="hidden" name="a" value="<?php echo $a;?>">
    <div class="form-group" style="margin-right: 20px;">
        <label for="idCL">Chủng loại</label>
        <select name="idCL" class="form-control" onchange="this.form.submit()">
            <?php $listchungloai = $qt->laychungloai(0);
			$i = 0; $k = 0;
            foreach($listchungloai as $chungloai){
				if($i == 0){$idCL = $chungloai['idCL']; $i++;}
            ?>
            <option value="<?php echo $chungloai['idCL'] ?>" <?php if(isset($_GET['idCL']) && $_GET['idCL'] == $chungloai['idCL']){ echo "selected"; $k=1;}?>><?php echo $chungloai['TenCL'];?></option>
            <?php }?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="idCL">Loại sản phẩm</label>
        <select name="idLoai" class="form-control" onchange="this.form.submit()">
        	<option value="0">Tất cả các loại</option>
            <?php 
			if($k == 1) $idCL = $_GET['idCL'];
			$listloaisp = $qt->layloaisptheochungloai($idCL);
			$idLoai = 0; $k = 0;
            foreach($listloaisp as $loaisp){
            ?>
            <option value="<?php echo $loaisp['idLoai'];?>" <?php if(isset($_GET['idLoai']) && $_GET['idLoai'] == $loaisp['idLoai']){echo "selected"; $k=1;}?>><?php echo $loaisp['TenLoai'];?></option>
            <?php }?>
        </select>
    </div>
</form>

<?php
if($k==1) $idLoai = $_GET['idLoai'];
$per_page = 10;
$current_page = 1;
if(isset($_GET['page'])) $current_page = $_GET['page'];

$listsanpham = $qt->laysanpham($idCL, $idLoai, $totalrows, $current_page, $per_page);

?>
<label>Số sản phẩm: <?php echo $totalrows; ?></label>
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
<div class="row">
    <?php
    
    $url = "http://localhost/banhang/admin/index.php?c=$c&a=$a&idCL=$idCL&idLoai=$idLoai";
    $pages_per_group = 5;
    
    echo $qt->thanhphantrang($url, $totalrows, $current_page, $per_page, $pages_per_group); ?>
</div>