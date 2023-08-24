

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrator</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>

<div class="flex h-screen">
    <!-- Sidebar -->
    <div class="w-1/5 bg-dark p-6 space-y-6">
        <div class="flex flex-col items-center mb-6">
            @if (!empty(Auth::user()->avatar_path))
                                    <img src="{{ asset('storage/' . Auth::user()->avatar_path) }}" class="w-24 h-24 bg-gray-300 rounded-full mb-4" alt="{{ Auth::user()->name }}">
                                @else
                                    <div class="w-24 h-24 bg-gray-300 rounded-full mb-4"></div>
                                @endif<!-- Placeholder Avatar -->
            <div class="text-xl font-semibold ">{{ Auth::user()->name }}</div> <!-- Nume utilizator -->
            <div class="text-gray-400 text-sm">{{ Auth::user()->email }}</div> <!-- Email utilizator -->

            <div class="flex space-x-4 mt-6"> 
                <a href="{{ route('posts.index') }}">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21 13v10h-6v-6h-6v6h-6v-10h-3l12-12 12 12h-3zm-1-5.907v-5.093h-3v2.093l3 3z"/></svg>
                    </div> 
                </a>
                <!-- Buton pentru a logout -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">
                        
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16 9v-4l8 7-8 7v-4h-8v-6h8zm-2 10v-.083c-1.178.685-2.542 1.083-4 1.083-4.411 0-8-3.589-8-8s3.589-8 8-8c1.458 0 2.822.398 4 1.083v-2.245c-1.226-.536-2.577-.838-4-.838-5.522 0-10 4.477-10 10s4.478 10 10 10c1.423 0 2.774-.302 4-.838v-2.162z"/></svg>
                    </button>
                </form>

            </div>  
           
        </div>

    
        <hr class="mb-4">

        <!-- Meniu cu sub-butoane -->
        <div>
            <button class="w-full p-2 text-left focus:outline-none focus:bg-gray-200 hover:bg-gray-100 transition duration-300" onclick="toggleDropdown('dropdown1')">Utilizatori</button>
            <div id="dropdown1" class="transform transition-all max-h-0 overflow-hidden duration-300 space-y-2 pl-4">
                <button class="w-full p-2 text-left focus:outline-none focus:bg-gray-200 hover:bg-gray-100 transition duration-300" onclick="showContent('sectiune1-1')">Prezentare generală</button>
            </div>

            <button class="w-full p-2 text-left focus:outline-none focus:bg-gray-200 hover:bg-gray-100 transition duration-300 mt-4" onclick="toggleDropdown('dropdown2')">Postari</button>
            <div id="dropdown2" class="transform transition-all max-h-0 overflow-hidden duration-300 space-y-2 pl-4">
                <button class="w-full p-2 text-left focus:outline-none focus:bg-gray-200 hover:bg-gray-100 transition duration-300" onclick="showContent('sectiune2-1')">Prezentare generală</button>
                <button class="w-full p-2 text-left focus:outline-none focus:bg-gray-200 hover:bg-gray-100 transition duration-300" onclick="showContent('sectiune2-2')">Reported Posts</button>
            </div>
        </div>
    </div>
    
    <div id="sectiune1-1" class="content-section transform transition-all opacity-0 -translate-y-4 h-screen">
        <!-- Conținut pentru Secțiunea 1.1 -->
        
        <div class="w-full bg-white p-6 underline text-xl font-semibold mb-4">
            Users: {{ $userCount }}
        </div>
        

        <hr class = "mb-4">
        <!-- Grafice -->
            <div class="flex justify-between">
                <div class="chart-container w-1/4">
                    <canvas id="grafic1"></canvas>
                </div>

                <div class="border-l-2 h-64 my-4 mx-4"></div>  <!-- Linia de despărțire -->

                <div class="chart-container w-1/4">
                    <canvas id="grafic2"></canvas>
                </div>

            </div>
            <hr class="mb-4">
            <!-- Start Table -->
            <div class="bg-gray-100 min-h-screen p-4">
                <div class="mb-4 p-4 bg-white shadow rounded-md">
                    <form action="{{ route('admin.search') }}" method="GET" class="flex items-center">
                        <input type="text" name="query" placeholder="Caută după username, nume sau e-mail" class="flex-grow p-2 rounded-md border border-gray-300 shadow-sm">
                        <button type="submit" class="ml-2 p-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Caută</button>
                    </form>
                </div>

                <table class="w-full bg-white shadow-md rounded-md overflow-hidden text-gray-700">
                    <thead class="bg-gray-200">
                        <tr class="text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-2 px-6 text-left bg-gray-200">@username</th>
                            <th class="py-2 px-6 text-left bg-gray-200">@name</th>
                            <th class="py-2 px-6 text-left bg-gray-200">@email</th>
                            <th class="py-2 px-6 text-left bg-gray-200">@created_at</th>
                            <th class="py-2 px-6 text-left bg-gray-200">@is_active</th>
                            <th class="py-2 px-6 text-left bg-gray-200">@is_admin</th>
                            <th class="py-2 px-6 text-left bg-gray-200">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="text-sm hover:bg-gray-100 transition duration-300" data-user-id="{{ $user->id }}">
                                <td class="py-2 px-6 border-b border-gray-200">{{ $user->username }}</td>
                                <td class="py-2 px-6 border-b border-gray-200">{{ $user->name }}</td>
                                <td class="py-2 px-6 border-b border-gray-200">{{ $user->email }}</td>
                                <td class="py-2 px-6 border-b border-gray-200">{{ $user->created_at }}</td>
                                <td class="py-2 px-6 border-b border-gray-200 {{ $user->is_active ? 'text-green-500' : 'text-red-500' }}">
                                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                                </td>
                                <td class="py-2 px-6 border-b border-gray-200 {{ $user->is_admin ? 'text-green-500' : 'text-red-500' }}">
                                    {{ $user->is_admin ? 'Admin' : 'Not Admin' }}
                                </td>
                                <td class="py-2 px-6 border-b border-gray-200 flex items-center space-x-2">
                                <button class="text-red-600 hover:text-red-900 delete-row focus:outline-none">X</button>
                                <span class="text-gray-400">|</span>
                                <button class="text-blue-600 hover:text-blue-900 edit-row focus:outline-none">Edit</button>
                            </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
        

    
        

    








      

    <div id="sectiune2-1" class="content-section hidden transform transition-all opacity-0 -translate-y-4">
        <!-- Conținut pentru Secțiunea 2.1 -->
       <div class="w-full bg-white p-6 underline text-xl font-semibold mb-4">
            Posts: {{ $postsCount }}
        </div>
        

        <hr class = "mb-4">
        <!-- Grafice -->
            <div class="flex justify-between">
                <div class="chart-container w-3/4">
                    <canvas id="graficPostari"></canvas>
                </div>
                

                <div class="border-l-2 h-64 my-4 mx-4"></div>  <!-- Linia de despărțire -->

               
                <div class="chart-container w-full">
                    <canvas id="categoryChart"></canvas>
                </div>



            </div>
            <hr class="mb-4">
            <!-- Start Table -->
            <div class="bg-gray-100 min-h-screen p-4">
                

                <table class="w-full bg-white shadow-md rounded-md overflow-hidden text-gray-700">
                    <thead class="bg-gray-200">
                        <tr class="text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-2 px-6 text-left bg-gray-200">@Title</th>
                            <th class="py-2 px-6 text-left bg-gray-200">@Category</th>
                            <th class="py-2 px-6 text-left bg-gray-200">@Posted_by</th>
                            <th class="py-2 px-6 text-left bg-gray-200">@Created_at</th>
                            <th class="py-2 px-6 text-left bg-gray-200">@Reports Count</th>
                            <th class="py-2 px-6 text-left bg-gray-200">@Link_post</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr class="text-sm hover:bg-gray-100 transition duration-300" data-post-id="{{ $post->id }}">
                                <td class="py-2 px-6 border-b border-gray-200">{{ $post->title }}</td>
                                <td class="py-2 px-6 border-b border-gray-200">{{ $post->category->name }}</td>
                                <td class="py-2 px-6 border-b border-gray-200">{{ $post->user->name }}</td>
                                <td class="py-2 px-6 border-b border-gray-200">{{ $post->created_at }}</td>
<td class="py-2 px-6 border-b border-gray-200">{{ $reportsCountPerPost[$post->id] ?? 0 }}</td>
                                <td class="py-2 px-6 border-b border-gray-200"><a href="{{ route('posts.show', $post->id) }}" target="_blank">Link</a></td>
                            </tr>
                            
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>


        



       


    <div id="sectiune2-2" class="content-section hidden transform transition-all opacity-0 -translate-y-4">
        <!-- Conținut pentru Secțiunea 2.2 -->
         <div class="w-full bg-white p-6 underline text-xl font-semibold mb-4">
            Reporturi: {{ $reportedPostsCount }}
        </div>
        

        <hr class = "mb-4">
        
            <div class="bg-gray-100 min-h-screen p-4">
                

                <table class="w-full bg-white shadow-md rounded-md overflow-hidden text-gray-700">
                    <thead class="bg-gray-200">
                        <tr class="text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-2 px-6 text-left bg-gray-200">@Title</th>
                            <th class="py-2 px-6 text-left bg-gray-200">@Posted_by</th>
                            <th class="py-2 px-6 text-left bg-gray-200">@Reported_by</th>
                            <th class="py-2 px-6 text-left bg-gray-200">@Reason</th>
                            <th class="py-2 px-6 text-left bg-gray-200">@How many times reported</th>
                            <th class="py-2 px-6 text-left bg-gray-200">@Link_post</th>
                        </tr>
                    </thead>
                        <tbody>
                        @foreach ($reportedPostsID as $reportPostID)
                            @foreach ($posts as $post)
                                @if ($post->id == $reportPostID)
                                    <tr class="text-sm hover:bg-gray-100 transition duration-300" data-post-id="{{ $post->id }}">
                                        <td class="py-2 px-6 border-b border-gray-200">{{ $post->title }}</td>
                                        <td class="py-2 px-6 border-b border-gray-200">{{ $post->user->name }}</td>
                                        <td class="py-2 px-6 border-b border-gray-200">{{ $post->user->name }}</td>
                                        <td class="py-2 px-6 border-b border-gray-200">
                                            @foreach ($reportReasonsPerPost[$post->id] as $reason)
                                                {{ $reason }}<br>
                                            @endforeach
                                        </td>
                                        <td class="py-2 px-6 border-b border-gray-200">{{ $reportsCountPerPost[$post->id] ?? 0 }}</td>
                                        <td class="py-2 px-6 border-b border-gray-200"><a href="{{ route('posts.show', $post->id) }}" target="_blank">Link</a></td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach

                    </tbody>


                </table>
            </div>
        </div>

        
    </div>






        


</div>

<script>


  function toggleDropdown(dropdownId) {
    const dropdown = document.getElementById(dropdownId);
    if (dropdown.style.maxHeight) {
      dropdown.style.maxHeight = null;
    } else {
      dropdown.style.maxHeight = dropdown.scrollHeight + "px";
    }
  }

  function showContent(sectionId) {
    let sections = document.querySelectorAll('.content-section');
    sections.forEach(section => {
      section.classList.add('hidden');
      section.style.opacity = "0";
      section.style.transform = "translateY(-1rem)";
    });

    let activeSection = document.getElementById(sectionId);
    activeSection.classList.remove('hidden');

    setTimeout(() => {
      activeSection.style.opacity = "1";
      activeSection.style.transform = "translateY(0)";
    }, 50);
  }

  document.addEventListener('DOMContentLoaded', function() {
    const ctx1 = document.getElementById('grafic1').getContext('2d');
    const ctx2 = document.getElementById('grafic2').getContext('2d');

    const dateGrafic1 = {
      labels: ['Blocati', 'Activi'],
      datasets: [{
        data: [{{ $isNotActiveCount }}, {{ $isActiveCount }}],
        backgroundColor: ['red', 'green']
      }]
    };

    const dateGrafic2 = {
      labels: ['User', 'Admin'],
      datasets: [{
        data: [{{ $isNotAdminCount }}, {{ $isAdminCount }}],
        backgroundColor: ['blue', 'cyan']
      }]
    };

    new Chart(ctx1, {
      type: 'pie',
      data: dateGrafic1,
    });

    new Chart(ctx2, {
      type: 'pie',
      data: dateGrafic2,
    });
  });




    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('graficPostari').getContext('2d');
    
        const dateGrafic = {
        labels: ['Posts OK', 'Posts Reported'],
        datasets: [{
            data: [{{ $postsCountOK }}, {{ $countPostsReport }}],
            backgroundColor: ['green', 'red']
        }]
        };
    
        new Chart(ctx, {
        type: 'pie',
        data: dateGrafic,
        });
    });


        var ctx = document.getElementById('categoryChart').getContext('2d');
    var labels = {!! json_encode(array_column($categoryData, 'name')) !!};
    var data = {!! json_encode(array_column($categoryData, 'posts_count')) !!};
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Number of posts by category',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
   
  


 

$('.delete-row').click(function() {
    var $row = $(this).closest('tr');
    var userId = $row.data('user-id'); // Assuming the user ID is stored in a data attribute
    $.ajax({
        url: '/administrator/' + userId, // Updated URL
        method: 'DELETE',
        success: function(response) {
            if (response.status === 'success') {
                $row.remove();
            } else {
                alert('Failed to delete user: ' + response.message);
            }
        },
        error: function() {
            alert('An error occurred while deleting the user.');
        }
    });
});


$('.edit-row').click(function() {
    var $button = $(this);
    var $row = $button.closest('tr');
    var userId = $row.data('user-id'); // Assuming the user ID is stored in a data attribute
    if ($button.text() === 'Edit') {
        $row.find('td').each(function(index, td) {
            if (index < 6) {
                var content = $(td).text().trim(); // Folosește trim pentru a elimina spațiile albe
                $(td).html('<input type="text" value="' + content + '">');
            }
        });
        $button.text('Save');
    } else { // Save action
        var userData = {};
        $row.find('td').each(function(index, td) {
            if (index < 6) {
                var content = $(td).find('input').val();
                $(td).text(content);
                // Mapping the content to the corresponding user field
                userData[['username', 'name', 'email', 'created_at', 'is_active', 'is_admin'][index]] = content;
            }
        });
        $.ajax({
            url: '/administrator/' + userId, // Updated URL
            method: 'PATCH', // Changed from PUT to PATCH (error 500 fixed)
            data: userData,
            success: function(response) {
                if (response.status === 'success') {
                    $button.text('Edit');
                    location.refresh(); 
                } else {
                    alert('Failed to update user: ' + response.message);
                }
            },
            error: function() {
                alert('An error occurred while updating the user.');
            }
        });
    }
});
 

 $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$(document).ready(function() {
    $('input[name="query"]').on('keyup', function() {
        var query = $(this).val();
        $.get('/search', { query: query }, function(data) {
            $('tbody').empty();
            data.forEach(function(user) {
                var isActive = user.is_active ? 'Active' : 'Inactive';
                var isAdmin = user.is_admin ? 'Admin' : 'Not Admin';
                var activeClass = user.is_active ? 'text-green-500' : 'text-red-500';
                var adminClass = user.is_admin ? 'text-green-500' : 'text-red-500';

                var row = '<tr class="text-gray-700 text-sm hover:bg-gray-100 transition duration-300" data-user-id="' + user.id + '">' +
                          '<td class="py-2 px-6 border-b border-gray-200">' + user.username + '</td>' +
                          '<td class="py-2 px-6 border-b border-gray-200">' + user.name + '</td>' +
                          '<td class="py-2 px-6 border-b border-gray-200">' + user.email + '</td>' +
                          '<td class="py-2 px-6 border-b border-gray-200">' + user.created_at + '</td>' +
                          '<td class="py-2 px-6 border-b border-gray-200 ' + activeClass + '">' + isActive + '</td>' +
                          '<td class="py-2 px-6 border-b border-gray-200 ' + adminClass + '">' + isAdmin + '</td>' +
                          '<td class="py-2 px-6 border-b border-gray-200">' +
                            '<button class="text-red-600 hover:text-red-900 delete-row">X</button>' +
                            '<span class="mx-2">|</span>' +
                            '<button class="text-blue-600 hover:text-blue-900 edit-row">Edit</button>' +
                          '</td>' +
                          '</tr>';
                $('tbody').append(row);
            });
        });
    });
});


</script>







