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
        if($_POST['idLoai'] == 0){
            $this->errors['idLoai'] = 'Chọn loại sản phẩm';
            return false;
        }
        
        if(empty($_POST['TenSP'])){
            $this->errors['TenSP'] = 'Nhập tên sản phẩm';
            return false;
        }
        
        settype($_POST['Gia'], "int");
        if($_POST['Gia'] == 0){
            $this->errors['Gia'] = 'Nhập giá sản phẩm';
            return false;
        }
        
        $urlHinh = "updating.png";
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
            $newname = $this->changeTitle($_POST['TenSP']) ."-".time(). "." . $file_ext;
            
            //bat dau upload:
            $path = '../upload/sanpham/hinhchinh/' . $newname;
            if(move_uploaded_file($_FILES['urlHinh']['tmp_name'], $path) == false){
                $this->errors['urlHinh'] = 'Có lỗi xảy ra!';
                return false;
            }
            //return
            $urlHinh = $newname;
        }
        
        settype($_POST['Gia'], "int");
        settype($_POST['SoLuongTonKho'], "int");
        $ngay = date('Y-m-d', time());
        
        
        $sql = "INSERT INTO sanpham 
                VALUES(null, {$_POST['idLoai']}, {$_POST['idCL']}, '{$_POST['TenSP']}', 
                            '{$_POST['MoTa']}', '$ngay', {$_POST['Gia']}, '$urlHinh', 
                            '{$_POST['baiviet']}', 0, {$_POST['SoLuongTonKho']}, 
                            '{$_POST['GhiChu']}', 0, {$_POST['AnHien']})";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        $this->errors['thanhcong'] = 'Thêm thành công';
    }
    
    public function suasanpham($idSP){
        settype($_POST['idLoai'], "int");
        if($_POST['idLoai'] == 0){
            $this->errors['idLoai'] = 'Chọn loại sản phẩm';
            return false;
        }
        
        if(!isset($_POST['TenSP'])){
            $this->errors['TenSP'] = 'Nhập tên sản phẩm';
            return false;
        }
        
        settype($_POST['Gia'], "int");
        if(!isset($_POST['Gia'])){
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
        
        $ten = $this->validate($_POST['TenSP']);     
        $ghichu = $this->validate($_POST['GhiChu']);
        $mota = $this->validate($_POST['MoTa']);
        $baiviet = $this->validate($_POST['baiviet']);
        
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
        header("Location: index.php?c=sanpham&a=xem");
    }
    
    public function layuser($idUser = 0){
        if($idUser == 0) $sql = "select * from users";
    }
    
    private function validate($input){
        $input = $this->db->escape_string($input);
        $input = trim($input);
        return $input;
    }
    
    protected function changeTitle($str){
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ', 'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd'=>'đ','D'=>'Đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ', 'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i'=>'í|ì|ỉ|ĩ|ị', 'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ', 'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự', 'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ', 'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
        );
        
        foreach($unicode as $khongdau => $codau){
            $arr = explode("|", $codau);
            $str = str_replace($arr, $khongdau, $str);
        }
        $str = str_replace(array('?', '&', '+', '%', "'", '"','\''), "", $str);
        $str = trim($str);
        while(strpos($str, '  ') > 0) $str = str_replace("  ", " ", $str);
        $str = mb_convert_case($str, MB_CASE_LOWER, 'utf-8');
        $str = str_replace(" ", "-", $str);
        return $str;
    }
    
}