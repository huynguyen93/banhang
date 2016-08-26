<?php
class quantri{
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
    
    public function themchungloai(){
        
    }
}