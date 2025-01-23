<?php
include('../../classes/connection.php');
include('../../classes/admin.php');
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



$status = isset($_POST['status']) ? $_POST['status'] : 'active'; 
$role = "student"; 

$students = new admin($connection);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['activate_user'])) {
        $student_id = $_POST['user_id'];
        $students->activate_inactivate_user($student_id,"active");
    }elseif (isset($_POST['inactivate_user'])) {
        $student_id = $_POST['user_id'];
        $students->activate_inactivate_user($student_id,"inactive");
    }elseif (isset($_POST['delete_user'])) {
        $student_id = $_POST['user_id'];
        $students->delete_user($student_id);
    }
}


$students_list = $students->read_users($role, $status);

$db_connect->disconnect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
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
                        <option value="active" <?php echo $status == 'active' ? 'selected' : ''; ?>>Active</option>
                        <option value="inactive" <?php echo $status == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                    </select>
                    <button type="submit" class="mt-2 p-2 bg-blue-500 text-white rounded">Filter</button>
                </form>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Profile Image</th>
                    <th scope="col" class="px-6 py-3">First Name</th>
                    <th scope="col" class="px-6 py-3">Last Name</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Phone</th>
                    <th scope="col" class="px-6 py-3">Role</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through the students list -->
                <?php foreach ($students_list as $student): ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4"><?php echo $student['user_id']; ?></td>
                        <td class="px-6 py-4">
                            <img src="<?php echo $student['image_profile']; ?>" alt="Profile" class="w-10 h-10 rounded-full">
                        </td>
                        <td class="px-6 py-4"><?php echo $student['first_name']; ?></td>
                        <td class="px-6 py-4"><?php echo $student['last_name']; ?></td>
                        <td class="px-6 py-4"><?php echo $student['email']; ?></td>
                        <td class="px-6 py-4"><?php echo $student['phone']; ?></td>
                        <td class="px-6 py-4"><?php echo ucfirst($student['role']); ?></td>
                        <td class="px-6 py-4">
                            <!-- Status Color -->
                            <span class="px-2 py-1 rounded-full <?php echo $student['status'] == 'active' ? 'bg-green-500' : 'bg-red-500'; ?> text-white">
                                <?php echo ucfirst($student['status']); ?>
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <!-- Actions: Activate/Inactivate -->
                            <?php if ($student['status'] == 'inactive'): ?>
                                <form  method="post" class="inline">
                                    <input type="hidden" name="user_id" value="<?php echo $student['user_id']; ?>">
                                    <button type="submit" name="activate_user" class="font-medium text-green-600 hover:underline">Activate</button>
                                </form>
                            <?php else: ?>
                                <form  method="post" class="inline mx-2">
                                    <input type="hidden" name="user_id" value="<?php echo $student['user_id']; ?>">
                                    <button type="submit" name="inactivate_user" class="font-medium text-yellow-600 hover:underline">Inactivate</button>
                                </form>
                            <?php endif; ?>
                            <form method="post" class="inline">
                                <input type="hidden" name="user_id" value="<?php echo $student['user_id']; ?>">
                                <button type="submit" name="delete_user" class="font-medium text-red-600 dark:text-red-700 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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
