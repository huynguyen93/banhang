<?php require_once("classDB.php");
    
class sp extends db{
    public $db;
    
    function __construct(){
        parent::__construct();
    }
    
    //lấy danh sách chủng loại
    public function laydschungloai(){
        $sql = "select * from chungloai where AnHien=1 order by ThuTu";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }
    
    //lấy danh sách loại sản phẩm
    public function laydsloaisp($idCL){
        $sql = "select * from loaisp where idCL=$idCL and AnHien=1";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }
    
    public function laydssanpham($idCL, $idLoai, $gia, $order, &$totalrows, $current_page=1, $per_page=5){
        settype($idCL, "int"); settype($idloai, "int");
        
        if($idCL == 0) return false;
        if($idLoai == 0) $idLoai = ''; else $idLoai = "AND idLoai=$idLoai";
        
        
        $min = 0; $max = 0;
        $gia = explode("-", $gia);
        if(count($gia) == 2){
            $min = $gia[0]; $max = $gia[1];
            settype($min, "int"); settype($max, "int");
        }
        if($min == 0) $min = ''; else $min = "AND Gia>=$min";
        if($max == 0) $max = ''; else $max = "AND Gia <=$max";
        
        $this->db->escape_string($order);
        if($order == 'giatangdan') $order = 'Gia ASC';
        elseif($order == 'spmoi') $order = 'NgayCapNhat DESC';
        elseif($order == 'banchay') $order = 'SoLanMua DESC';
        else $order = 'Gia DESC';
        
        $sql = "SELECT count(idSP) FROM sanpham WHERE idCL=$idCL $idLoai $min $max AND AnHien=1 ORDER BY $order";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        if($result->num_rows < 1) echo $sql;
        $row = $result->fetch_array();
        $totalrows = $row[0];
        
        if($current_page < 1) $current_page=1;
        $start = ceil($current_page-1)*$per_page;
        
        $sql = "SELECT idCL, idLoai, idSP, TenSP, Gia, urlHinh, SoLanMua FROM sanpham WHERE idCL=$idCL $idLoai $min $max AND AnHien=1 ORDER BY $order limit $start, $per_page";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }
    
    public function laysptheoid($id){
        if($id <= 0) header('location: index.php');
        
        $sql = "select * from sanpham where idSP=$id";
        
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        
        if($result->num_rows < 1) return false;
        
        $data = $result->fetch_assoc();
        return $data;
    }
    
    public function layidspmoi($idCL, $sosp){
        $sql = "select idSP from sanpham WHERE idCL=$idCL order by NgayCapNhat DESC LIMIT 0,$sosp";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        
        if($result->num_rows < 1) header('location: index.php');
        
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row['idSP'];
        }
        return $data;
    }
    
    public function laythuoctinhsp($idSP){
        $sql = "select thuoc_tinh from sanpham where idSP=$idSP";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        $data = $result->fetch_row();
        return $data[0];        
    }
    
    public function laysptuongduong($idCL, $idSP, $phantram=10, $sosanpham=10){
        
        //lấy giá sản phẩm hiện tại
        $sql = "SELECT Gia FROM sanpham WHERE idCL=$idCL AND idSP=$idSP";
        if(!$result = $this->db->query($sql)) die("loi ket noi sp tuong duong");
        $row = $result->fetch_row();
        $gia = $row[0];
        
        //tính mức giá chênh lệch
        $min = $gia*(100-$phantram)/100;
        $max = $gia*(100+$phantram)/100;
        
        //lấy các sản phẩm theo giá tương đương:
        $sql = "SELECT idSP, TenSP, Gia, urlHinh FROM sanpham WHERE idCL=$idCL AND Gia >=$min AND Gia <=$max AND idSP<>$idSP ORDER BY Gia DESC LIMIT 0,$sosanpham";
        if(!$result = $this->db->query($sql)) die("loi ket noi sp tuong duong");
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;        
    }
    
    public function layhinhsp($idSP){
        $sql = "SELECT urlHinh FROM sanpham_hinh WHERE idSP=$idSP";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }
    
    public function layvideo($idSP){
        $sql = "SELECT value FROM sanpham_youtube WHERE idSP=$idSP";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        $row = $result->fetch_row();
        return $row[0];
    }
    
    public function timkiemsanpham($keyword, &$totalrows, $current_page=1, $per_page=5){
        $keyword = trim($keyword);
        $keyword = $this->db->escape_string($keyword);
        if(empty($keyword)){ header("location: index.php"); return false;}
        
        $sql = "SELECT count(idSP) FROM sanpham WHERE TenSP LIKE '%$keyword%'";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        $row = $result->fetch_row();
        $totalrows = $row[0];
        
        $start = ceil($current_page-1)*$per_page;
        
        $sql = "SELECT idCL, idLoai, idSP, TenSP, Gia, urlHinh, SoLanMua FROM sanpham WHERE TenSP LIKE '%$keyword%' ORDER BY TenSP LIMIT $start, $per_page";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }
    
    
    public function thanhphantrang($url, $totalrows, $current_page, $per_page=5, $pages_per_group=5){
        if($totalrows <= $per_page) return false;
        
        $totalpages = ceil($totalrows/$per_page); if ($totalpages < 2) return false;
        
        $totalgroups = ceil($totalpages/5);
        
        $currentgroup = ceil($current_page/$pages_per_group);
        
        $dau = ($currentgroup-1)*$pages_per_group+1;
        $cuoi = $dau + $pages_per_group - 1; if($cuoi > $totalpages) $cuoi = $totalpages;
        
        $links = "<ul class='pagination'>";
        
        $previousgroup = $dau-$pages_per_group;
        if($currentgroup > 2) $links .= "<li><a href='$url&page=1'>First</a></li>";
        if($currentgroup > 1) $links .= "<li><a href='$url&page=$previousgroup'>&lt;</a></li>";
        
        for($i=$dau; $i<=$cuoi; $i++){
            if($i == $current_page) $links .= "<li class='active'><a href='$url&page=$i'>$i</a></li>";
              else $links .= "<li><a href='$url&page=$i'>$i</a></li>";
        }
        
        $nextgroup = $cuoi+1;
        if($currentgroup < $totalgroups) $links .= "<li><a href='$url&page=$nextgroup'>&gt;</a></li>";
        if($currentgroup < $totalgroups-1) $links .= "<li><a href='$url&page=$totalpages'>Last</a></li>";
        
        $links .= "</ul>";
        
        return $links;
    }
    
    public function themspvaogiohang($idsp){
        $flag = 0;
    
        for($i=0; $i<count($_SESSION['sanpham']); $i++){
            if($_SESSION['sanpham'][$i]['idsp'] == $idsp){
                $_SESSION['sanpham'][$i]['quantity'] += 1;
                $flag = 1;
                break;
            }
        }

        if($flag == 0){
            $k = count($_SESSION['sanpham']);
            $_SESSION['sanpham'][$k]['idsp'] = $idsp;
            $sanpham = $this->laysptheoid($idsp);
            $_SESSION['sanpham'][$k]['quantity'] = 1;
            $_SESSION['sanpham'][$k]['name'] = $sanpham['TenSP'];
            $_SESSION['sanpham'][$k]['price'] = $sanpham['Gia'];
        }
        
        $tongsanpham = 0;
        for($i=0; $i<count($_SESSION['sanpham']); $i++){
            $tongsanpham += $_SESSION['sanpham'][$i]['quantity'];
        }

        echo $tongsanpham;
    }
    
    public function capnhatgiohang(){
        for($i=0; $i<count($_SESSION['sanpham']); $i++){
            $_SESSION['sanpham'][$i]['quantity'] = $_GET['soluong'.$i];
        }
        header("location: index.php?action=xemdonhang");
    }
    
    public function xoaspkhoigiohang($id){
        for($i=$id; $i<(count($_SESSION['sanpham'])-1); $i++){
            $j= $i+1;
            $_SESSION['sanpham'][$i] = $_SESSION['sanpham'][$j];
        }
        unset($_SESSION['sanpham'][(count($_SESSION['sanpham'])-1)]);
        header("location: index.php?action=xemdonhang");
    }
    
    public function layPTGH(){
        $sql = "SELECT * FROM phuongthucgiaohang ORDER BY ThuTU";
        if(!$result = $this->db->query($sql)) die("lỗi kết nối, vui lòng thử lại");
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }
    
    public function layPTTT(){
        $sql = "SELECT * FROM phuongthucthanhtoan ORDER BY ThuTU";
        if(!$result = $this->db->query($sql)) die("lỗi kết nối, vui lòng thử lại");
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }
    
    public function layformthanhtoan($pttt){
        $sql = "SELECT Code FROM phuongthucthanhtoan WHERE idPTTT='$pttt' ORDER BY ThuTU";
        if(!$result = $this->db->query($sql)) die("lỗi kết nối, vui lòng thử lại");
        $row = $result->fetch_row();
        return $row[0];
    }
    
    public function dathang(){
        $idUser = 0;
        if(isset($_SESSION['user_id'])) $idUser = $_SESSION['user_id'];
        
        $ThoiDiemDatHang = date("Y-m-d H:i:s", time());
        
        $TenNguoiNhan = trim($_POST['HoTen']);
        $TenNguoiNhan = $this->db->escape_string($TenNguoiNhan);
        
        $DTNguoiNhan = trim($_POST['DienThoai']);
        $DTNguoiNhan = $this->db->escape_string($DTNguoiNhan);
        
        $DiaChi = trim($_POST['DiaChi']);
        $DiaChi = $this->db->escape_string($DiaChi);
        
        settype($_POST['TongTien'], "int");
        $TongTien = $_POST['TongTien'];
        
        $idPTTT = $_POST['PTTT'];
        
        $idPTGH = $_POST['PTGH'];
        
        $tax = $TongTien*0.1;
        
        $GhiChu = trim($_POST['GhiChu']);
        $GhiChu = $this->db->escape_string($GhiChu);
        
        $sql = "INSERT INTO donhang VALUES(null, $idUser, '$ThoiDiemDatHang', '$TenNguoiNhan', 
                '$DTNguoiNhan', '$DiaChi', $TongTien, '$idPTTT', '$idPTGH', $tax, 
                0, 0, '$GhiChu', 0)";
        if(!$result = $this->db->query($sql)) die($sql);
        $idDH = $this->db->insert_id;
        
        for($i=0; $i < count($_SESSION['sanpham']); $i++){
            $sql = "INSERT INTO donhangchitiet VALUES(null, $idDH, {$_SESSION['sanpham'][$i]['idsp']},
                    '{$_SESSION['sanpham'][$i]['name']}', '{$_SESSION['sanpham'][$i]['quantity']}',
                    {$_SESSION['sanpham'][$i]['price']})";
            if(!$result = $this->db->query($sql)) die("lỗi kết nối, vui lòng thử lại");
        }
        unset($_SESSION['sanpham']);
        
        header("location: index.php?action=thanhcong");
    }
    
    public function laydsbinhluan($idSP){
        $sql = "SELECT hoten, noidung, ngay_comment FROM sanpham_comment WHERE idSP=$idSP AND kiem_duyet=1 ORDER BY id_comment";
        if(!$result = $this->db->query($sql)) die($sql);
        
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }
    
    public function binhluan(){
        $hoten = strip_tags($_POST['hoten']);
        $hoten = $this->db->escape_string($hoten);
        $hoten = trim($hoten);
        
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)==false) return false;
        $email = strip_tags($_POST['email']);
        $email = $this->db->escape_string($email);
        $email = trim($email);
        
        $noidung = strip_tags($_POST['noidung']);
        $noidung = $this->db->escape_string($noidung);
        $noidung = trim($noidung);
        $noidung = nl2br($noidung);
        
        $ngay = date("Y-m-d", time());
        
        $sql = "INSERT INTO sanpham_comment (idSP, hoten, email, noidung, ngay_comment)
                VALUES ({$_POST['idSP']}, '$hoten', '$email', '$noidung', '$ngay')";
        if(!$result = $this->db->query($sql)) die($sql);
        header("location: index.php?chungloai={$_POST['chungloai']}&loaisp={$_POST['loaisp']}&idSP={$_POST['idSP']}#binhluan");
    }
}