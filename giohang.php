<?php
$tongsanpham = 0;
if(count($_SESSION['sanpham']) > 0){
    for($i=0; $i<count($_SESSION['sanpham']); $i++){
        $tongsanpham += $_SESSION['sanpham'][$i]['quantity'];
    }
}

?>
<div class="btn-giohang" id="btn-giohang" style="display:inline-block">
    <a href="index.php?action=xemdonhang">Giỏ hàng<i class="glyphicon glyphicon-shopping-cart" id="cart" style="font-size: 25px;"></i> (<b id="sosanpham"><?php echo $tongsanpham;?></b>)</a>
</div>

<div class="panel panel-default div-giohang" id="div-giohang">
    <div class="panel-body" id="giohang-tomtat">
        
    </div>
</div>
<script>
    $(document).ready(function(){
        giohangtomtat();
    });
</script>