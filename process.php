<?php session_start(); require_once("classSP.php"); $sp = new sp;

if($_GET['action'] == 'them' && isset($_GET['idsp'])){
    
    $sp->themspvaogiohang($_GET['idsp']);
    
}