<div class="col-md-12">
    
    <nav class="navbar navbar-default" style="margin-bottom:0;">
       
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-nav" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="index.php" class="nav-brand">
                <i class="glyphicon glyphicon-apple logo pull-left"></i><b>nhất nghệ</b>
            </a>
            </div>
        <div class="collapse navbar-collapse" id="top-nav">
             
            <ul class="nav navbar-nav navbar-right">
                <?php $listchungloai = $sp->laydschungloai();?>
                <?php
                foreach($listchungloai as $chungloai)
                {
                ?>
                <li class="<?php if(isset($_GET['chungloai']) && $_GET['chungloai'] == $chungloai['idCL']){echo "active-cat";}?>"><a href="index.php?chungloai=<?php echo $chungloai['idCL'];?>"><?php echo $chungloai['TenCL'] ?></a></li>
                <?php
                }
                ?>
                <li class=""><a href="">Tin tức</a></li>
                <li class=""><a href="">Khuyến mãi</a></li>
                <li class="<?php if(isset($_GET['action']) && $_GET['action']=='lienhe') echo "active-cat";?>"><a href="index.php?action=lienhe">Liên hệ</a></li>
                <li>
                    <form class="navbar-form navbar-left pull">
                    <div class="input-group">
                        <form method="get" action="index.php">
                        <input type="text" class="form-control" name="timkiem" value="<?php if(isset($_GET['timkiem'])) echo $_GET['timkiem'];?>" placeholder="Tìm nhanh sản phẩm...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Tìm!</button>
                        </span>
                        </form>
                    </div>
                    </form>
                </li>
            </ul>
            
        </div>
    </nav>
</div>