<?php session_start(); require_once("classquantri.php"); $qt = new quantri();
if(isset($_GET['c'])) $c = $_GET['c']; else $c = 'stats';
if(isset($_GET['a'])) $a = $_GET['a']; else $a = 'index';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<link rel="stylesheet" href="../css/bootstrap.css"> 
<link rel="stylesheet" href="../css/style.css">
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
</head>
<body>
    
<div class="container">

<div class="row">
    
    <div class="col-md-2">
        <?php include("nav.php");?>
    </div>
    
    <div class="col-md-8 content">
        <?php
        
        if($c == 'chungloai' && $a == 'index') require_once("chungloai/xem.php");
        elseif($c == 'chungloai' && $a == 'them') require_once("chungloai/them.php");
        
        ?>
    </div>

</div>
</div>
<script>
</script>
</body>
</html>