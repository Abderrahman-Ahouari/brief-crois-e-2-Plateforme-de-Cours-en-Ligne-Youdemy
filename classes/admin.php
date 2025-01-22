<?php
include('user.class.php');
    class admin extends user{
        public function __construct($conn = null, $first_name = null, $last_name = null, $email = null, $phone = null, $password = null, $role = null, $status = null) {
            parent::__construct($conn, $first_name, $last_name, $email, $phone, $password, $role, $status);
        }
        


        public function read_users($role, $status) {
            try {
                $sql = "SELECT * FROM users WHERE role = :role AND status = :status";
    
                $query = $this->getconn()->prepare($sql);
    
                $query->bindParam(':role', $role, PDO::PARAM_STR);
                $query->bindParam(':status', $status, PDO::PARAM_STR);
    
                $query->execute();
    
                $users = $query->fetchAll(PDO::FETCH_ASSOC);
    
                return $users;
    
            } catch (PDOException $error) {
                die("Error fetching users: " . $error->getMessage());
            }
        }



        public function delete_user($user_id) {
            try {
                $sql = "DELETE FROM users WHERE user_id = :user_id";
                $query = $this->getconn()->prepare($sql);
                $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $query->execute();
            } catch (PDOException $error) {
                die("Error deleting user: " . $error->getMessage());
            }
        }

        

        public function activate_inactivate_user($user_id, $status) {
            try {
                $sql = "UPDATE users SET status = :status WHERE user_id = :user_id";
                $query = $this->getconn()->prepare($sql);
                $query->bindParam(':status', $status, PDO::PARAM_STR);
                $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $query->execute();
            } catch (PDOException $error) {
                die("Error updating user status: " . $error->getMessage());
            }
        }
        
    
    }


?>