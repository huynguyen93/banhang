<?php session_start(); ob_start(); define("CHECK", 1);
class db{
    public $db;
    
    function __construct(){
        $this->db = new mysqli('localhost', 'root', '', 'tm');
        $this->db->set_charset("utf8") or die("ket noi database that bai");
    }
    
    public function taocaptcha(){
        $chuoi= "1234567890";
        $captcha = "";
        for($i=1; $i<=5; $i++){
            $captcha .= substr($chuoi, rand(0, strlen($chuoi)-1), 1);
        }
        $_SESSION['captcha'] = $captcha;
    }
    
    public function guimail(){
        if(empty($_POST['HoTen']) || empty($_POST['Email']) || empty($_POST['tieude']) || empty($_POST['noidung'])){
            $_SESSION['fail'] = "<p class='alert alert-danger'>Xin nhập tất cả thông tin!</p>";
        }
        
        if($_POST['captcha'] != $_SESSION['captcha']) $_SESSION['fail'] = "<p class='alert alert-danger'>Xin nhập lại captcha!</p>";
        
        if(isset($_SESSION['fail'])) return false;
        
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        require("mailer/PHPMailerAutoload.php");

        //Create a new PHPMailer instance
        $mail = new PHPMailer;

        //Tell PHPMailer to use SMTP
        $mail->isSMTP();

        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 0;

        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';

        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        // use
        // $mail->Host = gethostbyname('smtp.gmail.com');
        // if your network does not support SMTP over IPv6

        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;

        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';

        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;

        //nhập tài khoản gmail:
        $mail->Username = "username@gmail.com";

        //Nhập password của gmail ở trên:
        $mail->Password = "yourpassword";

        //Set who the message is to be sent from
        //Email người gửi:
        $mail->setFrom("{$_POST['Email']}", 'First Last');

        //Set an alternative reply-to address
    //    $mail->addReplyTo('replyto@example.com', 'First Last');

        //Set who the message is to be sent to
        //Nhập email nhận thư:
        $mail->addAddress('whoto@example.com', 'John Doe');

        //Tiêu đề Email
        $mail->Subject = "{$_POST['tieude']}";

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        //$mail->msgHTML('content', dirname(__FILE__));

        //Nội dung email
        $mail->AltBody = "{$_POST['noidung']}";

        //Attach an image file
        //$mail->addAttachment('images/phpmailer_mini.png');

        //send the message, check for errors
        if (!$mail->send()) {
            $_SESSION['success'] = "<p class='alert alert-success'>Email đã được gửi! Chúng tôi sẽ phản hồi sớm</p>";
        } else {
            $_SESSION['success'] = "<p class='alert alert-success'>Email đã được gửi! Chúng tôi sẽ phản hồi sớm</p>";
        }
    }
    
    protected function int($input){
        settype($input, "int");
        return $input;
    }
    
    protected function redirect($url){
        header("Location: $url");
    }
    
    function changeTitle($str){
		$str = $this->stripUnicode($str);
		$str = str_replace("?","",$str);
		$str = str_replace("&","",$str);
		$str = str_replace("'","",$str);	
		$str = trim($str);		
		while (strpos($str,'  ')>0) $str = str_replace("  "," ",$str);
		$str = mb_convert_case($str , MB_CASE_LOWER , 'utf-8');
		$str = str_replace(" ","-",$str);	
		return $str;
	}

	function stripUnicode($str){
		if(!$str) return false;
		$unicode = array(
		 'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
		 'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
		 'd'=>'đ',
		 'D'=>'Đ',
		 'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
		 'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
		 'i'=>'í|ì|ỉ|ĩ|ị',	  
		 'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
		 'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
		 'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
		 'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
		 'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
		 'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
		 'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
		);
		foreach($unicode as $khongdau=>$codau) {
		  $arr = explode("|",$codau);
		  $str = str_replace($arr,$khongdau,$str);
		}
		return $str;
    }
}

define("BASE_URL", "http://localhost/banhang/");