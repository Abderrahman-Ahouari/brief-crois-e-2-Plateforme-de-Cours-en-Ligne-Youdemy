     <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>categories</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    

<button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
   <span class="sr-only">Open sidebar</span>
   <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
   <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
   </svg>
</button>

<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
      <ul class="space-y-2 font-medium">
         <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <span class="ms-3">Statistics</span>
            </a>
         </li>
         <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <span class="flex-1 ms-3 whitespace-nowrap">Categories</span>
            </a>
         </li>
         <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <span class="flex-1 ms-3 whitespace-nowrap">Tags</span>
            </a>
         </li>
         <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <span class="flex-1 ms-3 whitespace-nowrap">Users</span>
            </a>
         </li>
         <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <span class="flex-1 ms-3 whitespace-nowrap">cources</span>
            </a>
         </li>
         <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <span class="flex-1 ms-3 whitespace-nowrap">Sign In</span>
            </a>
         </li>
         <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <span class="flex-1 ms-3 whitespace-nowrap">Sign Up</span>
            </a>
         </li>
      </ul>
   </div>
</aside>


<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
      <div class="grid grid-cols-3 gap-4 mb-4">
         <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
            <button onclick="openPopup()" 
               type="button" 
               class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
               Add Categorie
            </button>
         </div>
      </div>
      <div class="flex items-center justify-center mb-4 rounded bg-gray-50 dark:bg-gray-800">
         <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
               <tr>
                  <th scope="col" class="px-6 py-3">Id</th>
                  <th scope="col" class="px-6 py-3">Categorie</th>
                  <th scope="col" class="px-6 py-3">Edit</th>
                  <th scope="col" class="px-6 py-3">Delete</th>
               </tr>
            </thead>
            <tbody>
                              <tr>
                  <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">1</td>
                  <td class="px-6 py-4">ba bou bi</td>
                  <td class="px-6 py-4">
                     <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                  </td>
                  <td class="px-6 py-4">
                     <a href="#" class="font-medium text-red-600 dark:text-red-700 hover:underline">Delete</a>
                  </td>
               </tr>
                              <tr>
                  <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">2</td>
                  <td class="px-6 py-4">ba bou bi</td>
                  <td class="px-6 py-4">
                     <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                  </td>
                  <td class="px-6 py-4">
                     <a href="#" class="font-medium text-red-600 dark:text-red-700 hover:underline">Delete</a>
                  </td>
               </tr>
                              <tr>
                  <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">3</td>
                  <td class="px-6 py-4">ba bou bi</td>
                  <td class="px-6 py-4">
                     <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                  </td>
                  <td class="px-6 py-4">
                     <a href="#" class="font-medium text-red-600 dark:text-red-700 hover:underline">Delete</a>
                  </td>
               </tr>
                              <tr>
                  <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">4</td>
                  <td class="px-6 py-4">ba bou bi</td>
                  <td class="px-6 py-4">
                     <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                  </td>
                  <td class="px-6 py-4">
                     <a href="#" class="font-medium text-red-600 dark:text-red-700 hover:underline">Delete</a>
                  </td>
               </tr>
                           </tbody>
         </table>
      </div>
   </div>
</div>

<div id="popup-modal" class="fixed top-0 left-0 right-0 bottom-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
   <div class="bg-white rounded-lg shadow-lg w-1/3 p-4">
      <div class="flex justify-between items-center">
         <h2 class="text-lg font-medium">Add Categorie</h2>
         <button onclick="closePopup()" class="text-gray-600 hover:text-gray-900">&times;</button>
      </div>
      <form method="post">
         <div class="mt-4">
            <label for="categorie-name" class="block text-sm font-medium text-gray-700">Categorie Name</label>
            <input type="text" name="categorie_name" id="categorie-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm h-12">
         </div>
         <div class="mt-6 flex justify-end">
            <button type="button" onclick="closePopup()" class="text-gray-600 bg-gray-200 hover:bg-gray-300 font-medium rounded-lg text-sm px-4 py-2 me-2">
               Cancel
            </button>
            <button name="add_categorie" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-4 py-2">
               Add
            </button>
         </div>
      </form>
   </div>
</div>




<div id="edit-popup-modal" class="fixed top-0 left-0 right-0 bottom-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
   <div class="bg-white rounded-lg shadow-lg w-1/3 p-4">
      <div class="flex justify-between items-center">
         <h2 class="text-lg font-medium">Edit Categorie</h2>
         <button onclick="closeEditPopup()" class="text-gray-600 hover:text-gray-900">&times;</button>
      </div>
      <form id="edit-form">
         <input type="hidden" id="edit-id" name="id">
         <div class="mt-4">
            <label for="edit-name" class="block text-sm font-medium text-gray-700">Categorie Name</label>
            <input type="text" id="edit-name" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
         </div>
         <div class="mt-6 flex justify-end">
            <button type="button" onclick="closeEditPopup()" class="text-gray-600 bg-gray-200 hover:bg-gray-300 font-medium rounded-lg text-sm px-4 py-2 me-2">
               Cancel
            </button>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-4 py-2">
               Save Changes
            </button>
         </div>
      </form>
   </div>
</div>





<script>
   function openPopup() {
      document.getElementById('popup-modal').classList.remove('hidden');
   }
   function closePopup() {
      document.getElementById('popup-modal').classList.add('hidden');
   }




   // Open the edit popup and populate the form
function openEditPopup(id, name) {
   document.getElementById('edit-id').value = id;
   document.getElementById('edit-name').value = name;
   document.getElementById('edit-popup-modal').classList.remove('hidden');
}

// Close the edit popup
function closeEditPopup() {
   document.getElementById('edit-popup-modal').classList.add('hidden');
}

// Attach event listeners to the "Edit" links
document.querySelectorAll('.edit-link').forEach(link => {
   link.addEventListener('click', function (event) {
      event.preventDefault();
      const row = this.closest('tr');
      const id = row.querySelector('.category-id').textContent;
      const name = row.querySelector('.category-name').textContent;
      openEditPopup(id, name);
   });
});

// Handle the form submission
document.getElementById('edit-form').addEventListener('submit', function (event) {
   event.preventDefault();
   const id = document.getElementById('edit-id').value;
   const name = document.getElementById('edit-name').value;

   // Send the data to the server using AJAX or form submission
   console.log(`Updating category with ID: ${id}, Name: ${name}`);
   // Perform your server request here
   closeEditPopup();
});

</script>

</body>
</html>