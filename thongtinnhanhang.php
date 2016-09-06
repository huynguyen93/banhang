<?php

if(isset($_SESSION['user_id']))  $user = $u->get_info($_SESSION['user_id']);

//tinh tong so tien:
$tong = 0;
for($i=0; $i<count($_SESSION['sanpham']); $i++){
    $tong += $_SESSION['sanpham'][$i]['price']*$_SESSION['sanpham'][$i]['quantity'];
}

?>
<div class="col-md-4">
    <h2>Thông tin nhận hàng</h2>
    <form method="post" action="process.php" id="formdangky">
        <div class="form-group">
            <label for="HoTen">Tên người nhận</label>
            <input type="text" name="HoTen" value="<?php if(isset($_SESSION['user_id'])) echo $user['HoTen']; ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="Email">Email nhận thông tin</label>
            <input type="email" name="Email" value="<?php if(isset($_SESSION['user_id'])) echo $user['Email']; ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="DienThoai">Số điện thoại người nhận</label>
            <input type="text" name="DienThoai" value="<?php if(isset($_SESSION['user_id'])) echo $user['DienThoai']; ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="DiaChi">Địa chỉ</label>
            <input type="text" name="DiaChi" value="<?php if(isset($_SESSION['user_id'])) echo $user['DiaChi']; ?>" class="form-control">
        </div>
        <div class="form-group ">
            <label for="PTGH">Phương thức nhận hàng</label>
            <select name="PTGH" class="form-control">
                <?php $listPTGH = $sp->layPTGH(); foreach($listPTGH as $PTGH){ ?>
                <option value="<?php echo $PTGH['idPTGH'];?>"><?php echo $PTGH['TenPhuongThucGH'];?></option>
                <?php }?>
            </select>
            <small>*Lưu ý: phương thức giao hàng trực tiếp chỉ áp dụng cho khách hàng trong nội thành TP HCM</small>
        </div>
        <div class="form-group ">
            <label for="PTGH">Phương thức thanh toán</label>
            <select name="PTTT" class="form-control" id="pttt">
                <?php $listPTTT = $sp->layPTTT(); foreach($listPTTT as $PTTT){ ?>
                <option value="<?php echo $PTTT['idPTTT'];?>"><?php echo $PTTT['TenPhuongThucTT'];?></option>
                <?php }?>
            </select>
        </div>
        <div class="form-group">
            <label for="GhiChu">Lời nhắn</label> <small>(có thể bỏ trống)</small>
            <textarea rows='2' name="GhiChu" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="TongTien">Tổng số tiền phải trả</label>
            <input type="hidden" name="TongTien" value="<?php echo $tong;?>">
            <p><?php echo number_format($tong, 0, ',', '.'); ?>đ + 10% VAT = <b class="text-danger"><?php echo number_format($tong*1.1, 0, ',', '.');?>đ</b></p>
        </div>
        <div class="form-group">
            <div class="col-xs-4">
                <button type="submit" name="btn-dathang" href="#" class="btn btn-success btn-block" id="btn-dat">Đặt hàng</button>
            </div>
        </div>
    </form>
    <div id="congthanhtoan">

    </div>
</div>
<hr/>
<script>
    $(document).ready(function(){
        $("#pttt").change(function(){
            var pttt = $("#pttt").val();
            if(pttt == 'tructiep') {
                $("#btn-dat").show();
                $("#congthanhtoan").html("");
                return false;
            }
            
            $.ajax({
                url: 'phuongthucthanhtoan.php',
                type: 'get',
                data: "pttt="+pttt,
                success: function(data){
                    $("#btn-dat").hide();
                    $("#congthanhtoan").html(data);
                }
            });
        });
    });
</script>