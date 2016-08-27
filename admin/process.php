<?php session_start(); require_once("classquantri.php");
$qt = new quantri;
//lay ds loaisp tu chung loai
if(isset($_GET['a']) && $_GET['a']=='layloaisp' && isset($_GET['idCL'])) 
{
?>
    <option value="0">Chọn loại sản phẩm</option>
    <?php 
    $listloaisp = $qt->layloaisptheochungloai($_GET['idCL']);
    foreach($listloaisp as $loaisp){
    ?>
    <option value="<?php echo $loaisp['idLoai'];?>" <?php if(isset($_GET['idLoai']) && $_GET['idLoai'] == $loaisp['idLoai']){echo "selected";}?>><?php echo $loaisp['TenLoai'];?></option>
    <?php }?>
<?php
}?>