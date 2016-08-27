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
        settype($_POST['ThuTu']);
        settype($_POST['AnHien']);
        
        $sql = "INSERT INTO chungloai VALUES (null, '$ten', {$_POST['ThuTu']}, {$_POST['AnHien']})";
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
        settype($_POST['ThuTu']);
        settype($_POST['AnHien']);
        
        $sql = "UPDATE chungloai SET TenCL='$ten', ThuTu={$_POST['ThuTu']}, AnHien={$_POST['AnHien']}  WHERE idCL=$idCL";
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
	
	public function laysanpham($idCL, $idLoai=0, &$totalrows, $current_page=1, $per_page=10){
		settype($idCL, "int"); settype($idLoai, "int");
		
        //tinh tong so dong`
		if($idLoai == 0) $sql = "select count(*) from sanpham where idCL=$idCL";
		  else $sql = "select count(*) from sanpham where idCL=$idCL AND idLoai=$idLoai";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        $row = $result->fetch_array();
        $totalrows = $row[0];
        $start = ($current_page-1)*$per_page;
        
        if($idLoai == 0) $sql = "select * from sanpham where idCL=$idCL limit $start,$per_page";
		  else $sql = "select * from sanpham where idCL=$idCL AND idLoai=$idLoai limit $start,$per_page";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
	}
    
    public function themsanpham(){
        settype($_POST['idLoai'], "int");
        if($_POST['idLoai'] == 0){
            $this->error['idLoai'] = 'Chọn loại sản phẩm';
            return false;
        }
        
        if(!isset($_POST['TenSP'])){
            $this->error['TenSP'] = 'Nhập tên sản phẩm';
            return false;
        }
        
        settype($_POST['Gia'], "int");
        if(!isset($_POST['Gia'])){
            $this->error['Gia'] = 'Nhập tên sản phẩm';
            return false;
        }
        
        $idCL = $_POST['idCL'];        
        $idLoai = $_POST['idLoai'];        
        $ten = $_POST['TenSP'];       
        $gia = $_POST['Gia'];        
        settype($_POST['SoLuongTonKho'], "int");
        $soluongtonkho = $_POST['SoLuongTonKho'];
        $anhien = $_POST['AnHien'];        
        $ngay = date('Y-m-d', time());        
        $ghichu = $_POST['GhiChu'];        
        $mota = $_POST['MoTa'];        
        $baiviet = $_POST['baiviet'];        
        $urlhinh = "https://placeholdit.imgix.net/~text?txtsize=13&txt=updating&w=140&h=185";
        
        $path = 'http://localhost/banhang/upload/sanpham/hinhchinh/';
        
        if(isset($_FILES['urlHinh']['name'])) $urlhinh = basename($_FILES['urlHinh']['name']);
        
        $sql = "INSERT INTO sanpham VALUES(null, $idLoai, $idCL, '$ten', '$mota', '$ngay', $gia, '$urlhinh', '$baiviet', 0, $soluongtonkho, '$ghichu', 0, $anhien)";
        
        if(!$result = $this->db->query($sql)) die("loi ket noi");
    }
    
    public function suasanpham($idSP){
        settype($_POST['idLoai'], "int");
        if($_POST['idLoai'] == 0){
            $this->error['idLoai'] = 'Chọn loại sản phẩm';
            return false;
        }        
        if(!isset($_POST['TenSP'])){
            $this->error['TenSP'] = 'Nhập tên sản phẩm';
            return false;
        }        
        settype($_POST['Gia'], "int");
        if(!isset($_POST['Gia'])){
            $this->error['Gia'] = 'Nhập tên sản phẩm';
            return false;
        }
        
        $idCL = $_POST['idCL'];        
        $idLoai = $_POST['idLoai'];        
        $ten = $_POST['TenSP'];       
        $gia = $_POST['Gia'];        
        settype($_POST['SoLuongTonKho'], "int");
        $soluongtonkho = $_POST['SoLuongTonKho'];
        $anhien = $_POST['AnHien'];        
        $ngay = date('Y-m-d', time());        
        $ghichu = $_POST['GhiChu'];        
        $mota = $_POST['MoTa'];        
        $baiviet = $_POST['baiviet'];        
        $path = 'http://localhost/banhang/upload/sanpham/hinhchinh/';  
        $queryhinh = "";
        if(!empty($_FILES['urlHinh']['name'])){
            $urlhinh = basename($_FILES['urlHinh']['name']);
            $queryhinh = "urlHinh='$urlhinh',";
        }
           
        $sql = "UPDATE sanpham
                SET idLoai=$idLoai, idCL=$idCL, TenSP='$ten',  MoTa='$mota',
                    NgayCapNhat='$ngay', Gia=$gia, $queryhinh baiviet='$baiviet', 
                    SoLuongTonKho=$soluongtonkho,GhiChu='$ghichu',AnHien=$anhien
                WHERE idSP=$idSP";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
    }
    
    private function validate($input){
        $input = $this->db->escape_string($input);
        $input = trim($input);
        return $input;
    }
}