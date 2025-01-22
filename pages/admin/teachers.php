<?php
include('../../classes/connection.php');
include('../../classes/admin.php');

$db_connect = new Database_connection;
$connection = $db_connect->connect();

$status = isset($_POST['status']) ? $_POST['status'] : 'active'; 
$role = "teacher"; 


$students = new admin($connection);
$students_list = $students->read_users($role, $status);

$db_connect->disconnect();
?>
z
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>teachers</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <li><a href="statistics.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"><span class="ms-3">Statistics</span></a></li>
            <li><a href="categories.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"><span class="flex-1 ms-3 whitespace-nowrap">Categories</span></a></li>
            <li><a href="Tags.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"><span class="flex-1 ms-3 whitespace-nowrap">Tags</span></a></li>
            <li><a href="students.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"><span class="flex-1 ms-3 whitespace-nowrap">Students</span></a></li>
            <li><a href="teachers.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"><span class="flex-1 ms-3 whitespace-nowrap">Teachers</span></a></li>
        </ul> 
    </div>
</aside>

<div class="p-4 sm:ml-64">
    <!-- Filter Status Dropdown -->
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

    <!-- Table of Users -->
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
                                <form action="activate.php" method="post" class="inline">
                                    <input type="hidden" name="user_id" value="<?php echo $student['user_id']; ?>">
                                    <button type="submit" name="activate_user" class="font-medium text-green-600 hover:underline">Activate</button>
                                </form>
                            <?php else: ?>
                                <form action="inactivate.php" method="post" class="inline mx-2">
                                    <input type="hidden" name="user_id" value="<?php echo $student['user_id']; ?>">
                                    <button type="submit" name="inactivate_user" class="font-medium text-yellow-600 hover:underline">Inactivate</button>
                                </form>
                            <?php endif; ?>
                            <form action="delete.php" method="post" class="inline">
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
</body>
</html>
