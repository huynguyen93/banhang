<?php
settype($_GET['id_comment'], "int");

if($_GET['id_comment'] <= 0) header("location: index.php?a=binhluan-xem");

$qt->xoabinhluan($_GET['id_comment']);

header("location: index.php?a=binhluan-xem");