<?php
include('user.class.php');
    class admin extends user{
        public function __construct($conn = null, $first_name = null, $last_name = null, $email = null, $phone = null, $password = null, $role = null, $status = null) {
            parent::__construct($conn, $first_name, $last_name, $email, $phone, $password, $role, $status);
        }
        


        public function read_users($role, $status) {
            try {
                // Prepare the SQL query with placeholders
                $sql = "SELECT * FROM users WHERE role = :role AND status = :status";
    
                // Prepare the statement
                $query = $this->getconn()->prepare($sql);
    
                // Bind the parameters
                $query->bindParam(':role', $role, PDO::PARAM_STR);
                $query->bindParam(':status', $status, PDO::PARAM_STR);
    
                // Execute the query
                $query->execute();
    
                // Fetch all the matching users
                $users = $query->fetchAll(PDO::FETCH_ASSOC);
    
                // Return the users
                return $users;
    
            } catch (PDOException $error) {
                die("Error fetching users: " . $error->getMessage());
            }
        }
    
    }
?>