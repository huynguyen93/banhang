<?php require_once("classDB.php");
    
class user extends db{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function dangnhap(){
        if( empty($_POST['Email']) || empty($_POST['Password'])) die("Không được bỏ trống trường nào!");
        if($_POST['captcha'] != $_SESSION['captcha']) die("Mã xác nhận không đúng!");
        if(filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL) == false) die("Email không hợp lệ!");
        
        $email = $this->db->escape_string($_POST['Email']);
        $password = $this->db->escape_string($_POST['Password']);
        $password = md5($password);
        
        $sql = "SELECT * FROM users WHERE Email='$email' AND Password='$password'";
        if(!$result = $this->db->query($sql)) die('Có lỗi xảy ra, xin thử lại!');
        if($result->num_rows != 1) die('Tài khoản hoặc mật không đúng');
        $row = $result->fetch_assoc();
        
        $_SESSION['user_id'] = $row['idUser'];
        $_SESSION['user_hoten'] = $row['HoTen'];
        $_SESSION['user_email'] = $row['Email'];
        $_SESSION['user_group'] = $row['idGroup'];
        die("OK");
    }
    
    public function doimatkhau(){
        if(empty($_POST['oldpass']) || empty($_POST['newpass']) || empty($_POST['renewpass']))
            die("Vui lòng nhập đầy đủ thông tin!");
        if($_POST['newpass'] != $_POST['renewpass']) die("Mật khẩu xác nhận không khớp");
        
        $password = md5($_POST['oldpass']);
        
        $sql = "SELECT idUser FROM users WHERE Password='$password' AND idUser={$_SESSION['user_id']}";
        if(!$result = $this->db->query($sql)) die('Có lỗi xảy ra, xin thử lại!');
        if($result->num_rows != 1) die('Mật khẩu không đúng');
        
        $password = md5($_POST['newpass']);
        
        $sql = "UPDATE users SET Password='$password' WHERE idUser={$_SESSION['user_id']}";
        if(!$result = $this->db->query($sql)) die('Có lỗi xảy ra, xin thử lại!');
        if($this->db->affected_rows != 1) die('Có lỗi xảy ra, xin thử lại!');
        die("OK");
    }
    
    public function get_info(){
        if(!isset($_SESSION['user_id'])) return false;
        $sql = "SELECT * FROM users WHERE idUser={$_SESSION['user_id']}";
        if(!$result = $this->db->query($sql)) die('Có lỗi xảy ra, xin thử lại!');
        $data = $result->fetch_assoc();
        return $data;
    }
    
    public function thoat(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_hoten']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_group']);
        header("location: index.php");
    }
    
    public function dangky(){
        if(empty($_POST['Email']) || empty($_POST['Password']) || empty($_POST['RePassword']) || empty($_POST['HoTen']) || empty($_POST['DiaChi']) || empty($_POST['DienThoai']) || empty($_POST['captcha']))
            die("Không được bỏ trống trường nào!");
        if($_POST['captcha'] != $_SESSION['captcha']) die("Nhập lại mã xác nhận");
        if(filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL) == false) die("Email không hợp lệ");
        if($this->checkEMail($_POST['Email'])== false) die("Email đã được đăng kí");
        if($_POST['Password'] != $_POST['RePassword']) die("Password không khớp");
        
        $email = $this->db->escape_string($_POST['Email']);
        $password = $this->db->escape_string($_POST['Password']);
        $password = md5($password);
        $hoten = $this->db->escape_string($_POST['HoTen']);
        $diachi = $this->db->escape_string($_POST['DiaChi']);
        $dienthoai = $this->db->escape_string($_POST['DienThoai']);
        $ngay = date("Y-m-d", time());
        $sql = "INSERT INTO users VALUES(null, '$hoten', '$password', '$diachi', '$dienthoai', '$email', '$ngay', 0)";
        if(!$result = $this->db->query($sql)) die("Có lỗi xảy ra, xin thử lại!");
        echo "OK";
    }
    
    public function checkEmail($email){
        $sql = "SELECT idUser FROM users WHERE Email='$email'";
        if(!$result = $this->db->query($sql)) die($sql);
        if($result->num_rows > 0) return false;
        return true;
    }
}