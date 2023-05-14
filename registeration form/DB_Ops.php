  <?php

// $fname = $_POST['fname'];
// $phone = $_POST['phone'];
// $Address = $_POST['Address'];
// $email = $_POST["E-mail"];
// $Username = $_POST['username'];
// $password = $_POST['password'];
// $confirm_password = $_POST['confirm_password'];
// $birthday = $_POST['birthday'];
// $image=$_FILES['image']['name'];
  
// require('register.php');
class database {
  public  $conn ;
    public function __construct(){
        $this->conn = new mysqli('localhost','root','','registration');
// mysqli_select_db($conn , 'Register') or die ('db will not open' . mysqli_error($conn));
if($this->conn->connect_error){
die('Connection Failed : '.$this->conn->connect_error);
        
    }
}

public function insert_into_database($fname,$phone,$Address,$email,$Username,$password ,$confirm_password,$birthday,$image)
{
    // move_uploaded_file($_FILES['image']["tmp_name"],'upload/'.$image);
    require('uploud.php');
    
        $stmt = $this->conn->prepare("INSERT INTO users (full_name, user_name, birthdate, phone, address, password, email,user_image) 
        values(? , ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss",$fname ,$Username , $birthday ,$phone , $Address, $password, $email,$image);
        $stmt->execute();
        echo" registration successfully...";
        $stmt->close();
        $this->conn->close();
    
}
public function userNameValidation()
{
  
}
}
// $database=new database();
// $database->insert_into_database($fname,$phone,$Address,$email,$Username,$password ,$confirm_password,$birthday,$image);
?>
