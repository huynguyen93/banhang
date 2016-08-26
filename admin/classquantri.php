<?php require_once("../classSP.php");
class quantri extends sp{
    public $errors = array();
    
    function __construct(){
        parent::__construct();
    }
    
    public function laychungloai($idCL=0){
        // $idCL == 0 -> lay het tat ca;
        if($idCL > 0) $sql = "select * from chungloai where idCL=$idCL";
          else $sql = "select * from chungloai";
        
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }
    
    public function themchungloai(){
        
        if(!isset($_POST['TenCL'])){
            $this->errors['TenCL'] = "Chưa nhập tên chủng loại!";
            return false;
        }
        
        if(!isset($_POST['ThuTu'])){
            $this->errors['TenCL'] = "Chưa nhập thứ tự!";
            return false;
        }
        
        if($_POST['AnHien'] != 0 && $_POST['AnHien'] != 1){
            return false;
        }
        
        $ten = $this->validate($_POST['TenCL']);
        $thutu = $this->validate($_POST['ThuTu']);
        $anhien = $_POST['AnHien'];
        
        $sql = "INSERT INTO chungloai VALUES (null, '$ten', $thutu, $anhien)";
        if(!$result = $this->db->query($sql)) die($sql);
        header("location: index.php?c=chungloai&a=xem");
    }
    
    public function suachungloai($idCL){
        if(!isset($_POST['TenCL'])){
            $this->errors['TenCL'] = "Chưa nhập tên chủng loại!";
            return false;
        }
        
        if(!isset($_POST['ThuTu'])){
            $this->errors['TenCL'] = "Chưa nhập thứ tự!";
            return false;
        }
        
        if($_POST['AnHien'] != 0 && $_POST['AnHien'] != 1){
            return false;
        }
        
        $ten = $this->validate($_POST['TenCL']);
        $thutu = $this->validate($_POST['ThuTu']);
        $anhien = $_POST['AnHien'];
        
        $sql = "UPDATE chungloai SET TenCL='$ten', ThuTu=$thutu, AnHien=$anhien  WHERE idCL=$idCL";
        if(!$result = $this->db->query($sql)) die($sql);
        header("location: index.php?c=chungloai&a=xem");
    }
    
    public function xoachungloai($idCL){
        settype($idCL, "int");
        $sql = "DELETE FROM chungloai  WHERE idCL=$idCL";
        if(!$result = $this->db->query($sql)) die($sql);
        header("location: index.php?c=chungloai&a=xem");
    }
    
    public function layloaisp($idloai=0){
        // $idCL == 0 -> lay het tat ca;
        if($idloai > 0) $sql = "select * from loaisp where idLoai=$idloai";
          else $sql = "select * from loaisp order by idCL";
        
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }
    
    public function layloaisptheochungloai($idCL){
        $sql = "select * from loaisp where idCL=$idCL";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }
    
    public function themloaisp(){
        
        if(!isset($_POST['TenLoai'])){
            $this->errors['TenLoai'] = "Chưa nhập tên chủng loại!";
            return false;
        }
        
        if(!isset($_POST['ThuTu'])){
            $this->errors['ThuTu'] = "Chưa nhập thứ tự!";
            return false;
        }
        
        if($_POST['AnHien'] != 0 && $_POST['AnHien'] != 1){
            return false;
        }
        
        settype($_POST['idCL'], "int");
        settype($_POST['AnHien'], "int");
        
        $idCL = $_POST['idCL'];
        $ten = $this->validate($_POST['TenLoai']);
        $thutu = $this->validate($_POST['ThuTu']);
        $anhien = $_POST['AnHien'];
        
        $sql = "INSERT INTO loaisp VALUES (null, $idCL, '$ten', $thutu, $anhien)";
        if(!$result = $this->db->query($sql)) die($sql);
        header("location: index.php?c=loaisp&a=xem");
    }
    
    public function sualoaisp($idLoai){
        if(!isset($_POST['TenLoai'])){
            $this->errors['TenLoai'] = "Chưa nhập tên loại!";
            return false;
        }
        
        if(!isset($_POST['ThuTu'])){
            $this->errors['ThuTu'] = "Chưa nhập thứ tự!";
            return false;
        }
        
        if($_POST['AnHien'] != 0 && $_POST['AnHien'] != 1){
            return false;
        }
        
        settype($_POST['idCL'], "int");
        settype($_POST['AnHien'], "int");
        
        $idCL = $_POST['idCL'];
        $ten = $this->validate($_POST['TenLoai']);
        $thutu = $this->validate($_POST['ThuTu']);
        $anhien = $_POST['AnHien'];
        
        $sql = "UPDATE loaisp SET idCL=$idCL, TenLoai='$ten', ThuTu=$thutu, AnHien=$anhien WHERE idLoai=$idLoai";
        if(!$result = $this->db->query($sql)) die($sql);
        header("location: index.php?c=loaisp&a=xem");
    }
    
    public function xoaloaisp($idLoai){
        settype($idCL, "int");
        $sql = "DELETE FROM loaisp  WHERE idLoai=$idLoai";
        if(!$result = $this->db->query($sql)) die($sql);
        header("location: index.php?c=loaisp&a=xem");
    }
    
    private function validate($input){
        $input = $this->db->escape_string($input);
        $input = trim($input);
        return $input;
    }
}