<div class="flex space-x-1 justify-around ">

    <a href="{{ route('staff.users.edit', [$id]) }}"  class="p-1 text-blue-600 hover:bg-blue-600 hover:text-white rounded has-tooltip">
        <span class='tooltip rounded shadow-lg p-1 bg-gray-100 text-red-500 -mt-8'>Edit Patient Details</span>
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
    </a>    

    <a href="{{ route('staff.bpo.create', ['id' => $id]) }}"  class="p-1 text-blue-600 hover:bg-blue-600 hover:text-white rounded has-tooltip">
        <span class='tooltip rounded shadow-lg p-1 bg-gray-100 text-red-500 -mt-8'>Register New Patient</span>
        <img src="https://img.icons8.com/material-rounded/24/000000/heart-with-pulse.png"/>
    </a>     

</div>
