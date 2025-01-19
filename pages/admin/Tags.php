<?php
include('../../classes/connection.php');
include('../../classes/tags.class.php');

$db_connect = new Database_connection;

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

<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
      <ul class="space-y-2 font-medium">
         <li><a href="statistics.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"><span class="ms-3">Statistics</span></a></li>
         <li><a href="categories.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"><span class="flex-1 ms-3 whitespace-nowrap">Categories</span></a></li>
         <li><a href="Tags.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"><span class="flex-1 ms-3 whitespace-nowrap">Tags</span></a></li>
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
               $connection = $db_connect->connect();
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

</body>
</html>
   