<?php
    include('../../classes/connection.php');
    include('../../classes/user.class.php');
    session_start();


    
    $db_connect = new Database_connection;
    $connection = $db_connect->connect();


        // manage access
        $user = new User($connection);
        $status = $user->verify_user_status();
        echo $status['status'];
     
        if ($status['status'] === "inactive") {
           header("Location: ../rejected.php");
       }


if ($_SESSION['role'] !== 'admin') {
   header("Location: ../teacher/add_course.php");
   exit;
}

?>