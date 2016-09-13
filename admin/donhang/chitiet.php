<?php
settype($_GET['idDH'], "int");

if($_GET['idDH'] <= 0) header("location: index.php");

$chitietdonhang = $qt->laychitietdonhang($_GET['idDH']);

$thongtin = $qt->laythongtindonhang($_GET['idDH']);
?>
<h2 class="">Chi tiết đơn hàng số <?php echo $_GET['idDH'] ?></h2>
<div class="row" style="margin-bottom:0;">
<div class="col-md-8">
<h3>Bảng báo giá</h3>
<table class="table table-striped" style="margin-bottom:0;">
    <thead>
        <th>STT</th>
        <th>Tên sản phẩm</th>
        <th>Số lượng</th>
        <th class="text-right">Đơn giá</th>
        <th class="text-right">Thành tiền</th>
    </thead>
    <tbody>
        <?php
        $tong=0; $i=1; foreach($chitietdonhang as $chitiet)
        {
        ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><a class="text-primary" href="<?php echo $chitiet['idSP'];?>"><?php echo $chitiet['TenSP']; ?></a></td>
            <td><?php echo $chitiet['SoLuong']; ?></td>
            <td class="text-right"><?php echo number_format($chitiet['Gia'], 0, ',', '.'); ?> đ</td>
            <td class="text-right"><?php echo number_format($chitiet['SoLuong']*$chitiet['Gia'], 0, ',', '.'); ?> đ</td>
        </tr>
        <?php
            $tong += $chitiet['SoLuong']*$chitiet['Gia'];
        }
        ?>
        <tr class="text-right">
            <td colspan="4"><i>Thuế VAT 10%: </i></td>
            <td><?php echo number_format($tong*0.1, 0, ',', '.');?> đ</td>
        </tr>
        <tr class="text-right">
            <td colspan="4"><i>Phí ship hàng: </i></td>
            <td><?php echo $thongtin['Shipping'];?> đ</td>
        </tr>
        <tr class="text-right">
            <td colspan="4"><b>Tổng:</b></td>
            <td><b class="text-danger"><?php echo number_format($tong*1.1+$thongtin['Shipping'], 0, ',', '.');?> đ<b></td>
        </tr>
    </tbody>
</table>
    <h3 style="margin-top:0;">Thông tin giao dịch</h3>
    <table class="table table-striped" style="font-weight: bold">
        <tr>
            <td>Thời điểm đặt hàng:</td>
            <td><?php echo date('H:i:s d-m-Y', strtotime($thongtin['ThoiDiemDatHang'])); ?></td>
        </tr>
        <tr>
            <td>Tên người nhận:</td>
            <td><?php echo $thongtin['TenNguoiNhan']; ?></td>
        </tr>
        <tr>
            <td>SĐT người nhận:</td>
            <td><?php echo $thongtin['DTNguoiNhan']; ?></td>
        </tr>
        <tr>
            <td>Địa chỉ người nhận:</td>
            <td><?php echo $thongtin['DiaChi']; ?></td>
        </tr>
        <tr>
            <td>Phương thức thanh toán:</td>
            <td><?php echo $thongtin['idPTTT']; ?></td>
        </tr>
        <tr>
            <td>Phương thức giao hàng:</td>
            <td><?php echo $thongtin['idPTGH']; ?></td>
        </tr>
        <tr>
            <td>Tổng tiền hàng:</td>
            <td><?php echo number_format($tong, 0, ',', '.'); ?> đ</td>
        </tr>
        <tr>
            <td>Tiền thuế:</td>
            <td><?php echo number_format($tong*0.1, 0, ',', '.');?> đ</td>
        </tr>
        <tr>
            <td>Phí ship hàng:</td>
            <td><?php echo $thongtin['Shipping'];?> đ</td>
        </tr>
        <tr>
            <td>Tổng cộng:</td>
            <td><?php echo number_format($tong*1.1+$thongtin['Shipping'], 0, ',', '.');?> đ</td>
        </tr>
        <tr>
            <td>Ghi chú:</td>
            <td><?php echo $thongtin['GhiChu']; ?></td>
        </tr>
    </table>
</div>
</div>
<?php if($thongtin['DaXuLy'] == 0){ ?>
<a onclick="return xacnhan();" href="process.php?huydonhang=<?php echo $_GET['idDH'];?>" class="btn btn-lg btn-default">HỦY ĐƠN HÀNG</a>
<a href="process.php?duyetdonhang=<?php echo $_GET['idDH'];?>" class="btn btn-lg btn-success">ĐÃ XỬ LÝ XONG</a>
<?php } else {?>
<a href="index.php?a=donhang-xem" class="btn btn-primary btn-lg">Back</a>
<?php }?>
</div>