<?php
include('../../classes/connection.php');
include('../../classes/Course.php');
include('../../classes/tags.class.php');
include('../../classes/categorie.class.php');
include('../../classes/cours_video.php');
include('../../classes/cours_document.php');
include('../../classes/tags_courses.php');


$db_connect = new Database_connection;

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//    $connection = $db_connect->connect();

//    $upload_folder = "../../Uploads/";

//    $cover_name = basename($_FILES['cover_image']['name']);
//    $content_name = basename($_FILES['content']['name']);

//    $cover_path = $upload_folder . $cover_name;
//    $content_path = $upload_folder . $content_name;

//    move_uploaded_file($_FILES['cover_image']['tmp_name'], $cover_path); 
//    move_uploaded_file($_FILES['content']['tmp_name'], $content_path); 

//    $title = $_POST['title'];
//    $description = $_POST['description'];
//    $categorie_id = $_POST['category'];
//    $teacher_id = 2;
//    $duration = $_POST['video_duration'];
//    $nbr_pages = $_POST['document_pages'];
//    $cours_id;  
//    $tags = $_POST['tags'];

//    if ($_POST['content_type'] === "video") {
//       $video_course = new VideoCourse($connection, $title, $description, $cover_path, $content_path, $duration, $categorie_id, $teacher_id);
//       $cours_id = $video_course->add_course();
//   } elseif ($_POST['content_type'] === "document") {
//       $document_course = new DocumentCourse($connection, $title, $description, $cover_path, $content_path, $nbr_pages, $categorie_id, $teacher_id);
//       $cours_id = $document_course->add_course();
//    }


//    $db_connect->disconnect();
// }


$connection = $db_connect->connect();

$course = new Course($connection);
$course->setTeacherId(2); 
$courses = $course->read_teacher_courses(); 

$db_connect->disconnect();

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Courses</title>
   <script src="https://cdn.tailwindcss.com"></script>
</head>  
<body>
<button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
   <span class="sr-only">Open sidebar</span>
   <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
   <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
   </svg>
</button>

<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 bg-gray-50 dark:bg-gray-800">
   <div class="h-full px-3 py-4 overflow-y-auto">
      <!-- Close Button -->
      <button id="close-sidebar" class="hidden absolute top-3 right-3 text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
         <span class="sr-only">Close sidebar</span>
         <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"></path>
         </svg>
      </button>
      <!-- Sidebar Content -->
      <ul class="space-y-2 font-medium">
         <li><a href="statistics.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"><span class="ms-3">Statistics</span></a></li>
         <li><a href="add_course.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"><span class="flex-1 ms-3 whitespace-nowrap">Create a course</span></a></li>
         <li><a href="view_courses.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"><span class="flex-1 ms-3 whitespace-nowrap">View courses</span></a></li>
      </ul>
   </div>
</aside>



<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">



   <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Cover</th>
                <th scope="col" class="p-4">ID</th>
                <th scope="col" class="px-6 py-3">Title</th>
                <th scope="col" class="px-6 py-3">Description</th>
                <th scope="col" class="px-6 py-3">Content</th>
                <th scope="col" class="px-6 py-3">Duration</th>
                <th scope="col" class="px-6 py-3">Number of Pages</th>
                <th scope="col" class="px-6 py-3">Category</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($courses as $course){ ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">
                        <div class="w-16 h-16">
                            <img src="<?= htmlspecialchars($course['cover']) ?>" alt="Cover Image" class="w-full h-full object-cover rounded" />
                        </div>
                    </td>
                    <td class="px-6 py-4"><?= htmlspecialchars($course['course_id']) ?></td>
                    <td class="px-6 py-4"><?= htmlspecialchars($course['title']) ?></td>
                    <td class="px-6 py-4"><?= htmlspecialchars($course['description']) ?></td>
                    <td class="px-6 py-4"><?= htmlspecialchars($course['content']) ?></td>
                    <td class="px-6 py-4"><?= htmlspecialchars($course['duration'] ?? 'N/A') ?></td>
                    <td class="px-6 py-4"><?= htmlspecialchars($course['nbr_page'] ?? 'N/A') ?></td>
                    <td class="px-6 py-4"><?= htmlspecialchars($course['name']) ?></td>
                    <td class="px-6 py-4"><?= htmlspecialchars($course['cours_status']) ?></td>
                    <td class="flex items-center px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Remove</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

   </div>
</div>




</body>
</html>
