<form method="get" action="" class="filter form-inline text-muted">

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
        $idLoai = 0; $k = 0;
        foreach($listloaisp as $loaisp)
        {
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
        <option value="0-2000000" <?php if(isset($_GET['gia']) && $_GET['gia']=='0-20000000') echo "selected"; ?>>Dưới 2 triệu</option>
        <option value="2000000-6000000" <?php if(isset($_GET['gia']) && $_GET['gia']=='20000000-50000000') echo "selected"; ?>>2 - 6 triệu</option>
        <option value="6000000-12000000" <?php if(isset($_GET['gia']) && $_GET['gia']=='50000000-100000000') echo "selected"; ?>>6 - 12 triệu</option>
        <option value="12000000-0" <?php if(isset($_GET['gia']) && $_GET['gia']=='100000000-0') echo "selected"; ?>>Trên 12 triệu</option>
    </select>
</div>
    

<div class="form-group">
    <select name="order" class="text-muted" style="margin-right: 10px" onchange="this.form.submit();">
        <option value='giagiamdan' <?php if(isset($_GET['order']) && $_GET['order'] == 'giagiamdan') echo "selected";?>>Giá giảm dần</option>
        <option value='giatangdan' <?php if(isset($_GET['order']) && $_GET['order'] == 'giatangdan') echo "selected";?>>Giá tăng dần</option>
        <option value='spmoi' <?php if(isset($_GET['order']) && $_GET['order'] == 'spmoi') echo "selected";?>>Sản phẩm mới</option>
        <option value='banchay' <?php if(isset($_GET['order']) && $_GET['order'] == 'banchay') echo "selected";?>>Bán chạy</option>
    </select>
</div>
</form>