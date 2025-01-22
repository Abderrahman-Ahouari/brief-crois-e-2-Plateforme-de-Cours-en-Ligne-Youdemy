<?php
include('../../classes/connection.php');
include('../../classes/Course.php');

// Read course
$db_connect = new Database_connection;
$connection = $db_connect->connect();

$course_id = 2; //consider this is the course we want later we will send the id value from the see details and we will get it using get
$course = new Course($connection, $course_id);
$courses = $course->read_course_details();

$db_connect->disconnect();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            gap: 20px;
        }

        .course-info {
            flex: 2; /* Takes 2/3 of the screen width */
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .course-info img {
            width: 100%;
            height: 300px; /* Fixed height for the cover image */
            object-fit: cover;
            border-radius: 8px;
        }

        .course-info h1 {
            font-size: 28px;
            margin: 20px 0 10px;
        }

        .course-info p {
            font-size: 16px;
            color: #555;
            margin-bottom: 10px;
        }

        .course-info .category {
            font-size: 14px;
            color: #007BFF;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .teacher-info {
            margin-top: 20px;
            padding: 15px;
            background-color: #f4f4f4;
            border-radius: 8px;
        }

        .teacher-info img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
            vertical-align: middle;
        }

        .teacher-info .teacher-name {
            font-size: 16px;
            font-weight: bold;
        }

        .teacher-info .teacher-email {
            font-size: 14px;
            color: #555;
        }

        .course-content {
            flex: 1; /* Takes 1/3 of the screen width */
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .course-content .icon {
            font-size: 50px;
            margin-bottom: 10px;
            color: #007BFF;
        }

        .course-content .content-type {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .course-content .details {
            font-size: 16px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Left Section: Course Info -->
        <div class="course-info">
            <img src="https://i.imgflip.com/7qevu9.jpg" alt="Course Cover">
            <h1>Course Title</h1>
            <p class="category">Category: Programming</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vehicula dolor sed lectus congue, nec posuere ligula facilisis.</p>
            
            <div class="teacher-info">
                <img src="https://i.imgflip.com/7qevu9.jpg" alt="Teacher Profile">
                <span class="teacher-name">John Doe</span>
                <br>
                <span class="teacher-email">johndoe@example.com</span>
            </div>
        </div>

        <!-- Right Section: Course Content -->
        <div class="course-content">
            <!-- Example of Video Content -->
            <div class="icon">🎥</div>
            <div class="content-type">Video</div>
            <div class="details">Duration: 2 hours</div>

            <!-- Example of Document Content (to be dynamically switched) -->
            <!--
            <div class="icon">📄</div>
            <div class="content-type">Document</div>
            <div class="details">Number of Pages: 20</div>
            -->
        </div>
    </div>
</body>
</html>
