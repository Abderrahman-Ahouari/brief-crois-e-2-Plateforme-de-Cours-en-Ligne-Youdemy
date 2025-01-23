<?php
include('../../classes/connection.php');
include('../../classes/user.class.php');


$db_connect = new Database_connection;
$connection = $db_connect->connect();



    // manage access
    $user = new User($connection);
$user->verify_user_status();
if ($_SESSION['role'] !== 'teacher') {
   header("Location: ../student/catalogue.php");
   exit;
}
?>