<form method="get" action="" class="form-inline text-muted">

<div class="form-group">
    <select name="chungloai" class="" style="margin-right: 10px" onchange="this.form.submit();">
        <?php
        $listchungloai = $sp->laydschungloai();
        $i = 0; $k = 0;
        foreach($listchungloai as $chungloai)
        {
            if($i==0) {$idCL = $chungloai['idCL']; $i++;}
        ?>
            <option value="<?php echo $chungloai['idCL'];?>" <?php if(isset($_GET['chungloai']) && $_GET['chungloai'] == $chungloai['idCL']) {echo "selected"; $k=1;}?>><?php echo $chungloai['TenCL'];?></option>
        <?php 
        }
        ?>
    </select>
</div>
    
<div class="form-group">
    <select name="loaisp" class="" style="margin-right: 10px" onchange="this.form.submit();">
        <option value="0">Tất cả các loại</option>
        <?php
        if($k == 1) $idCL = $_GET['chungloai'];
        $listloaisp = $sp->laydsloaisp($idCL);
        $i = 0; $k = 0;
        foreach($listloaisp as $loaisp)
        {
            if($i==0){$idLoai = $loaisp['idLoai']; $i++;}
        ?>
            <option value="<?php echo $loaisp['idLoai'];?>" <?php if(isset($_GET['loaisp']) && $_GET['loaisp'] == $loaisp['idLoai']){ echo "selected"; $k=1;}?>><?php echo $loaisp['TenLoai']; ?></option>
        <?php
        }
        if($k == 1) $idLoai = $_GET['loaisp'];
        ?>
    </select>
</div>
    
<div class="form-group">
    <select name="gia" class="" style="margin-right: 10px" onchange="this.form.submit();">
        <option value="all" <?php if(!isset($_GET['gia']) || $_GET['gia']=='all') echo "selected"; ?> >Mọi mức giá</option>
        <option value="0-20000000" <?php if(isset($_GET['gia']) && $_GET['gia']=='0-20000000') echo "selected"; ?>>Dưới 20 triệu</option>
        <option value="20000000-50000000" <?php if(isset($_GET['gia']) && $_GET['gia']=='20000000-50000000') echo "selected"; ?>>20 - 50 triệu</option>
        <option value="50000000-100000000" <?php if(isset($_GET['gia']) && $_GET['gia']=='50000000-100000000') echo "selected"; ?>>50 - 100 triệu</option>
        <option value="100000000-0" <?php if(isset($_GET['gia']) && $_GET['gia']=='100000000-0') echo "selected"; ?>>Trên 100 triệu</option>
    </select>
</div>
<span>Sắp xếp theo:</span>
<div class="form-group">
    <select name="order" class="text-muted" style="margin-right: 10px" onchange="this.form.submit();">
        <option value='giagiamdan' <?php if(isset($_GET['order']) && $_GET['order'] == 'giagiamdan') echo "selected";?>>Giá giảm dần</option>
        <option value='giatangdan' <?php if(isset($_GET['order']) && $_GET['order'] == 'giatangdan') echo "selected";?>>Giá giảm dần</option>
        <option value='spmoi' <?php if(isset($_GET['order']) && $_GET['order'] == 'spmoi') echo "selected";?>>Sản phẩm mới</option>
        <option value='banchay' <?php if(isset($_GET['order']) && $_GET['order'] == 'banchay') echo "selected";?>>Bán chạy</option>
    </select>
</div>
</form>