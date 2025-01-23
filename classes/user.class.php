<?php
 class User {

    private $user_id;
    private $first_name;
    private $last_name;
    private $email;
    private $phone;
    private $image;
    private $password;
    private $role;
    private $status;
    private $conn;

    
    public function __construct($conn = null, $first_name = null, $last_name = null, $email = null, $phone = null, $password = null, $role = null, $status = null) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
        $this->role = $role;
        $this->status = $status;
        $this->conn = $conn;
    }


    public function getUserId() {
        return $this->user_id;
    }
    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }


    public function getFirstName() {
        return $this->first_name;
    }
    public function setFirstName($first_name) {
        $this->first_name = $first_name;
    }


    public function getLastName() {
        return $this->last_name;
    }
    public function setLastName($last_name) {
        $this->last_name = $last_name;
    }


    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }


    public function getPhone() {
        return $this->phone;
    }
    public function setPhone($phone) {
        $this->phone = $phone;
    }


    public function getPassword() {
        return $this->password;
    }
    public function setPassword($password) {
        $this->password = $password;
    }


    public function getRole() {
        return
         $this->role;
    }
    public function setRole($role) {
        $this->role = $role;
    }


    public function getStatus() {
        return $this->status;
    }
    public function setStatus($status) {
        $this->status = $status;
    }


    public function getconn() {
        return $this->conn;
    }
    public function setconn($connection) {
        $this->conn = $connection;
    }

    public function signup(){
       try{

            $upload_folder = "../Uploads/";
            $file_name = basename($_FILES['profile_image']['name']);
            $image_path = $upload_folder . $file_name;

          if(!move_uploaded_file($_FILES['profile_image']['tmp_name'], $image_path)){
                echo "error in uploading the image in the folder";
          }        
        

          
        $sql = "INSERT INTO users(first_name, last_name, email, phone, image_profile,  password, role, status) 
            VALUES(:first_name, :last_name, :email, :phone, :image, :password , :role, :statu );";

            $hasshed_password = password_hash($this->password,PASSWORD_DEFAULT);

            $query = $this->conn->prepare($sql);

            $query->bindParam(':first_name', $this->first_name, PDO::PARAM_STR);
            $query->bindParam(':last_name', $this->last_name, PDO::PARAM_STR);
            $query->bindParam(':email', $this->email, PDO::PARAM_STR);
            $query->bindParam(':image', $image_path, PDO::PARAM_STR); 
            $query->bindParam(':phone', $this->phone, PDO::PARAM_STR);
            $query->bindParam(':password', $hasshed_password, PDO::PARAM_STR);
            $query->bindParam(':role', $this->role, PDO::PARAM_STR);   
            $query->bindParam(':statu', $this->status, PDO::PARAM_STR);   
    
            
            $query->execute(); 

        $_SESSION['id'] = $this->conn->lastInsertId();
        $_SESSION['role'] = $this->role;

        }catch(PDOException $error){
        die("an error while registering" . $error->getMessage());
        }   
            }


        public function login(){
            try{
                
                $sql="SELECT user_id, password, role, status FROM users WHERE email=:email;";
        
                $query = $this->conn->prepare($sql);
        
                $query->bindParam(':email', $this->email, PDO::PARAM_STR);
        
                $query->execute();
                $user = $query->fetch(PDO::FETCH_ASSOC);

                    
                    if($user && password_verify($this->password, $user['password']) ){
                    $_SESSION['id'] = $user['user_id'];             
                    $_SESSION['role'] = $user['role'];
                }else{
                    die("Invalid email or password.");
                }
            
            }catch (PDOException $error) {
                die("An error in login: " . $error->getMessage());
            }
            
        }
        
        public function logout(){
            session_unset();    
            session_destroy();
        }

        function verify_user_status() {
            if (!isset($_SESSION['id'])) {
                header("Location: ../signup.php");
                exit;
            }
        
            $user_id = $_SESSION['id'];
        
            try {
                $sql = "SELECT status FROM users WHERE user_id = :user_id";
                $query = $this->conn->prepare($sql);
                $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $query->execute();
        
                $result = $query->fetch(PDO::FETCH_ASSOC);
        
                return $result;
            } catch (PDOException $error) {
                die("Error verifying user status: " . $error->getMessage());
            }
        }
        
}
?>
