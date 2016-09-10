<?php

$dsdonhang = $qt->laydsdonhang(0, $totalrows, $current_page, $per_page);

?>
<h2 class="">Đơn hàng chưa duyệt</h2>
<?php if(isset($_SESSION['success'])) echo "<p class='alert-success' style='padding:10px;'>{$_SESSION['success']}</p>"; unset($_SESSION['success']);?>
<p><b>Còn:</b> <?php echo $totalrows;?> đơn hàng chưa duyệt</p>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th width="150">Thời gian đặt hàng</th>
            <th>Tên khách</th>
            <th>SĐT</th>
            <th>Địa chỉ</th>
            <th width="100">Thanh toán</th>
            <th></th>
        </tr>
    </thead>
    <tbody id="dsbinhluan">
    <?php foreach($dsdonhang as $donhang){ ?>
        <tr>
            <td><?php echo $donhang['idDH'];?></td>
            <td><?php echo $donhang['ThoiDiemDatHang'];?></td>
            <td><?php if($donhang['idUser'] >0) echo " <a href='index.php?a=user' class='text-primary'><i class='glyphicon glyphicon-user'></i>{$donhang['TenNguoiNhan']}</a>"; else echo $donhang['TenNguoiNhan']; ?></td>
            <td><?php echo $donhang['DTNguoiNhan'];?></td>
            <td><span title="<?php echo $donhang['DiaChi'];?>"><?php if(strlen($donhang['DiaChi']) > 30) echo substr($donhang['DiaChi'], 0 , strpos($donhang['DiaChi'], ' ', 25))."...<i class='glyphicon glyphicon glyphicon-plus-sign'></i>"; else echo $donhang['DiaChi'];?></span></td>
            <td><?php if($donhang['DaTraTien']== 0) echo "Chưa"; else echo $donhang['idPTTT'];?></td>
            <td><a href="index.php?a=donhang-chitiet&idDH=<?php echo $donhang['idDH'];?>" class='text-primary'>Xem chi tiết <i class='glyphicon glyphicon-list-alt'></i></a></td> 
        </tr>
    <?php }?>
    </tbody>
</table>
<div>
    <?php
    $url = 'index.php?a=donhang-duyet';
    echo $qt->thanhphantrang($url, $totalrows, $current_page, $per_page, $pages_per_group);
    ?>
</div>