<?php
include('../../classes/connection.php');
include('../../classes/Course.php');
include('../../classes/user.class.php');
session_start();



$user_id = $_SESSION['id'];

$db_connect = new Database_connection;
$connection = $db_connect->connect();


if ($_SESSION['role'] !== 'student') {
   header("Location: ../admin/courses.php");
   exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['logout'])) {
        $user = new user();
        $user->logout();
        header("Location: ../signup.php");
     }
     
}


$course = new Course($connection);

$courses = $course->get_enrolled_courses($user_id);

$db_connect->disconnect();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrolled Courses</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<header class="bg-gray-800 text-white shadow-md">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="catalogue.php" class="text-2xl font-bold">
            Youdemy
        </a>
        
        <!-- Navigation Links -->
        <nav class="space-x-4">
            <a href="catalogue.php" class="text-gray-300 hover:text-white">Catalogue</a>
            <a href="user_courses.php" class="text-gray-300 hover:text-white">Mes Cours</a>
        </nav>

        <!-- Logout Button -->
        <form method="POST" class="inline">
            <button name="logout" type="submit" 
                    class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md transition duration-300">
                Logout
            </button>
        </form>
    </div>
</header>

<body>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Cover</th>
                <th scope="col" class="px-6 py-3">Title</th>
                <th scope="col" class="px-6 py-3">Description</th>
                <th scope="col" class="px-6 py-3">Content</th>
                <th scope="col" class="px-6 py-3">Duration</th>
                <th scope="col" class="px-6 py-3">Pages</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($courses as $course) { ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">
                        <div class="w-16 h-16">
                            <img src="<?= htmlspecialchars($course['cover']) ?>" alt="Cover Image" class="w-full h-full object-cover rounded" />
                        </div>
                    </td>
                    <td class="px-6 py-4"><?= htmlspecialchars($course['title']) ?></td>
                    <td class="px-6 py-4"><?= htmlspecialchars($course['description']) ?></td>
                    <td class="px-6 py-4 w-1/5 ">
                        <?php if ($course['nbr_page'] == null) { ?>
                            <img src="../../Uploads/film.png" alt="Video Content" class="w-1/5">
                        <?php } else { ?>
                            <img src="../../Uploads/pdf.png" alt="PDF Content" class="w-1/5">
                        <?php } ?>
                    </td>
                    <td class="px-6 py-4"><?= htmlspecialchars($course['duration'] ?? 'N/A') ?></td>
                    <td class="px-6 py-4"><?= htmlspecialchars($course['nbr_page'] ?? 'N/A') ?></td>
                    <td class="px-6 py-4"><?= htmlspecialchars($course['cours_status']) ?></td>
                    <td class="px-6 py-4">
                        <form action="view_course.php" method="GET" class="inline">
                            <input type="hidden" name="course_id" value="<?= htmlspecialchars($course['course_id']) ?>">
                            <a href="course_details.php?course_id=<?= htmlspecialchars($course['course_id']) ?>" type="submit" 
                                    class="text-blue-600 dark:text-blue-500 hover:underline">
                                Consulter
                            </button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
