<?php

if(!isset($_GET['idDH']) || $_GET['idDH'] <1) header("location: index.php");
$chitietdonhang = $qt->laychitietdonhang($_GET['idDH']);
$thongtin = $qt->laythongtindonhang($_GET['idDH']);
?>
<h2 class="">Chi tiết đơn hàng số <?php echo $_GET['idDH'] ?></h2>
<div class="row" style="margin-bottom:0;">
<div class="col-md-8">
<h3>Bảng báo giá</h3>
<table class="table table-striped">
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
</div>
</div>
<div>
    <h3 style="margin-top:0;">Thông tin giao dịch</h3>
</div>