<?php
include('../../classes/connection.php');
include('../../classes/Course.php');




$course_id = intval($_GET['course_id']); 

$db_connect = new Database_connection;
$connection = $db_connect->connect();

$course = new Course($connection, $course_id);

$course_details = $course->read_course_details(); // Fetch course details

if (!$course_details) {
    die("Course not found.");
}

$db_connect->disconnect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details</title>
    <style>
        /* Same CSS as provided in the original version */
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
            flex: 2;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .course-info img {
            width: 100%;
            height: 300px;
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
            display: flex;
            align-items: center;
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
            flex: 1;
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
            <img src="<?= htmlspecialchars($course_details['cover']) ?>" alt="Course Cover">
            <h1><?= htmlspecialchars($course_details['title']) ?></h1>
            <p class="category">Category: <?= htmlspecialchars($course_details['category_name']) ?></p>
            <p><?= htmlspecialchars($course_details['description']) ?></p>
            
            <div class="teacher-info">
                <img src="<?= htmlspecialchars($course_details['teacher_profile_image'] ?? 'default-profile.png') ?>" alt="Teacher Profile">
                <div>
                    <span class="teacher-name"><?= htmlspecialchars($course_details['teacher_first_name'] . ' ' . $course_details['teacher_last_name']) ?></span>
                    <br>
                    <span class="teacher-email"><?= htmlspecialchars($course_details['teacher_phone']) ?></span>
                </div>
            </div>
        </div>

        <!-- Right Section: Course Content -->
        <div class="course-content">
            <?php if ($course_details['nbr_page'] === NULL): ?>
                <!-- If course is a video -->
                <div class="icon">🎥</div>
                <div class="content-type">Video</div>
                <div class="details">Duration: <?= htmlspecialchars($course_details['duration']) ?></div>
            <?php else: ?>
                <!-- If course is a document -->
                <div class="icon">📄</div>
                <div class="content-type">Document</div>
                <div class="details">Number of Pages: <?= htmlspecialchars($course_details['nbr_page']) ?></div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
