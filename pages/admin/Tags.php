<?php
include('../../classes/connection.php');
include('../../classes/tags.class.php');
include('../../classes/user.class.php');
session_start();


$db_connect = new Database_connection;
$connection = $db_connect->connect();



    // manage access
    $user = new User($connection);
   $status = $user->verify_user_status();
   echo $status['status'];

   if ($status['status'] === "inactive") {
      header("Location: ../rejected.php");
  }


if ($_SESSION['role'] !== 'admin') {
   header("Location: ../teacher/add_course.php");
   exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $connection = $db_connect->connect();

   if (isset($_POST['add_tag'])) {

      $name = $_POST['tag_name'];
 
      $tag = new Tags($connection, $name);
      $tag->add_tag();
   }elseif (isset($_POST['delete_tag'])) {

      $id = $_POST['tag_id'];

      $tag = new Tags($connection,$name="", $id);
      $tag->delete_tag();

   }

   $db_connect->disconnect();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Categories</title>
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
   <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
      <div class="grid grid-cols-3 gap-4 mb-4">
         <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
            <button onclick="openAddPopup()" 
               type="button" 
               class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
               Add tag
            </button>
         </div>
      </div>
      <div class="flex items-center justify-center mb-4 rounded bg-gray-50 dark:bg-gray-800">
         <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
               <tr>
                  <th scope="col" class="px-6 py-3">Id</th>
                  <th scope="col" class="px-6 py-3">tag</th>
                  <th scope="col" class="px-6 py-3">action</th>
               </tr>
            </thead>
            <tbody>
               <?php 
               $tag = new Tags($connection);
               $tags = $tag->read_tags();

               foreach ($tags as $tag){?>
               <tr>
                  <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" name="categorie_id"><?= htmlspecialchars($tag['tag_id']) ?></td>
                  <td class="px-6 py-4"><?= htmlspecialchars($tag['name']) ?></td>
                  <td class="px-6 py-4">
                     <form action="" method="post" >
                     <input type="hidden" name="tag_id" value="<?= $tag['tag_id'] ?>">
                     <button name="delete_tag" class="font-medium text-red-600 dark:text-red-700 hover:underline">delete</button>

                     </form>
                  </td>
               </tr>
               <?php }  
                $db_connect->disconnect(); 
               ?>
            </tbody>
         </table>
      </div>
   </div>
</div>

<!-- Add tag Popup -->
<div id="add-popup-modal" class="fixed top-0 left-0 right-0 bottom-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
   <div class="bg-white rounded-lg shadow-lg w-1/3 p-4">
      <div class="flex justify-between items-center">
         <h2 class="text-lg font-medium">Add tag</h2>
         <button onclick="closeAddPopup()" class="text-gray-600 hover:text-gray-900">&times;</button>
      </div>
      <form method="post">
         <div class="mt-4">
            <label for="categorie-name" class="block text-sm font-medium text-gray-700">tag Name</label>
            <input type="text" name="tag_name" id="categorie-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm h-12">
         </div>
         <div class="mt-6 flex justify-end">
            <button type="button" onclick="closeAddPopup()" class="text-gray-600 bg-gray-200 hover:bg-gray-300 font-medium rounded-lg text-sm px-4 py-2 me-2">
               Cancel
            </button>
            <button name="add_tag" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-4 py-2">
               Add
            </button>
         </div>
      </form>
   </div>
</div>


<script>
   function openAddPopup() {
      document.getElementById('add-popup-modal').classList.remove('hidden');
   }
   function closeAddPopup() {
      document.getElementById('add-popup-modal').classList.add('hidden');
   }
</script>

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
   