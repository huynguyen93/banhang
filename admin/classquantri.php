<?php require_once("../classSP.php");
class quantri extends sp{
    public $errors = array();
    
    function __construct(){
        parent::__construct();
    }
    
    public function laydsdonhang($daxuly, &$totalrows, $current_page=1, $per_page=10){
        $sql = "SELECT count(idDH) FROM donhang WHERE DaXuLy=$daxuly";
        if(!$result = $this->db->query($sql)) die("Loi ket noi");
        $row = $result->fetch_row();
        $totalrows = $row[0];
        
        $start = ($current_page-1)*$per_page;   
        
        $sql = "SELECT idDH, idUser, ThoiDiemDatHang, TenNguoiNhan, DTNguoiNhan, DiaChi, DaTraTien FROM donhang WHERE DaXuLy=$daxuly ORDER BY idDH DESC LIMIT $start, $per_page";
        if(!$result = $this->db->query($sql)) die("Loi ket noi");
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }
    
    public function laychitietdonhang($idDH){
        $sql = "SELECT * FROM donhangchitiet WHERE idDH=$idDH";
        if(!$result = $this->db->query($sql)) die("Loi ket noi");
        
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }
    
    public function laythongtindonhang($idDH){
        $sql = "SELECT * FROM donhang WHERE idDH=$idDH";
        if(!$result = $this->db->query($sql)) die("Loi ket noi");
        $data = $result->fetch_assoc();
        return $data;
    }
    
    public function duyetdonhang($idDH){
        $sql = "UPDATE donhang SET DaXuLy=1 WHERE idDH=$idDH";
        if(!$result= $this->db->query($sql)) die("Loi ket noi");
        header("location: index.php?a=donhang-duyet");
    }
    
    public function huydonhang($idDH){
        $sql = "DELETE FROM donhang WHERE idDH=$idDH";
        if(!$result= $this->db->query($sql)) die("Loi ket noi");
        header("location: index.php?a=donhang-duyet");
    }
    
    public function datratien($idDH){
        $sql = "UPDATE donhang SET DaTraTien=1 WHERE idDH=$idDH";
        if(!$result= $this->db->query($sql)) die("Loi ket noi");
        header("location: index.php?a=donhang-xem");
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
        $_POST['TenCL'] = trim($_POST['TenCL']);
        $_POST['ThuTu'] = trim($_POST['ThuTu']);
        
        if(empty($_POST['TenCL'])) $this->errors['TenCL'] = "Không được bỏ trống trường này!";
        if(empty($_POST['ThuTu'])) $this->errors['ThuTu'] = "Không được bỏ trống trường này!";
        if(!is_numeric($_POST['ThuTu'])) $this->errors['ThuTu'] = "Trường này phải nhập số!";
        
        if(count($this->errors) > 0) return false;
        
        $ten = $this->db->escape_string($_POST['TenCL']);
        
        $sql = "INSERT INTO chungloai VALUES (null, '$ten', {$_POST['ThuTu']}, {$_POST['AnHien']})";
        if(!$result = $this->db->query($sql)) die($sql);
        header("location: index.php?a=chungloai-xem");
    }
    
    public function suachungloai($idCL){
        $_POST['TenCL'] = trim($_POST['TenCL']);
        $_POST['ThuTu'] = trim($_POST['ThuTu']);
        
        if(empty($_POST['TenCL'])) $this->errors['TenCL'] = "Không được bỏ trống trường này!";
        if(empty($_POST['ThuTu'])) $this->errors['ThuTu'] = "Không được bỏ trống trường này!";
        if(!is_numeric($_POST['ThuTu'])) $this->errors['ThuTu'] = "Trường này phải nhập số!";
        
        if(count($this->errors) > 0) return false;
        
        $ten = $this->db->escape_string($_POST['TenCL']);
        
        $sql = "UPDATE chungloai SET TenCL='$ten', ThuTu={$_POST['ThuTu']}, AnHien={$_POST['AnHien']}  WHERE idCL=$idCL";
        if(!$result = $this->db->query($sql)) die($sql);
        header("location: index.php?a=chungloai-xem");
    }
    
    public function xoachungloai($idCL){
        $sql = "DELETE FROM chungloai WHERE idCL=$idCL";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        header("location: index.php?a=chungloai-xem");
    }
    
    public function laytenchungloai($idCL){
        $sql = "SELECT TenCL FROM chungloai WHERE idCL=$idCL";
        $result = $this->db->query($sql);
        $row = $result->fetch_row();
        return $row[0];
    }
    
    public function layloaisp($idCL){
        if($idCL == 0) $sql = "select * from loaisp order by idCL ";
          else $sql = "select * from loaisp where idCL=$idCL";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }
    
    public function themloaisp(){
        $_POST['TenLoai'] = trim($_POST['TenLoai']);
        $_POST['ThuTu'] = trim($_POST['ThuTu']);
        
        if(empty($_POST['TenLoai'])) $this->errors['TenLoai'] = "Không được bỏ trống trường này!";
        if(!is_numeric($_POST['ThuTu'])) $this->errors['ThuTu'] = "Trường này phải nhập số!";
        if(empty($_POST['ThuTu'])) $this->errors['ThuTu'] = "Không được bỏ trống trường này!";
        
        if(count($this->errors) > 0) return false;
        
        $ten = $this->db->escape_string($_POST['TenLoai']);
        
        $sql = "INSERT INTO loaisp VALUES (null, {$_POST['idCL']}, '$ten', {$_POST['ThuTu']}, {$_POST['AnHien']})";
        if(!$result = $this->db->query($sql)) die($sql);
        header("location: index.php?a=loaisp-xem");
    }
    
    public function sualoaisp($idLoai){
        if(!isset($_POST['btnsualoaisp'])){
            $sql = "SELECT * FROM loaisp WHERE idLoai = $idLoai";
            if(!$result = $this->db->query($sql)) die("loi ket noi");
            $row = $result->fetch_assoc();
            return $row;
        }
        
        $_POST['TenLoai'] = trim($_POST['TenLoai']);
        $_POST['ThuTu'] = trim($_POST['ThuTu']);
        
        if(empty($_POST['TenLoai'])) $this->errors['TenLoai'] = "Không được bỏ trống trường này!";
        if(!is_numeric($_POST['ThuTu'])) $this->errors['ThuTu'] = "Trường này phải nhập số!";
        if(empty($_POST['ThuTu'])) $this->errors['ThuTu'] = "Không được bỏ trống trường này!";
        
        if(count($this->errors) > 0) return false;
        
        $ten = $this->db->escape_string($_POST['TenLoai']);
        
        $sql = "UPDATE loaisp SET idCL={$_POST['idCL']}, TenLoai='$ten', ThuTu={$_POST['ThuTu']}, AnHien={$_POST['AnHien']} WHERE idLoai=$idLoai";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        header("location: index.php?a=loaisp-xem");
    }
    
    public function xoaloaisp($idLoai){
        $sql = "DELETE FROM loaisp  WHERE idLoai=$idLoai";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        header("location: index.php?a=loaisp-xem");
    }
	
    public function laytenloaisp($idLoai){
        $sql = "SELECT TenLoai FROM loaisp WHERE idLoai=$idLoai";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        $row = $result->fetch_row();
        return $row[0];
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
        
        if($idLoai == 0) $sql = "select * from sanpham where idCL=$idCL order by idSP DESC limit $start,$per_page";
		  else $sql = "select * from sanpham where idCL=$idCL AND idLoai=$idLoai order by idSP DESC limit $start,$per_page";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
	}
    
    public function themsanpham(){
        $_POST['TenSP'] = trim($_POST['TenSP']);
        $_POST['Gia'] = trim($_POST['Gia']);
        
        if($_POST['idLoai'] ==0 ) $this->errors['idLoai'] = "Chọn loại sản phẩm!";
        if(empty($_POST['TenSP'])) $this->errors['TenSP'] = "Không được bỏ trống trường này!";
        if(!is_numeric($_POST['Gia'])) $this->errors['Gia'] = "Trường này phải nhập số!";
        if(!empty($_POST['SoLuongTonKho']) && !is_numeric($_POST['SoLuongTonKho'])) $this->errors['SoLuongTonKho'] = "Trường này phải nhập số!";
        if(empty($_POST['Gia'])) $this->errors['Gia'] = "Không được bỏ trống trường này!";
        
        if(count($this->errors) > 0) return false;
        
        $urlHinh = "updating.png";
        //nếu có up hình:
        if($_FILES['urlHinh']['error'] != 4){
            //kiem tra dinh dang file hinh upload
            $ext_list = array("jpeg", "png", "jpg");
            $file_ext = pathinfo($_FILES['urlHinh']['name'], PATHINFO_EXTENSION);
            if(!in_array($file_ext, $ext_list)){
                $this->errors['urlHinh'] = 'Chỉ chấp nhận các định dạng: jpeg, png, jpg!';
                return false;
            }
            //kiem tra dung luong hinh upload:
            $max_size = 1024*1024*2;
            if($_FILES['urlHinh']['size'] > $max_size){
                $this->errors['urlHinh'] = 'Chỉ chấp nhận hình dưới 2MB!';
                return false;
            }
            //loi he thong, mang:
            if($_FILES['urlHinh']['error'] > 0){
                $this->errors['urlHinh'] = 'Có lỗi xảy ra, xin thử lại!';
                return false;
            }
            //ten hinh luu lai:
            $newname = $this->changeTitle($_POST['TenSP']) ."-".time(). "." . $file_ext;
            
            //bat dau upload:
            if(empty($this->errors['urlHinh'])){
                $path = '../upload/sanpham/hinhchinh/' . $newname;
                if(move_uploaded_file($_FILES['urlHinh']['tmp_name'], $path) == false){
                    $this->errors['urlHinh'] = 'Có lỗi xảy ra, xin thử lại!';
                    return false;
                }
                //return
                $urlHinh = $newname;
            }
        }
        
        settype($_POST['SoLuongTonKho'], "int");
        $ngay = date('Y-m-d', time());
        
        $sql = "INSERT INTO sanpham 
                VALUES(null, {$_POST['idLoai']}, {$_POST['idCL']}, '{$_POST['TenSP']}', 
                            '{$_POST['MoTa']}', '$ngay', {$_POST['Gia']}, '$urlHinh', 
                            '{$_POST['baiviet']}', 0, {$_POST['SoLuongTonKho']}, 
                            '{$_POST['GhiChu']}', 0, {$_POST['AnHien']})";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        header("location: index.php?a=sanpham-xem");
    }
    
    public function suasanpham($idSP){
        if($_POST['idLoai'] == 0){
            $this->errors['idLoai'] = 'Chọn loại sản phẩm';
            return false;
        }
        
        if(!isset($_POST['TenSP'])){
            $this->errors['TenSP'] = 'Nhập tên sản phẩm';
            return false;
        }
        
        settype($_POST['Gia'], "int");
        if($_POST['Gia'] == 0){
            $this->errors['Gia'] = 'Nhập tên sản phẩm';
            return false;
        }
        //kiem tra neu upload hinh moi
        $queryhinh = "";
        if($_FILES['urlHinh']['error'] != 4){
            //kiem tra dinh dang file hinh upload
            $ext_list = array("jpeg", "png", "jpg");
            $file_ext = pathinfo($_FILES['urlHinh']['name'], PATHINFO_EXTENSION);
            if(!in_array($file_ext, $ext_list)){
                $this->errors['urlHinh'] = 'Chỉ chấp nhận các định dạng: jpeg, png, jpg!';
                return false;
            }
            //kiem tra dung luong hinh upload:
            $max_size = 1024*1024*2;
            if($_FILES['urlHinh']['size'] > $max_size){
                $this->errors['urlHinh'] = 'Chỉ chấp nhận hình dưới 2MB!';
                return false;
            }
            //loi he thong, mang:
            if($_FILES['urlHinh']['error'] > 0){
                $this->errors['urlHinh'] = 'Có lỗi xảy ra!';
                return false;
            }
            //ten hinh luu lai:
            $urlHinh = $this->changeTitle($_POST['TenSP']) ."-".time(). "." . $file_ext;
            //bat dau upload:
            $path = '../upload/sanpham/hinhchinh/' . $urlHinh;
            if(move_uploaded_file($_FILES['urlHinh']['tmp_name'], $path) == false){
                $this->errors['urlHinh'] = 'Có lỗi xảy ra!';
                return false;
            }
            
            //xoa hinh cu:
            $sql = "select urlHinh from sanpham where idSP=$idSP";
            if(!$result = $this->db->query($sql)) die("loi ket noi");
            $row = $result->fetch_assoc();
            $hinhcu = $row['urlHinh'];
            //return
            $queryhinh = "urlHinh='$urlHinh',";
        }
        
        settype($_POST['idCL'], "int");
        settype($_POST['idLoai'], "int");
        settype($_POST['SoLuongTonKho'], "int");
        settype($_POST['AnHien'], "int");
        settype($_POST['Gia'], "int");
        
        $ten = $this->db->escape_string($_POST['TenSP']);     
        $ghichu = $this->db->escape_string($_POST['GhiChu']);
        $mota = $this->db->escape_string($_POST['MoTa']);
        $baiviet = $this->db->escape_string($_POST['baiviet']);
        
        $ngay = date('Y-m-d', time());  
           
        $sql = "UPDATE sanpham
                SET idLoai={$_POST['idLoai']}, idCL={$_POST['idCL']}, TenSP='$ten',  MoTa='$mota',
                    NgayCapNhat='$ngay', Gia={$_POST['Gia']}, $queryhinh baiviet='$baiviet', 
                    SoLuongTonKho={$_POST['SoLuongTonKho']},GhiChu='$ghichu',AnHien={$_POST['AnHien']}
                WHERE idSP=$idSP";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        $this->errors['thanhcong'] = "Sửa thành công";
        //xoa hinh cu:
        if(!isset($hinhcu)) return true;
        if($hinhcu != "updating.png") unlink('../upload/sanpham/hinhchinh/'.$hinhcu);
    }
    
    public function xoasanpham($idSP){
        //lay urlHinh san pham de xoa:
        $sql = "SELECT urlHinh from sanpham WHERE idSP=$idSP";
        if(!$result = $this->db->query($sql)) die("Loi ket noi");
        $row = $result->fetch_array();
        $urlHinh = $row[0];
        $path = '../upload/sanpham/hinhchinh/' . $urlHinh;
        
        //xoa du lieu:
        $sql = "DELETE FROM sanpham WHERE idSP=$idSP";
        if(!$result = $this->db->query($sql)) die("Loi ket noi");
        if(!empty($urlHinh)) unlink($path);
        header("Location: index.php?a=sanpham-xem");
    }
    
    public function laytensanpham($idSP){
        $sql = "SELECT TenSP from sanpham WHERE idSP=$idSP";
        if(!$result = $this->db->query($sql));
        $row = $result->fetch_row();
        return $row[0];
    }
    
    public function laybinhluan($kiem_duyet=0, &$totalrows, $current_page=1, $per_page=10){
        $sql = "SELECT count(id_comment) FROM sanpham_comment WHERE kiem_duyet=$kiem_duyet";
        if(!$result = $this->db->query($sql));
        $row = $result->fetch_row();
        $totalrows = $row[0];
        
        $start = ($current_page-1)*$per_page;
        
        $sql = "SELECT * FROM sanpham_comment WHERE kiem_duyet=$kiem_duyet ORDER BY id_comment DESC LIMIT $start, $per_page";
        if(!$result = $this->db->query($sql));
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }
    
    public function lay1binhluan($idBL){
        $sql = "SELECT * FROM sanpham_comment WHERE id_comment=$idBL";
        if(!$result = $this->db->query($sql));
        $data = $result->fetch_assoc();
        return $data;
    }
    
    public function duyetbinhluan($idBL){
        $sql = "UPDATE sanpham_comment SET kiem_duyet=1 WHERE id_comment=$idBL";
        if(!$result = $this->db->query($sql)) die($sql);
        echo "duyet thanh cong";
    }
    
    public function suabinhluan($idBL){
        $hoten = $this->db->escape_string($_POST['hoten']);
        $email = $this->db->escape_string($_POST['email']);
        $noidung = $this->db->escape_string($_POST['noidung']);
        $noidung = nl2br($noidung);
        
        $sql = "UPDATE sanpham_comment SET hoten='$hoten', email='$email', noidung='$noidung' WHERE id_comment=$idBL";
        if(!$result = $this->db->query($sql)) die($sql);
    }
    
    public function xoabinhluan($idBL){
        $sql = "DELETE FROM sanpham_comment WHERE id_comment=$idBL";
        if(!$result = $this->db->query($sql)) die($sql);
    }
    
    public function layuser($idUser = 0){
        if($idUser == 0) $sql = "select * from users";
    }
    
    private function validate($input){
        $input = $this->db->escape_string($input);
        $input = trim($input);
        return $input;
    }
    
}