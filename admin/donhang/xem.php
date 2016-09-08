<?php 

$dsdonhang = $qt->laydsdonhang(1, $totalrows, $current_page, $per_page);

?>
<h2 class="">Đơn hàng đã duyệt</h2>
<p><b>Tổng:</b> <?php echo $totalrows;?> đơn hàng đã xử ý</p>

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
            <td class="text-center"><?php if($donhang['DaTraTien']== 0) echo "<i class='glyphicon glyphicon-remove text-danger'></i>"; else echo "<i class='glyphicon glyphicon-ok text-success' style='opacity:1'></i>";?></td>
            <td class="text-right"><?php if($donhang['DaTraTien'] ==0 )  echo "<a href='process.php?datratien={$donhang['idDH']}' class='text-primary'>Đã nhận tiền <i class='glyphicon glyphicon-ok text-success' style='opacity:1'></i></a> | "; ?><a href="index.php?a=donhang-chitiet&idDH=<?php echo $donhang['idDH'];?>" class='text-primary'>Chi tiết <i class='glyphicon glyphicon-list-alt'></i></a></td> 
        </tr>
    <?php }?>
    </tbody>
</table>
<div>
    <?php 
    $url = "index.php?a=donhang-xem";
    echo $qt->thanhphantrang($url, $totalrows, $current_page, $per_page, $pages_per_group);
    ?>
</div>