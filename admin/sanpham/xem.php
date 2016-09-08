<h2 class="">Sản phẩm </h2>

<form method="get" action="" class="form-inline" style="margin: 10px 0px;">
    <input type="hidden" name="a" value="sanpham-xem">
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
    
    <div class="form-group" style="margin-right: 20px;">
        <label for="idCL">Loại sản phẩm</label>
        <select name="idLoai" class="form-control" onchange="this.form.submit()">
        	<option value="0">Tất cả các loại</option>
            <?php 
			if($k == 1) $idCL = $_GET['idCL'];
			$listloaisp = $qt->layloaisp($idCL);
			$idLoai = 0; $k = 0;
            foreach($listloaisp as $loaisp){
            ?>
            <option value="<?php echo $loaisp['idLoai'];?>" <?php if(isset($_GET['idLoai']) && $_GET['idLoai'] == $loaisp['idLoai']){echo "selected"; $k=1;}?>><?php echo $loaisp['TenLoai'];?></option>
            <?php }?>
        </select>
    </div>
    <div class="form-group" style="margin-right: 20px;">
        <label id="getrows">Chủng loại</label>
    </div>
</form>

<?php
if($k==1) $idLoai = $_GET['idLoai'];

$listsanpham = $qt->laysanpham($idCL, $idLoai, $totalrows, $current_page, $per_page);

?>
<label id="sendrows">(<?php echo $totalrows; ?> sản phẩm)</label>
<table class="table table-striped" style="margin-bottom: 0px;">
    <thead>
        <tr>
            <th>ID</th>
            <?php if(!isset($_GET['idLoai']) || $_GET['idLoai']==0) echo "<th>Loại</th>";?>
            <th>Tên</th>
            <th>Số lần mua</th>
            <th>Ẩn/Hiện</th>
            <th><a class="btn btn-sm btn-success btn-them" href="index.php?a=sanpham-them"><span class="glyphicon glyphicon-plus"></span>Thêm mới</a></th>
        </tr>
    </thead>
    <?php foreach($listsanpham as $row){?>
    <tr>
        <td><?php echo $row['idSP'];?></td>
        <?php if(!isset($_GET['idLoai']) || $_GET['idLoai']==0) echo "<td>".$qt->laytenloaisp($row['idLoai'])."</td>";?>
        <td><?php echo $row['TenSP'];?></td>
        <td><?php echo $row['SoLanMua'];?></td>
        <td><?php if($row['AnHien']==0) echo "Ẩn"; else echo "Hiện" ;?></td>
        <td><a href="index.php?a=sanpham-sua&idSP=<?php echo $row['idSP'];?>">Sửa</a> / <a href="index.php?a=sanpham-xoa&idSP=<?php echo $row['idSP'];?>">Xóa</a></td>
    </tr>
    <?php }?>
</table>
<div>
    <?php
    
    $url = "http://localhost/banhang/admin/index.php?a=sanpham-xem&idCL=$idCL&idLoai=$idLoai";
    
    
    echo $qt->thanhphantrang($url, $totalrows, $current_page, $per_page, $pages_per_group); ?>
</div>
<script>
    $(document).ready(function(){
        $("#getrows").html($("#sendrows").html());
        $("#sendrows").remove();
    });
</script>