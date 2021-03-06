<?php
 $filepath = realpath(dirname(__FILE__));
 include_once ($filepath.'/../lib/database.php');
 include_once ($filepath.'/../helpers/dbhelper.php');
?>
<?php
    class brand{  
        private $fm;
        private $db;
        public function __construct(){
            $this->db = new Database();
            $this->fm = new format();
        }
        public function insert_brand($brandName){
            $brandName = $this->fm->validation($brandName);
            $brandName = mysqli_real_escape_string($this->db->link,$brandName); 
            if(empty($brandName)){
                $alert = "<span class= 'success'>brand must be not empty</span>";
                return $alert;
            }
            else{
                $query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
                $result = $this->db->insert($query);    
                if($result){
                    $alert = "<span class= 'success'>Insert brand Successfully</span>";
                    return $alert;
                }
                else{
                    $alert = "<span class= 'error'>Insert brand Not Success</span>";
                    return $alert;
                }
            }
        }
        public function show_brand(){
            $query = "SELECT * from  tbl_brand order by brandId desc";
            $result = $this->db->select($query);
            return $result;
        }
        public function getbrandbyid($id){
            $query = "SELECT * FROM tbl_brand where brandId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function update_brand($brandName,$id){
            $brandName = $this->fm->validation($brandName);
            $brandName = mysqli_real_escape_string($this->db->link,$brandName);
            $id = mysqli_real_escape_string($this->db->link,$id);
            if(empty($brandName)){
                $alert = "<span class='error'>brand must be not empty</span>";
                return $alert;
            }
            else{
                $query = "UPDATE tbl_brand SET brandName ='$brandName' WHERE brandId = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>C???p nh???t th????ng hi???u th??nh c??ng</span>";
                    return $alert;
                }
                else{
                    $alert = "<span class='error'>C???p nh???t th????ng hi???u th???t b???i</span>";
                    return $alert;
                }
            }
        } 
        public function del_brand($id){
            $query = "DELETE FROM tbl_brand WHERE brandId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>X??a th????ng hi???u th??nh c??ng </span>";
                return $alert;
            }
            else{
                $alert = "<span class = 'error'>X??a th????ng hi???u th???t b???i</span>";
                return $alert;
            }
        }
        

    }

?>    