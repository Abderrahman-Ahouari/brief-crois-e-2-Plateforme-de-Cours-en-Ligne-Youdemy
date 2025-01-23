
   <?php
include('../classes/User.class.php'); 
include('../classes/connection.php'); 
session_start();


$db_connect = new Database_connection;
$connection = $db_connect->connect();


$user = new User($connection); 
$status = $user->verify_user_status();
if ($status['status'] !== "inactive") { 
    header("Location: ../pages/teacher/add_course.php");
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inactive account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .container h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
        .container p {
            font-size: 16px;
            color: #666;
            line-height: 1.5;
        }
        .container .icon {
            font-size: 50px;
            color: #f39c12;
            margin-bottom: 20px;
        }
        .container .contact-admin {
            margin-top: 20px;
            font-size: 14px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">⏳</div>
        <h1>Account Under Review</h1>
        <p>Your account is currently inactive. Please wait for the administrator to activate your account.</p>

    </div>
</body>
</html>
