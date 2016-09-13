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
        $_SESSION['success'] = 'Đơn hàng đã được xử lý thành công!';
        header("location: index.php?a=donhang-duyet");
    }

    public function huydonhang($idDH){
        $sql = "DELETE FROM donhang WHERE idDH=$idDH";
        if(!$result= $this->db->query($sql)) die("Loi ket noi");
        $_SESSION['success'] = 'Đơn hàng đã được hủy!';
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
        $sql = "SELECT count(idLoai) FROM loaisp WHERE idCL = $idCL";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        $row = $result->fetch_row();
        if($row[0] > 0){
            $_SESSION['fail'] = 'Chưa xóa được! Xin hãy xóa hết các loại sản phẩm thuộc chủng loại này trước!';
            header("location: index.php?a=chungloai-xem");
            return false;
        }
        
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
        $_SESSION['success'] = 'Đã thêm thành công 1 loại sản phẩm';
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
        $_SESSION['success'] = 'Loại sản phẩm đã được cập nhật thành công';
    }

    public function xoaloaisp($idLoai){
        $sql = "SELECT count(idSP) FROM sanpham WHERE idLoai = $idLoai";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        $row = $result->fetch_row();
        if($row[0] > 0){
            $_SESSION['fail'] = 'Chưa xóa được! Xin hãy xóa hết các sản phẩm thuộc loại này trước!';
            header("location: index.php?a=loaisp-xem");
            return false;
        }
        
        $sql = "DELETE FROM loaisp  WHERE idLoai=$idLoai";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        $_SESSION['success'] = 'Đã xóa thành công 1 loại sản phẩm';
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
        settype($_POST['idCL'], "int");
        settype($_POST['idLoai'], "int");
        
        if($_POST['idCL'] ==0 ) $this->errors['idCL'] = "Chọn chủng loại sản phẩm!";
        if($_POST['idLoai'] ==0 ) $this->errors['idLoai'] = "Chọn loại sản phẩm!";
        if(empty($_POST['TenSP'])) $this->errors['TenSP'] = "Không được bỏ trống trường này!";
        if(!is_numeric($_POST['Gia'])) $this->errors['Gia'] = "Trường này phải nhập số!";
        if(!empty($_POST['SoLuongTonKho']) && !is_numeric($_POST['SoLuongTonKho'])) $this->errors['SoLuongTonKho'] = "Trường này phải nhập số!";
        if(empty($_POST['Gia'])) $this->errors['Gia'] = "Không được bỏ trống trường này!";
        
        if(!empty($_POST['youtube'])){
            $youtube = $this->db->escape_string($_POST['youtube']);
            preg_match('/youtube\.com\/watch\?v=(\w+)/i', $youtube, $match);
            if(count($match) != 2) $this->errors['youtube'] = 'link không đúng định dạng';
            $youtube_value = $match[1];
        }
        
        if(count($this->errors) > 0) return false;

        //hình chính mặc định:
        $urlHinh = "updating.png";
        //nếu có up hình chính:
        if(!empty($_FILES['urlHinh']['name'])){
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
        
        //nếu có up hình phụ:
        if(!empty($_FILES['hinhphu']['name'][0])){
            $ext_list = array("jpeg", "png", "jpg");
            $max_size = 1024*1024*2;
            $arr_tenhinhphu = array();
            //kiểm tra xem có hình nào ko hợp lệ ko
            for($i=0; $i<count($_FILES['hinhphu']['name']); $i++){
                $file_ext = pathinfo($_FILES['hinhphu']['name'][$i], PATHINFO_EXTENSION);
                if(!in_array($file_ext, $ext_list)){
                    $this->errors['hinhphu'] = 'Chỉ chấp nhận các định dạng: jpeg, png, jpg!';
                    return false;
                }
                if($_FILES['hinhphu']['size'][$i] > $max_size){
                    $this->errors['hinhphu'] = 'Chỉ chấp nhận hình dưới 2MB!';
                    return false;
                }
                //loi he thong, mang:
                if($_FILES['hinhphu']['error'][$i] > 0){
                    $this->errors['hinhphu'] = 'Có lỗi xảy ra, xin thử lại!';
                    return false;
                }
                                
            }
            //tất cả các hình đều hợp lệ, bắt dầu upload
            for($i=0; $i<count($_FILES['hinhphu']['name']); $i++){
                $newname = $this->changeTitle($_POST['TenSP']) ."-"."hinhphu_".$i. "." . $file_ext;
                
                //lưu tên để sau chèn vào database:
                $arr_tenhinhphu[] = $newname;
                
                //đường dẫn lưu file:
                $path = '../upload/sanpham/hinhphu/' . $newname;
                if(move_uploaded_file($_FILES['hinhphu']['tmp_name'][$i], $path) == false){
                    $this->errors['hinhphu'] = 'Có lỗi xảy ra, xin thử lại!';
                    return false;
                }
            }
        }
        
        $ngay = date('Y-m-d', time());
        $TenSP = $this->db->escape_string($_POST['TenSP']);
        $MoTa = $this->db->escape_string($_POST['MoTa']);
        $thuoc_tinh = $this->db->escape_string($_POST['thuoc_tinh']);
        $baiviet = $this->db->escape_string($_POST['baiviet']);
        $GhiChu = $this->db->escape_string($_POST['GhiChu']);

        $sql = "INSERT INTO sanpham
                VALUES(null, {$_POST['idLoai']}, {$_POST['idCL']}, '$TenSP',
                            '$MoTa','$thuoc_tinh', '$ngay', {$_POST['Gia']}, '$urlHinh',
                            '$baiviet', 0, {$_POST['SoLuongTonKho']},
                            '$GhiChu', 0, {$_POST['AnHien']})";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        $idSP = $this->db->insert_id;
        
        //insert youtube link:
        if(!empty($_POST['youtube'])){
            $sql = "INSERT INTO sanpham_youtube VALUES(null, $idSP, '$youtube_value')";
            if(!$result = $this->db->query($sql)) die("loi ket noi");
        }
        
        //insert url hình phụ:
        if(!empty($_FILES['hinhphu']['name'][0])){
            for($i=0; $i<count($_FILES['hinhphu']['name']); $i++){
                 $sql = "INSERT INTO sanpham_hinh VALUES(null, $idSP, '{$arr_tenhinhphu[$i]}')";
                if(!$result = $this->db->query($sql)) die("loi ket noi");
            }
        }
        
        $_SESSION['success'] = 'Đã thêm thành công 1 sản phẩm';
        header("location: index.php?a=sanpham-xem");
    }

    public function suasanpham($idSP){
        $_POST['TenSP'] = trim($_POST['TenSP']);
        $_POST['Gia'] = trim($_POST['Gia']);
        settype($_POST['idCL'], "int");
        settype($_POST['idLoai'], "int");
        
        if($_POST['idCL'] ==0 ) $this->errors['idCL'] = "Chọn chủng loại sản phẩm!";
        if($_POST['idLoai'] ==0 ) $this->errors['idLoai'] = "Chọn loại sản phẩm!";
        if(empty($_POST['TenSP'])) $this->errors['TenSP'] = "Không được bỏ trống trường này!";
        if(!is_numeric($_POST['Gia'])) $this->errors['Gia'] = "Trường này phải nhập số!";
        if(!empty($_POST['SoLuongTonKho']) && !is_numeric($_POST['SoLuongTonKho'])) $this->errors['SoLuongTonKho'] = "Trường này phải nhập số!";
        if(empty($_POST['Gia'])) $this->errors['Gia'] = "Không được bỏ trống trường này!";
        
        if(!empty($_POST['youtube'])){
            $youtube = $this->db->escape_string($_POST['youtube']);
            preg_match('/youtube\.com\/watch\?v=(\w+)/i', $youtube, $match);
            if(count($match) != 2) $this->errors['youtube'] = 'link không đúng định dạng';
            $youtube_value = $match[1];
        }
        
        if(count($this->errors) > 0) return false;
        
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
        
        settype($_POST['AnHien'], "int");
        $ngay = date('Y-m-d', time());
        $TenSP = $this->db->escape_string($_POST['TenSP']);
        $MoTa = $this->db->escape_string($_POST['MoTa']);
        $thuoc_tinh = $this->db->escape_string($_POST['thuoc_tinh']);
        $baiviet = $this->db->escape_string($_POST['baiviet']);
        $GhiChu = $this->db->escape_string($_POST['GhiChu']);

        $sql = "UPDATE sanpham
                SET idLoai={$_POST['idLoai']}, idCL={$_POST['idCL']}, TenSP='$TenSP',  MoTa='$MoTa',
                thuoc_tinh='$thuoc_tinh', NgayCapNhat='$ngay', Gia={$_POST['Gia']}, $queryhinh baiviet='$baiviet',
                SoLuongTonKho={$_POST['SoLuongTonKho']},GhiChu='$GhiChu',AnHien={$_POST['AnHien']}
                WHERE idSP=$idSP";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        $this->errors['thanhcong'] = "Sửa thành công";
        //xoa hinh cu:
        if(!isset($hinhcu)) return true;
        if($hinhcu != "updating.png") unlink('../upload/sanpham/hinhchinh/'.$hinhcu);
        
        //youtube:
        if(!empty($_FILES['hinhphu']['name'][0])){
            for($i=0; $i<count($_FILES['hinhphu']['name']); $i++){
                 $sql = "INSERT INTO sanpham_hinh VALUES(null, $idSP, '{$arr_tenhinhphu[$i]}')";
                if(!$result = $this->db->query($sql)) die("loi ket noi");
            }
        }
    }
    
    public function uphinhphu($idSP){
        //tìm số thứ tự cao nhất của hình phụ hiện tại:
        $dshinh = $this->layhinhsp($idSP);
        $max = 0;
        foreach($dshinh as $hinh){
            $urlHinh = $hinh['urlHinh'];
            preg_match('/(\d*)\.[a-z]*/', $urlHinh, $match);
            $num = $match[1];
            if($num > $max) $max = $num;
        }
        
        
        if(!empty($_FILES['hinhphu']['name'][0])){
            $ext_list = array("jpeg", "png", "jpg");
            $max_size = 1024*1024*2;
            $arr_tenhinhphu = array();
            //kiểm tra xem có hình nào ko hợp lệ ko
            for($i=0; $i<count($_FILES['hinhphu']['name']); $i++){
                $file_ext = pathinfo($_FILES['hinhphu']['name'][$i], PATHINFO_EXTENSION);
                if(!in_array($file_ext, $ext_list)){
                    $this->errors['hinhphu'] = 'Chỉ chấp nhận các định dạng: jpeg, png, jpg!';
                }
                if($_FILES['hinhphu']['size'][$i] > $max_size){
                    $this->errors['hinhphu'] = 'Chỉ chấp nhận hình dưới 2MB!';
                }
                //loi he thong, mang:
                if($_FILES['hinhphu']['error'][$i] > 0){
                    $this->errors['hinhphu'] = 'Có lỗi xảy ra, xin thử lại!';
                }  
            }
            
            if(!empty($this->errors['hinhphu'])){ 
                $_SESSION['fail'] = '<p class="alert alert-danger">'.$this->errors['hinhphu'].'</p>';
                header("Location: index.php?a=sanpham-hinhphu&idSP=$idSP");
                return false;
            }
            
            //tất cả các hình đều hợp lệ, bắt dầu upload
            for($i=0; $i<count($_FILES['hinhphu']['name']); $i++){
                $sql = "SELECT TenSP FROM sanpham WHERE idSP=$idSP";
                if(!$result = $this->db->query($sql)) die("loi ket noi");
                $row = $result->fetch_row();
                $TenSP = $row[0];
                $newname = $this->changeTitle($TenSP) ."-"."hinhphu_".($max+$i+1). "." . $file_ext;
                
                //lưu tên để sau chèn vào database:
                $arr_tenhinhphu[] = $newname;
                
                //đường dẫn lưu file:
                $path = '../upload/sanpham/hinhphu/' . $newname;
                if(move_uploaded_file($_FILES['hinhphu']['tmp_name'][$i], $path) == false){
                    $this->errors['hinhphu'] = 'Có lỗi xảy ra, xin thử lại!';
                    header("Location: index.php?a=sanpham-hinhphu&idSP=$idSP");
                    return false;
                }
                
                $sql = "INSERT INTO sanpham_hinh VALUES(null, $idSP, '{$arr_tenhinhphu[$i]}')";
                if(!$result = $this->db->query($sql)) die("loi ket noi");
            }
            $_SESSION['success'] = '<p class="alert alert-success">up thành công!</p>';
            header("Location: index.php?a=sanpham-hinhphu&idSP=$idSP");
        }
    }
    
    public function xoahinhphu($idHinh, $urlHinh, $idSP){
        $sql = "DELETE FROM sanpham_hinh WHERE id_hinh=$idHinh";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        unlink('../upload/sanpham/hinhphu/'.$urlHinh);
        $_SESSION['success'] = 'Đã xóa thành công 1 hình phụ';
        header("location: index.php?a=sanpham-hinhphu&idSP=$idSP");
    }

    public function xoasanpham($idSP){
        //xoa hinh chinh:
        $sql = "SELECT urlHinh from sanpham WHERE idSP=$idSP";
        if(!$result = $this->db->query($sql)) die("Loi ket noi");
        $row = $result->fetch_array();
        $urlHinh = $row[0];
        $path = '../upload/sanpham/hinhchinh/' . $urlHinh;
        
        //xoa san pham
        $sql = "DELETE FROM sanpham WHERE idSP=$idSP";
        if(!$result = $this->db->query($sql)) die("Loi ket noi");
        if(!empty($urlHinh) && $urlHinh != 'updating.png') unlink($path);
        
        //xoa hinh phu
        $sql = "SELECT urlHinh from sanpham_hinh WHERE idSP=$idSP";
        if(!$result = $this->db->query($sql)) die("Loi ket noi");
        while($row = $result->fetch_assoc()){
            $urlHinh = $row[0];
            $path = '../upload/sanpham/hinhphu/' . $urlHinh;
            if(!empty($urlHinh) && $urlHinh != 'updating.png') unlink($path);
        }
        $sql = "DELETE FROM sanpham_hinh WHERE idSP=$idSP";
        if(!$result = $this->db->query($sql)) die("Loi ket noi");
        
        //xoa comment
        $sql = "DELETE FROM sanpham_comment WHERE idSP=$idSP";
        if(!$result = $this->db->query($sql)) die("Loi ket noi");
        
        //xoa youtube
        $sql = "DELETE FROM sanpham_youtube WHERE idSP=$idSP";
        if(!$result = $this->db->query($sql)) die("Loi ket noi");
        
        $_SESSION['success'] = 'Xóa sản phẩm thành công!';
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

    public function laydsusers(&$totalrows, $current_page=1, $per_page=10){
        $sql = "select * from users";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        $totalrows = $result->num_rows;

        $start = ($current_page-1)*$per_page;

        $sql = "select * from users ORDER BY idUser DESC LIMIT $start,$per_page";
        if(!$result = $this->db->query($sql)) die("loi ket noi");

        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }

    public function layusertheoid($idUser){
        $sql = "select * from users where idUser=$idUser";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        $data = $result->fetch_assoc();
        return $data;
    }

    public function themuser(){
        $HoTen =  trim($_POST['HoTen']);
        $Email = trim($_POST['Email']);
        $Password =  trim($_POST['Password']);
        $DiaChi = trim($_POST['DiaChi']);
        $DienThoai = trim($_POST['DienThoai']);

        if(empty($Email)) $this->errors['Email'] = 'Trường này là bắt buộc!';
        if(empty($HoTen)) $this->errors['Password'] = 'Trường này là bắt buộc!';
        if(empty($Password)) $this->errors['HoTen'] = 'Trường này là bắt buộc!';
        
        if(count($this->errors) > 0) return false;
        
        $HoTen = $this->db->escape_string($HoTen);
        $Email = $this->db->escape_string($Email);
        $Password = $this->db->escape_string($Password);
        $DiaChi = $this->db->escape_string($DiaChi);
        $DienThoai = $this->db->escape_string($DienThoai);
        
        $NgayDangKy = date("Y-m-d", time());
        
        $sql = "INSERT INTO users VALUES(null, '$HoTen', '$Password', '$DiaChi', '$DienThoai', '$Email', '$NgayDangKy', {$_POST['idGroup']})";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        $_SESSION['message'] = 'Đã thêm thành công user';
        header("Location: index.php?a=user-xem");
    }
    
    public function suauser($idUser){
        $HoTen =  trim($_POST['HoTen']);
        $Email = trim($_POST['Email']);
        $Password =  trim($_POST['Password']);
        $DiaChi = trim($_POST['DiaChi']);
        $DienThoai = trim($_POST['DienThoai']);

        if(empty($Email)) $this->errors['Email'] = 'Trường này là bắt buộc!';
        if(empty($HoTen)) $this->errors['HoTen'] = 'Trường này là bắt buộc!';
        if(empty($Password)) $this->errors['Password'] = 'Trường này là bắt buộc!';
        
        if(count($this->errors) > 0) return false;
        
        $HoTen = $this->db->escape_string($HoTen);
        $Email = $this->db->escape_string($Email);
        $Password = $this->db->escape_string($Password);
        $DiaChi = $this->db->escape_string($DiaChi);
        $DienThoai = $this->db->escape_string($DienThoai);
        
        $NgayDangKy = date("Y-m-d", time());
        
        $sql = "UPDATE users SET HoTen='$HoTen', Password='$Password', 
                DiaChi='$DiaChi', DienThoai='$DienThoai', Email='$Email',
                NgayDangKy='$NgayDangKy', idGroup={$_POST['idGroup']}
                WHERE idUser = $idUser";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        $_SESSION['message'] = 'Đã cập nhật thành công user';
    }
    
    public function xoauser($idUser){
        $sql = "DELETE FROM users WHERE idUser=$idUser";
        if(!$result = $this->db->query($sql)) die("loi ket noi");
        $_SESSION['message'] = 'Đã xóa thành công user';
        header("Location: index.php?a=user-xem");
    }
    
}
