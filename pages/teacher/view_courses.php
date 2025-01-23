    <?php
    include('../../classes/connection.php');
    include('../../classes/Course.php');
    include('../../classes/categorie.class.php');
    include('../../classes/cours_video.php');
    include('../../classes/cours_document.php');
    include('../../classes/user.class.php');
    session_start();


    $db_connect = new Database_connection;
    $connection = $db_connect->connect();



if ($_SESSION['role'] !== 'teacher') {
   header("Location: ../student/catalogue.php");
   exit;
}



    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connection = $db_connect->connect();

        if (isset($_POST['delete_course'])) {
            $course_id = $_POST['delete_course_id'];
            $course = new course($connection);
            $course->setCourseId($course_id);
            $course->deleteCourse();
        } elseif (isset($_POST['modify_course'])) {

            $upload_folder = "../../Uploads/";

            $cover_name = basename($_FILES['cover']['name']);
            $content_name = basename($_FILES['content']['name']);
        
            $cover_path = $upload_folder . $cover_name;
            $content_path = $upload_folder . $content_name;
        
            move_uploaded_file($_FILES['cover']['tmp_name'], $cover_path); 
            move_uploaded_file($_FILES['content']['tmp_name'], $content_path); 
        

            $title = $_POST['title'];
            $description = $_POST['description'];
            $categorie_id = $_POST['category'];
            $teacher_id = $_SESSION['id'];
            $duration = $_POST['duration'];
            $nbr_pages = $_POST['nbr_pages']; 
            $cours_id = $_POST['course_id']; 

            

            if ($_POST['content_type'] === "video") {
                $video_course = new VideoCourse($connection, $cours_id, $title, $description, $cover_path, $content_path, $duration, $categorie_id, $teacher_id);
                $video_course->modifyCourse();
            } elseif ($_POST['content_type'] === "document") {
                $document_course = new DocumentCourse($connection, $cours_id, $title, $description, $cover_path, $content_path, $nbr_pages, $categorie_id, $teacher_id);
                $document_course->modifyCourse();
             }
        }elseif (isset($_POST['logout'])) {
            $user = new user();
            $user->logout();
            header("Location: ../signup.php");
      
         }
        
    $db_connect->disconnect();
    }



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
            <li>
         <form action="" method="POST" class="inline">
            <button type="submit" 
                    class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md transition duration-300"
                    name="logout">
                Logout
            </button>
        </form>
         </li>
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
                                <input type="hidden" value="<?= htmlspecialchars($course['cover']) ?>">
                            </div>
                        </td>
                        <td class="px-6 py-4"><?= htmlspecialchars($course['course_id']) ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($course['title']) ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($course['description']) ?></td>
                        <?php if($course['nbr_page'] == NULL){ ?>
                        <td class="px-6 py-4">
                            <img src="../../Uploads/film.png" class="w-1/2">
                            <input type="hidden" value="<?= htmlspecialchars($course['content']) ?>">
                        </td>
                        <?php }else{ ?>
                        <td class="px-6 py-4">
                            <img src="../../Uploads/pdf.png" class="w-1/2">
                            <input type="hidden" value="<?= htmlspecialchars($course['content']) ?>">
                        </td>
                        <?php } ?>
                        <td class="px-6 py-4"><?= htmlspecialchars($course['duration'] ?? 'N/A') ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($course['nbr_page'] ?? 'N/A') ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($course['name']) ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($course['cours_status']) ?></td>
                        <td class="flex items-center px-6 py-4">
                                <a href="#" name="update_course" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            <form action="" method="post">
                                <input name="delete_course_id" type="hidden" value="<?= htmlspecialchars($course['course_id']) ?>">
                                <button name="delete_course"><a  class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Remove</a></button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    </div>
    </div>


    <div id="modify-course-form-container" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
        <div class="relative w-full max-w-[500px] bg-white p-4 rounded-lg shadow-lg">
            <button id="close-form" class="absolute top-2 right-2 text-gray-600 text-xl">×</button>
            <form id="modify-course-form" method="post" enctype="multipart/form-data">
                <input type="hidden" id="course-id" name="course_id" />

                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="mb-1 block text-sm font-medium text-[#07074D]">Title</label>
                    <input type="text" name="title" id="title" placeholder="Enter the course title" required
                        class="w-full rounded border border-[#e0e0e0] bg-white py-1 px-3 text-sm font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-sm" />
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="mb-1 block text-sm font-medium text-[#07074D]">Description</label>
                    <textarea name="description" id="description" placeholder="Enter the course description" required
                        class="w-full rounded border border-[#e0e0e0] bg-white py-1 px-3 text-sm font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-sm"></textarea>
                </div>

                <!-- Cover Image -->
                <div class="mb-3">
                    <label for="cover" class="mb-1 block text-sm font-medium text-[#07074D]">Cover Image</label>
                    <input type="file" name="cover" id="cover" required
                        class="w-full rounded border border-[#e0e0e0] bg-white py-1 px-3 text-sm font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-sm" />
                </div>

                <!-- Category -->
                <div class="mb-3">
                    <label for="category" class="mb-1 block text-sm font-medium text-[#07074D]">Category</label>
                    <select name="category" id="category" required
                        class="w-full rounded border border-[#e0e0e0] bg-white py-1 px-3 text-sm font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-sm">
                        <?php
                            $categorie = new Categorie($connection);
                            $categories = $categorie->read_categories();

                            foreach ($categories as $category) { ?>
                        <option value="<?= htmlspecialchars($category['categorie_id']) ?>"><?= htmlspecialchars($category['name']) ?></option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Content Type -->
                <div class="mb-3">
                    <label for="content-type" class="mb-1 block text-sm font-medium text-[#07074D]">Content Type</label>
                    <select name="content_type" id="content-type"
                        class="w-full rounded border border-[#e0e0e0] bg-white py-1 px-3 text-sm font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-sm">
                        <option value="document">Document</option>
                        <option value="video">Video</option>
                    </select>
                </div>

                <!-- Content -->
                <div class="mb-3">
                    <label for="content" class="mb-1 block text-sm font-medium text-[#07074D]">Content</label>
                    <input type="file" name="content" id="content" required
                        class="w-full rounded border border-[#e0e0e0] bg-white py-1 px-3 text-sm font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-sm" />
                </div>

                <!-- Conditional Inputs (Duration or Number of Pages) -->
                <div class="mb-3 hidden" id="duration-input">
                    <label for="duration" class="mb-1 block text-sm font-medium text-[#07074D]">Duration (e.g., 2h 30m)</label>
                    <input type="text" name="duration" id="duration" placeholder="Enter video duration" 
                        class="w-full rounded border border-[#e0e0e0] bg-white py-1 px-3 text-sm font-medium text-[#6B7280]                     outline-none focus:border-[#6A64F1] focus:shadow-sm" />
                </div>

                <div class="mb-3 hidden" id="nbr-pages-input">
                    <label for="nbr-pages" class="mb-1 block text-sm font-medium text-[#07074D]">Number of Pages</label>
                    <input type="number" name="nbr_pages" id="nbr-pages" placeholder="Enter number of pages" 
                        class="w-full rounded border border-[#e0e0e0] bg-white py-1 px-3 text-sm font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-sm" />
                </div>

                <!-- Submit Button -->
                <div>
                    <button name="modify_course" type="submit"
                        class="hover:shadow-form w-full rounded bg-[#6A64F1] py-2 px-4 text-center text-sm font-semibold text-white outline-none">
                        Save Changes
                    </button>
                </div>
            </form>
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
    updateCloseButton()

        // Handle dynamic display of inputs based on content type
        document.getElementById('content-type').addEventListener('change', function () {
            const contentType = this.value;
            const durationInput = document.getElementById('duration-input');
            const nbrPagesInput = document.getElementById('nbr-pages-input');

            // Reset visibility
            durationInput.classList.add('hidden');
            nbrPagesInput.classList.add('hidden');

            // Show appropriate input
            if (contentType === 'video') {
                durationInput.classList.remove('hidden');
            } else if (contentType === 'document') {
                nbrPagesInput.classList.remove('hidden');
            }
        });


        document.querySelectorAll('a[name="update_course"]').forEach((editButton) => {
        editButton.addEventListener('click', function (e) {
            e.preventDefault();

            // Get the row data
            const row = this.closest('tr');
            const id = row.querySelector('td:nth-child(2)').innerText.trim();
            const title = row.querySelector('td:nth-child(3)').innerText.trim();
            const description = row.querySelector('td:nth-child(4)').innerText.trim();
            const category = row.querySelector('td:nth-child(8)').innerText.trim();
            const duration = row.querySelector('td:nth-child(6)').innerText.trim();
            const nbrPages = row.querySelector('td:nth-child(7)').innerText.trim();
            const contentType = nbrPages !== 'N/A' ? 'document' : 'video';

            // Populate the form
            document.getElementById('title').value = title;
            document.getElementById('description').value = description;

            // Select category by matching text
            const categoryDropdown = document.getElementById('category');
            Array.from(categoryDropdown.options).forEach(option => {
                if (option.text.trim() === category) {
                    option.selected = true;
                }
            });

            document.getElementById('content-type').value = contentType;

            // Show the relevant input fields and populate them
            if (contentType === 'video') {
                document.getElementById('duration-input').classList.remove('hidden');
                document.getElementById('nbr-pages-input').classList.add('hidden');
                document.getElementById('duration').value = duration;
            } else {
                document.getElementById('nbr-pages-input').classList.remove('hidden');
                document.getElementById('duration-input').classList.add('hidden');
                document.getElementById('nbr-pages').value = nbrPages;
            }

            // Add the course ID to a hidden input (if needed for the backend)
            let hiddenIdField = document.getElementById('course-id');
            if (!hiddenIdField) {
                hiddenIdField = document.createElement('input');
                hiddenIdField.type = 'hidden';
                hiddenIdField.id = 'course-id';
                hiddenIdField.name = 'course_id';
                document.getElementById('modify-course-form').appendChild(hiddenIdField);
            }
            hiddenIdField.value = id;

            // Show the form modal
            document.getElementById('modify-course-form-container').classList.remove('hidden');
        });
        });

        // Close the form modal
        document.getElementById('close-form').addEventListener('click', function () {
            document.getElementById('modify-course-form-container').classList.add('hidden');
        });


        
</script>





    </body>
    </html>
