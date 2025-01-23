   <?php
   include('../classes/connection.php');   
   include('../classes/user.class.php');

   $db_connect = new Database_connection;
   
   session_start();

   if(!$_SESSION){
  }else{
    header("Location: student/catalogue.php");
  }


   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $connection = $db_connect->connect();

      if (isset($_POST['Login'])) {
         $email = $_POST['email'] ;
         $password = $_POST['password'] ;

         $user = new User($connection,"", "", $email, "", $password, "", "");

         $user->login();
      } 
      

      elseif (isset($_POST['Signup'])) {
         $first_name = $_POST['first_name'];
         $last_name = $_POST['last_name'];
         $email = $_POST['email'];
         $phone = $_POST['phone'];
         $password = $_POST['password'];
         $role = $_POST['role'];
         $Status;
         if ($role === "student") {
            $Status = "active";
          } elseif($role === "teacher") {
            $Status = "inactive";
          }

         $user = new User($connection, $first_name, $last_name, $email, $phone, $password, $role, $Status);

         $user->signup();
      }

      $db_connect->disconnect();  
      header("Location: student/catalogue.php");
   }
?>

<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login & Registration Form</title>
  <link rel="stylesheet" href="../CSS/signup_login.css">
</head>
<body>
  <div class="container">
    <input type="checkbox" id="check">
    <div class="login form">
      <header>Login</header>
      <form action="" method="post">
         <input type="text" name="email" placeholder="Enter your email">
         <input type="password" name="password" placeholder="Enter your password">
         <button type="submit" class="input  " value="Login" name="Login">Login</button>
      </form>

      <div class="signup">
        <span class="signup">Don't have an account?
         <label for="check">Signup</label>
        </span>
      </div>
    </div>
    <div class="registration form">
      <header>Signup</header>
      <form action="" method="post" enctype="multipart/form-data">
         <input type="text" name="first_name" placeholder="Enter your first name"required>
         <input type="text" name="last_name" placeholder="Enter your last name"required>
         <input type="email" name="email" placeholder="Enter your email"required>
         <input type="tel" name="phone" placeholder="Enter your phone number"required>
         <input type="password" name="password" placeholder="Create a password"required>
         <input type="file" class="input" name="profile_image"required>
         <select class="input" name="role" id="role"required>
               <option value="student">Student</option>
               <option value="teacher">Teacher</option>
         </select>
         <button type="submit" class="input" value="Signup" name="Signup">Signup</button>
      </form>

      <div class="signup">
        <span class="signup">Already have an account?
         <label for="check">Login</label>
        </span>
      </div>
    </div>
  </div>
</body>
</html>