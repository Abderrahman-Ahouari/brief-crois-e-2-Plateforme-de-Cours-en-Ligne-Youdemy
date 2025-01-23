<?php
include('../../classes/connection.php');
include('../../classes/Course.php');
include('../../classes/tags.class.php');
include('../../classes/categorie.class.php');
include('../../classes/cours_video.php');
include('../../classes/cours_document.php');
include('../../classes/tags_courses.php');
include('../../classes/user.class.php');


$db_connect = new Database_connection;
$connection = $db_connect->connect();



    // manage access
    $user = new User($connection);
$user->verify_user_status();
if ($_SESSION['role'] !== 'teacher') {
   header("Location: ../student/catalogue.php");
   exit;
}



if ($_SERVER['REQUEST_METHOD'] === 'POST'){
   $connection = $db_connect->connect();

   $upload_folder = "../../Uploads/";

   $cover_name = basename($_FILES['cover_image']['name']);
   $content_name = basename($_FILES['content']['name']);

   $cover_path = $upload_folder . $cover_name;
   $content_path = $upload_folder . $content_name;

   move_uploaded_file($_FILES['cover_image']['tmp_name'], $cover_path); 
   move_uploaded_file($_FILES['content']['tmp_name'], $content_path); 

   $title = $_POST['title'];
   $description = $_POST['description'];
   $categorie_id = $_POST['category'];
   $teacher_id = 2;
   $duration = $_POST['video_duration'];
   $nbr_pages = $_POST['document_pages'];
   $cours_id;  
   $tags = $_POST['tags'];

   if ($_POST['content_type'] === "video") {
      $video_course = new VideoCourse($connection, null, $title, $description, $cover_path, $content_path, $duration, $categorie_id, $teacher_id);
      $cours_id = $video_course->add_course();
  } elseif ($_POST['content_type'] === "document") {
      $document_course = new DocumentCourse($connection, null, $title, $description, $cover_path, $content_path, $nbr_pages, $categorie_id, $teacher_id);
      $cours_id = $document_course->add_course();
   }

   $cours_tags = new tags_courses($cours_id, $tags, $connection);
   
   $cours_tags->insert_course_tags();
   $db_connect->disconnect();             
}



$categorie = new Categorie($connection);
$categories = $categorie->read_categories();

$tag = new Tags($connection);
$tags_list = $tag->read_tags();

$db_connect->disconnect();

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Creat_Course</title>
   <script src="https://cdn.tailwindcss.com"></script>
<style>
         @import url(https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600);

      * {
         margin:0;
         padding:0;
         box-sizing:border-box;
         -webkit-box-sizing:border-box;
         -moz-box-sizing:border-box;
         -webkit-font-smoothing:antialiased;
         -moz-font-smoothing:antialiased;
         -o-font-smoothing:antialiased;
         font-smoothing:antialiased;
         text-rendering:optimizeLegibility;
      }

      body {
         font-family:"Open Sans", Helvetica, Arial, sans-serif;
         font-weight:300;
         font-size: 12px;
         line-height:30px;
         color:#777;
         background:#0CF;
      }

      .container {
         max-width:400px;
         width:100%;
         margin:0 auto;
         position:relative;
      }

      #contact input[type="text"], #contact input[type="email"], #contact input[type="tel"], #contact input[type="url"], #contact textarea, #contact button[type="submit"] { font:400 12px/16px "Open Sans", Helvetica, Arial, sans-serif; }

      #contact {
         background:#F9F9F9;
         padding:25px;
         margin:50px 0;
      }

      #contact h3 {
         color: #F96;
         display: block;
         font-size: 30px;
         font-weight: 400;
      }

      #contact h4 {
         margin:5px 0 15px;
         display:block;
         font-size:13px;
      }

      fieldset {
         border: medium none !important;
         margin: 0 0 10px;
         min-width: 100%;
         padding: 0;
         width: 100%;
      }

      #contact input[type="text"], #contact input[type="email"], #contact input[type="tel"], #contact input[type="url"], #contact textarea {
         width:100%;
         border:1px solid #CCC;
         background:#FFF;
         margin:0 0 5px;
         padding:10px;
      }

      #contact input[type="text"]:hover, #contact input[type="email"]:hover, #contact input[type="tel"]:hover, #contact input[type="url"]:hover, #contact textarea:hover {
         -webkit-transition:border-color 0.3s ease-in-out;
         -moz-transition:border-color 0.3s ease-in-out;
         transition:border-color 0.3s ease-in-out;
         border:1px solid #AAA;
      }

      #contact textarea {
         height:100px;
         max-width:100%;
      resize:none;
      }

      #contact button[type="submit"] {
         cursor:pointer;
         width:100%;
         border:none;
         background:#0CF;
         color:#FFF;
         margin:0 0 5px;
         padding:10px;
         font-size:15px;
      }

      #contact button[type="submit"]:hover {
         background:#09C;
         -webkit-transition:background 0.3s ease-in-out;
         -moz-transition:background 0.3s ease-in-out;
         transition:background-color 0.3s ease-in-out;
      }

      #contact button[type="submit"]:active { box-shadow:inset 0 1px 3px rgba(0, 0, 0, 0.5); }

      #contact input:focus, #contact textarea:focus {
         outline:0;
         border:1px solid #999;
      }
      ::-webkit-input-placeholder {
      color:#888;
      }
      :-moz-placeholder {
      color:#888;
      }
      ::-moz-placeholder {
      color:#888;
      }
      :-ms-input-placeholder {
      color:#888;
      }

</style>
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
         <li><a href="add_course.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"><span class="flex-1 ms-3 whitespace-nowrap">Create a course</span></a></li>
         <li><a href="view_courses.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"><span class="flex-1 ms-3 whitespace-nowrap">View courses</span></a></li>
      </ul>
   </div>
</aside>



<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
      <div class="container">  
      <form id="contact" action="" method="post" enctype="multipart/form-data">
         <h3>Create a Course</h3>
         <h4>Fill in the details below to create a new course</h4>
         
         <!-- Title -->
         <fieldset>
            <input name="title" placeholder="Course Title" type="text" tabindex="1" required autofocus>
         </fieldset>

         <!-- Description -->
         <fieldset>
            <textarea name="description" placeholder="Course Description" tabindex="2" required></textarea>
         </fieldset>

         <!-- Category -->
         <fieldset class="mt-4">
            <label for="" class="text-[#F96] text-[14px]">select categorie</label>
            <select name="category" tabindex="3" class="ml-16" required>
            <?php foreach ($categories as $category){ ?>
               <option value="<?= htmlspecialchars($category['categorie_id']) ?>">
                  <?= htmlspecialchars($category['name']) ?>
               </option>
            <?php } ?>
            </select>
         </fieldset> 

         <!-- Tags -->
         <fieldset class="mt-4" >
            <label for="" class="text-[#F96] text-[14px]">select tags</label>
               <select name="tags[]" class="ml-16"  tabindex="4" multiple required>
               <?php foreach ($tags_list as $tag){ ?>
                  <option value="<?= htmlspecialchars($tag['tag_id']) ?>">
                     <?= htmlspecialchars($tag['name']) ?>
                  </option>
               <?php } ?>
               </select>
         </fieldset>

         <!-- Cover Image -->
         <fieldset class="mt-6">
            <label for="" class="text-[#F96] text-[14px] w-64 h-screen bg-black-50 dark:bg-gray-800">cover image</label>
            <input name="cover_image" type="file" class="ml-24" tabindex="5" accept="image/*" required>
         </fieldset>

         <!-- Content and Type -->
         <fieldset class="mt-3">
            <label for="content_type" class="text-[#F96] text-[14px]">Content</label>
            <select id="content_type" name="content_type" class="ml-16" tabindex="7" required>
               <option value="video">Video</option>
               <option value="document">Document</option>
            </select>
            <input class="ml-20 mt-2" id="content_file" name="content" type="file" tabindex="6" accept=".pdf,.doc,.docx,.mp4,.avi,.mov" required>
            
            <!-- Additional inputs -->
            <input class="ml-20 mt-2 hidden" id="document_pages" name="document_pages" type="number" placeholder="Number of Pages" tabindex="8" min="1">
            <input class="ml-20 mt-2 hidden" id="video_duration" name="video_duration" type="text" placeholder="Video Duration (e.g., 10:30)">
         </fieldset>


         <!-- Submit Button -->
         <fieldset>
            <button name="submit" type="submit"  id="contact-submit" data-submit="...Sending">Create Course</button>
         </fieldset>
      </form>
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


   document.addEventListener("DOMContentLoaded", () => {
   const contentTypeSelect = document.getElementById("content_type");
   const documentPagesInput = document.getElementById("document_pages");
   const videoDurationInput = document.getElementById("video_duration");

   contentTypeSelect.addEventListener("change", () => {
      const selectedValue = contentTypeSelect.value;

      if (selectedValue === "document") {
         documentPagesInput.classList.remove("hidden"); // Show document pages input
         documentPagesInput.setAttribute("required", "required"); // Make it required
         videoDurationInput.classList.add("hidden"); // Hide video duration input
         videoDurationInput.removeAttribute("required"); // Remove required attribute
      } else if (selectedValue === "video") {
         videoDurationInput.classList.remove("hidden"); // Show video duration input
         videoDurationInput.setAttribute("required", "required"); // Make it required
         documentPagesInput.classList.add("hidden"); // Hide document pages input
         documentPagesInput.removeAttribute("required"); // Remove required attribute
      } else {
         // Hide both inputs if no specific type is selected
         documentPagesInput.classList.add("hidden");
         documentPagesInput.removeAttribute("required");
         videoDurationInput.classList.add("hidden");
         videoDurationInput.removeAttribute("required");
      }
   });

   // Trigger the change event initially to handle prefilled or default selections
   contentTypeSelect.dispatchEvent(new Event("change"));
 });

</script>
</body>
</html>
   

