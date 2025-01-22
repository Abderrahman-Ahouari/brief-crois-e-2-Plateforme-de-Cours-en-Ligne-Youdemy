<?php
    include('../../classes/connection.php');
    include('../../classes/Course.php');

    
    $db_connect = new Database_connection;
    $connection = $db_connect->connect();

    $course = new Course($connection);


    $status = isset($_POST['status']) ? $_POST['status'] : 'pending';     
    
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['accept_course'])) {
            $cours_id = $_POST['accept_course_id'];
            $course->accept_reject_course($cours_id,"accepted");
        }elseif (isset($_POST['reject_course'])) {
            $cours_id = $_POST['reject_course_id'];
            $course->accept_reject_course($cours_id,"rejected");
        }elseif (isset($_POST['delete_course'])) {
            $cours_id = $_POST['delete_course_id'];
            $course->setCourseId($cours_id);
            $course->deleteCourse();
        }
    }
    

    $courses = $course->read_courses($status); 
    $db_connect->disconnect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>courses</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
   <span class="sr-only">Open sidebar</span>
   <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
   <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
   </svg>
   </button>

   <aside id="default-sidebar"  class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 bg-gray-50 dark:bg-gray-800">
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
         <li><a href="categories.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"><span class="flex-1 ms-3 whitespace-nowrap">categories</span></a></li>
         <li><a href="Tags.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"><span class="flex-1 ms-3 whitespace-nowrap">tags</span></a></li>
         <li><a href="students.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"><span class="ms-3">students</span></a></li>
         <li><a href="teachers.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"><span class="flex-1 ms-3 whitespace-nowrap">teachers</span></a></li>
         <li><a href="courses.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"><span class="flex-1 ms-3 whitespace-nowrap">courses</span></a></li>
      </ul>
   </div>
</aside>

<div class="p-4 sm:ml-64">
<div class="grid grid-cols-3 gap-4 mb-4">
        <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
            <div class="max-w-sm mx-auto">
                <form method="POST" action="">
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Status</label>
                    <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="accepted" <?php echo $status == 'accepted' ? 'selected' : ''; ?>>accepted</option>
                        <option value="rejected" <?php echo $status == 'rejected' ? 'selected' : ''; ?>>rejected</option>
                        <option value="pending" <?php echo $status == 'pending' ? 'selected' : ''; ?>>pending</option>
                    </select>
                    <button type="submit" class="mt-2 p-2 bg-blue-500 text-white rounded">Filter</button>
                </form>
            </div>
        </div>
    </div>

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
        <th scope="col" class="px-6 py-3">Teacher</th>
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
                    <input type="hidden" value="<?= htmlspecialchars($course['cover']) ?>">
                </div>
            </td>
            <td class="px-6 py-4"><?= htmlspecialchars($course['course_id']) ?></td>
            <td class="px-6 py-4"><?= htmlspecialchars($course['title']) ?></td>
            <td class="px-6 py-4"><?= htmlspecialchars($course['description']) ?></td>
            <?php if ($course['nbr_page'] == NULL) { ?>
                <td class="px-6 py-4">
                    <img src="../../Uploads/film.png" class="w-1/2">
                    <input type="hidden" value="<?= htmlspecialchars($course['content']) ?>">
                </td>
            <?php } else { ?>
                <td class="px-6 py-4">
                    <img src="../../Uploads/pdf.png" class="w-1/2">
                    <input type="hidden" value="<?= htmlspecialchars($course['content']) ?>">
                </td>
            <?php } ?>
            <td class="px-6 py-4"><?= htmlspecialchars($course['duration'] ?? 'N/A') ?></td>
            <td class="px-6 py-4"><?= htmlspecialchars($course['nbr_page'] ?? 'N/A') ?></td>
            <td class="px-6 py-4"><?= htmlspecialchars($course['name']) ?></td>
            <td class="px-6 py-4">
                <?= htmlspecialchars($course['first_name']) . ' ' . htmlspecialchars($course['last_name']) ?>
            </td>
            <td class="px-6 py-4"><?= htmlspecialchars($course['cours_status']) ?></td>
            <td class="flex items-center px-6 py-4 space-x-2">
    <!-- Delete Button -->
    <form action="" method="post">
        <input name="delete_course_id" type="hidden" value="<?= htmlspecialchars($course['course_id']) ?>">
        <button name="delete_course" class="text-red-600 dark:text-red-500 hover:underline">Delete</button>
    </form>

    <!-- Reject Button (visible only if status is 'accepted') -->
    <?php if (in_array($course['cours_status'], ['accepted', 'pending'])) { ?>
        <form action="" method="post">
            <input name="reject_course_id" type="hidden" value="<?= htmlspecialchars($course['course_id']) ?>">
            <button name="reject_course" class="text-orange-600 dark:text-orange-500 hover:underline">Reject</button>
        </form>
    <?php } ?>

    <!-- Accept Button (visible if status is 'rejected' or 'pending') -->
    <?php if (in_array($course['cours_status'], ['rejected', 'pending'])) { ?>
        <form action="" method="post">
            <input name="accept_course_id" type="hidden" value="<?= htmlspecialchars($course['course_id']) ?>">
            <button name="accept_course" class="text-green-600 dark:text-green-500 hover:underline">Accept</button>
        </form>
    <?php } ?>
</td>

        </tr>
    <?php } ?>
</tbody>

        </table>
    </div>

    </div>
    </div>


<script>

    const toggleButton = document.querySelector('[data-drawer-toggle="default-sidebar"]'); // Your toggle button
   const sidebar = document.getElementById('default-sidebar');
   const closeButton = document.getElementById('close-sidebar');

   // Function to update the visibility of the close button
   function updateCloseButton() {
      if (sidebar.classList.contains('-translate-x-full')) {
         closeButton.classList.add('hidden'); // Hide the close button
      } else {
         closeButton.classList.remove('hidden'); // Show the close button
            
      }
   }

   // Toggle sidebar visibility
   toggleButton.addEventListener('click', () => {
      sidebar.classList.toggle('-translate-x-full');
      updateCloseButton(); // Update close button visibility
   });

   // Close sidebar on clicking the close button
   closeButton.addEventListener('click', () => {
      sidebar.classList.add('-translate-x-full'); // Hide sidebar
      updateCloseButton(); // Update close button visibility
   });

   // Initial check for close button visibility
   updateCloseButton();
   
</script>   
</body>
</html>
