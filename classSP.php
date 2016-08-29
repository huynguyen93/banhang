<?php
    
class sp{
    public $db;
    
    function __construct(){
        $this->db = new mysqli('localhost', 'root', '', 'tm');
        $this->db->set_charset("utf8") or die("ket noi database that bai");
    }
    
    public function laydschungloai(){
        $sql = "select * from chungloai where AnHien=1 order by ThuTu";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }
    
    public function laydsloaisp($idCL){
        $sql = "select * from loaisp where idCL=$idCL and AnHien=1";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }
    
    public function laytenloaitheoid($idloai){
        if($idloai <= 0) header('location: index.php');
        if(!$result = $this->db->query("select TenLoai from loaisp where idLoai=$idloai")) die("loi ket noi");
        if($result->num_rows < 1) header('location: index.php');
        $row = $result->fetch_array();
        return $row[0];
    }
    
    public function laysptheogia($min = 0, $max = 0, $order = 'desc', &$totalrows){
        
        if($min < 0 || $max < 0){
            echo "khong tim thay san pham phu hop";
            return false;
        }
        
        if($max >0 && $min > $max){
            echo "<h4>khong tim thay san pham</h4>";
            return false;
        }
        
        if($max == 0) $sql = "select * from sanpham where Gia>=$min order by Gia $order";
          else $sql = "select * from sanpham where Gia>=$min and Gia<$max order by Gia $order";
        
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        
        if($result->num_rows < 1){
            echo "<h4>khong tim thay san pham</h4>";
            return false;
        }
        
        $totalrows = $result->num_rows;
        
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
        
        if($result->num_rows < 1) header('location: index.php');
        
        $data = $result->fetch_assoc();
        return $data;
    }
    
    public function layid10spmoi($idCL){
        $sql = "select idSP from sanpham WHERE idCL=$idCL order by NgayCapNhat DESC LIMIT 0,10";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        
        if($result->num_rows < 1) header('location: index.php');
        
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row['idSP'];
        }
        return $data;
    }
    
    public function laythuoctinhsp($idSP){
        $sql = "select * from sanpham_thuoctinh where idSP=$idSP";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;        
    }
    
    public function laysptuongduong($gia, $phantram=5){
        $min = $gia*(100-$phantram)/100;
        $max = $gia*(100+$phantram)/100;
        return $this->laysptheogia($min, $max, $totalrows);
    }
    
    public function laysptheoloai($idloai, &$totalrows, $current_page=1, $per_page=5){
        if($idloai <= 0) header('location: index.php');
        
        if(!$result = $this->db->query("select count(*) from sanpham where idLoai=$idloai")) die("loi ket noi");
        if($result->num_rows < 1) header('location: index.php');
        $row = $result->fetch_array();
        $totalrows = $row[0];
        
        if($current_page < 1) $current_page=1;
        
        $start = ceil($current_page-1)*$per_page;
        
        if(!$result = $this->db->query("select * from sanpham where idLoai=$idloai order by Gia desc limit $start, $per_page")) die("loi ket noi");
        
        if($result->num_rows < 1) header('location: index.php');
        
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }
    
    public function laysptheochungloai($idCL, $order='Gia DESC', &$totalrows, $current_page=1, $per_page=5){
        if($idCL <= 0) header('location: index.php');
        
        if(!$result = $this->db->query("select count(*) from sanpham where idCL=$idCL")) die("loi ket noi");
        if($result->num_rows < 1) header('location: index.php');
        $row = $result->fetch_array();
        $totalrows = $row[0];
        
        if($current_page < 1) $current_page=1;
        
        $start = ceil($current_page-1)*$per_page;
        
        if(!$result = $this->db->query("select * from sanpham where idCL=$idCL order by $order limit $start, $per_page")) die("loi ket noi");
        
        if($result->num_rows < 1) header('location: index.php');
        
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

        header("Location: index.php?action=chitiet&idsp={$idsp}");
    }
    
    protected function int($input){
        settype($input, "int");
        return $input;
    }
    
    protected function redirect($url){
        header("Location: $url");
    }
    
}