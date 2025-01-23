<?php
    include('../../classes/connection.php');
    include('../../classes/user.class.php');
    session_start();


    
    $db_connect = new Database_connection;
    $connection = $db_connect->connect();


    

if ($_SESSION['role'] !== 'admin') {
   header("Location: ../teacher/add_course.php");
   exit;
}

?>