<?php
include('../../classes/connection.php');
include('../../classes/categorie.class.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Creat_Course</title>
   <script src="https://cdn.tailwindcss.com"></script>
   <style>
            @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
      *{
      margin: 0;
      padding: 0;
      outline: none;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
      }
      body{
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      padding: 10px;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(115deg, #56d8e4 10%, #9f01ea 90%);
      }
      .container{
      max-width: 800px;
      background: #fff;
      width: 800px;
      padding: 25px 40px 10px 40px;
      box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
      }
      .container .text{
      text-align: center;
      font-size: 41px;
      font-weight: 600;
      font-family: 'Poppins', sans-serif;
      background: -webkit-linear-gradient(right, #56d8e4, #9f01ea, #56d8e4, #9f01ea);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      }
      .container form{
      padding: 30px 0 0 0;
      }
      .container form .form-row{
      display: flex;
      margin: 32px 0;
      }
      form .form-row .input-data{
      width: 100%;
      height: 40px;
      margin: 0 20px;
      position: relative;
      }
      form .form-row .textarea{
      height: 70px;
      }
      .input-data input,
      .textarea textarea{
      display: block;
      width: 100%;
      height: 100%;
      border: none;
      font-size: 17px;
      border-bottom: 2px solid rgba(0,0,0, 0.12);
      }
      .input-data input:focus ~ label, .textarea textarea:focus ~ label,
      .input-data input:valid ~ label, .textarea textarea:valid ~ label{
      transform: translateY(-20px);
      font-size: 14px;
      color: #3498db;
      }
      .textarea textarea{
      resize: none;
      padding-top: 10px;
      }
      .input-data label{
      position: absolute;
      pointer-events: none;
      bottom: 10px;
      font-size: 16px;
      transition: all 0.3s ease;
      }
      .textarea label{
      width: 100%;
      bottom: 40px;
      background: #fff;
      }
      .input-data .underline{
      position: absolute;
      bottom: 0;
      height: 2px;
      width: 100%;
      }
      .input-data .underline:before{
      position: absolute;
      content: "";
      height: 2px;
      width: 100%;
      background: #3498db;
      transform: scaleX(0);
      transform-origin: center;
      transition: transform 0.3s ease;
      }
      .input-data input:focus ~ .underline:before,
      .input-data input:valid ~ .underline:before,
      .textarea textarea:focus ~ .underline:before,
      .textarea textarea:valid ~ .underline:before{
      transform: scale(1);
      }
      .submit-btn .input-data{
      overflow: hidden;
      height: 45px!important;
      width: 25%!important;
      }
      .submit-btn .input-data .inner{
      height: 100%;
      width: 300%;
      position: absolute;
      left: -100%;
      background: -webkit-linear-gradient(right, #56d8e4, #9f01ea, #56d8e4, #9f01ea);
      transition: all 0.4s;
      }
      .submit-btn .input-data:hover .inner{
      left: 0;
      }
      .submit-btn .input-data input{
      background: none;
      border: none;
      color: #fff;
      font-size: 17px;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 1px;
      cursor: pointer;
      position: relative;
      z-index: 2;
      }
      @media (max-width: 700px) {
      .container .text{
         font-size: 30px;
      }
      .container form{
         padding: 10px 0 0 0;
      }
      .container form .form-row{
         display: block;
      }
      form .form-row .input-data{
         margin: 35px 0!important;
      }
      .submit-btn .input-data{
         width: 40%!important;
      }
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
         <li><a href="categories.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"><span class="flex-1 ms-3 whitespace-nowrap">Create a course</span></a></li>
         <li><a href="Tags.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"><span class="flex-1 ms-3 whitespace-nowrap">View courses</span></a></li>
      </ul>
   </div>
</aside>



<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
   <div class="container">
      <div class="text">
         Contact us Form
      </div>
      <form action="#">
         <div class="form-row">
            <div class="input-data">
               <input type="text" required>
               <div class="underline"></div>
               <label for="">title</label>
            </div>
            <div class="input-data">
               <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                  <option value="US">United States</option>
               </select>
            </div>
         </div>
         <div class="form-row">
         <div class="input-data">
         <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                  <option value="video">video</option>
                  <option value="document">document</option>
               </select>
          </div>

            <div class="input-data">
               <input type="file" required>
               <div class="underline"></div>
            </div>
         </div>



         <div class="form-row">
         <div class="input-data textarea">
            <textarea rows="8" cols="80" required></textarea>
            <br />
            <div class="underline"></div>
            <label for="">Write your message</label>
            <br />
            <div class="form-row submit-btn">
               <div class="input-data">
                  <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Default</button>
            </div>
      </form>
      </div>
   </div>
</div>




</body>
</html>
   

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