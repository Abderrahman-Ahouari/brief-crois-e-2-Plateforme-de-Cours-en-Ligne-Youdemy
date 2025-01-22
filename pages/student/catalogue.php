<?php
include('../../classes/connection.php');
include('../../classes/Course.php');

// Read courses
$db_connect = new Database_connection;
$connection = $db_connect->connect();

$course = new Course($connection);
$courses = $course->read_courses();

$db_connect->disconnect();

// Search courses
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connection = $db_connect->connect();

    $search_name = $_POST['search_name'] ?? ''; // Handle input safely

    $course = new Course($connection);
    $courses = $course->search_courses($search_name);

    $db_connect->disconnect();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .search-bar {
            display: flex;
            margin-bottom: 20px;
        }

        .search-bar input {
            flex: 1;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .search-bar button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
        }

        .search-bar button:hover {
            background-color: #0056b3;
        }

        .course-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .course-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .course-card img {
            max-width: 100%;
            height: 200px; /* Fixed height for all images */
            object-fit: cover;
            border-radius: 5px;
        }

        .course-card h3 {
            font-size: 20px;
            margin: 10px 0;
        }

        .course-card p {
            font-size: 14px;
            color: #555;
            margin: 10px 0;
        }

        .course-card span {
            display: inline-block;
            margin: 5px 0;
            padding: 5px 10px;
            background-color: #f4f4f4;
            border-radius: 3px;
            font-size: 12px;
            color: #666;
        }

        .course-card button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .course-card button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <form class="search-bar" method="POST" action="">
            <input type="text" name="search_name" id="searchInput" placeholder="Search for courses...">
            <button type="submit">Search</button>
        </form>

        <div class="course-grid" id="courseGrid">
                <?php foreach ($courses as $course){ ?>
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform transition hover:scale-105 hover:shadow-xl">
    <img src="<?= htmlspecialchars($course['cover']) ?>" 
         alt="Image de <?= htmlspecialchars($course['title']) ?>" 
         class="w-full h-48 object-cover">
    <div class="p-6">
        <!-- Category Badge -->
        <div class="flex justify-between items-center mb-4">
            <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm">
                <?= htmlspecialchars($course['name']) ?>
            </span>
        </div>
        
        <!-- Course Title -->
        <h2 class="text-xl font-bold text-gray-900 mb-3">
            <?= htmlspecialchars($course['title']) ?>
        </h2>
        
        <!-- Teacher Info -->
        <div class="flex items-center space-x-3 mb-4">
            <img src="<?= htmlspecialchars($course['image_profile']) ?>" 
                 alt="Image de <?= htmlspecialchars($course['first_name']) ?>" 
                 class="w-8 h-8 rounded-full object-cover">
            <span class="text-gray-600 text-sm">
                <?= htmlspecialchars($course['first_name']) ?>
            </span>
        </div>
        
        <!-- Course Description -->
        <p class="text-gray-600 text-sm mb-4">
            <?= htmlspecialchars($course['description']) ?>
        </p>
        
        <!-- Action Buttons -->
        <div class="flex space-x-2 justify-center">
            <!-- Inscription Button -->
            <form action="inscription.php" method="POST" class="w-1/2">
                <input type="hidden" name="course_id" value="<?= htmlspecialchars($course['course_id']) ?>">
                <button type="submit" 
                        class="w-full text-center bg-green-600 text-white py-3 rounded-full hover:bg-green-700 transition duration-300">
                    Inscription
                </button>
            </form>
        </div>
    </div>
</div>
                <?php } ?>
        </div>
    </div>



<!-- Dynamic Course Card -->


</body>
</html>
