<?php 

$dsdonhang = $qt->laydsdonhang(0, $totalrows);

?>
<h2 class="">Đơn hàng chưa duyệt</h2>
<p><b>Còn:</b> <?php echo $totalrows;?> đơn hàng chưa duyệt</p>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Thời gian đặt hàng</th>
            <th>Tên khách</th>
            <th>SĐT</th>
            <th>Địa chỉ</th>
            <th>Thanh toán</th>
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
            <td><?php echo $donhang['DiaChi'];?></td>
            <td><?php if($donhang['DaTraTien']== 0) echo "Chưa"; else echo $donhang['idPTTT'];?></td>
            <td><a href="index.php?a=donhang-chitiet&idDH=<?php echo $donhang['idDH'];?>" class='text-primary'>Xem chi tiết <i class='glyphicon glyphicon-list-alt'></i></a></td> 
        </tr>
    <?php }?>
    </tbody>
</table>