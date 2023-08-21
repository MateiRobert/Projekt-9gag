

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrator</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<div class="flex h-screen">
    <!-- Sidebar -->
    <div class="w-1/4 bg-white p-6 shadow-lg">
        <div class="flex flex-col items-center mb-6">
            @if (!empty(Auth::user()->avatar_path))
                                    <img src="{{ asset('storage/' . Auth::user()->avatar_path) }}" class="w-24 h-24 bg-gray-300 rounded-full mb-4" alt="{{ Auth::user()->name }}">
                                @else
                                    <div class="w-24 h-24 bg-gray-300 rounded-full mb-4"></div>
                                @endif<!-- Placeholder Avatar -->
            <div class="text-xl font-semibold mb-1">{{ Auth::user()->name }}</div> <!-- Nume utilizator -->

            <div class="flex space-x-4 mt-6"> 
                <a href="{{ route('posts.index') }}">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21 13v10h-6v-6h-6v6h-6v-10h-3l12-12 12 12h-3zm-1-5.907v-5.093h-3v2.093l3 3z"/></svg>
                    </div> 
                </a>
            </div>  
           
        </div>

    
        <hr class="mb-4">

        <!-- Meniu cu sub-butoane -->
        <div>
            <button class="w-full p-2 text-left focus:outline-none focus:bg-gray-200 hover:bg-gray-100 transition duration-300" onclick="toggleDropdown('dropdown1')">Utilizatori</button>
            <div id="dropdown1" class="transform transition-all max-h-0 overflow-hidden duration-300 space-y-2 pl-4">
                <button class="w-full p-2 text-left focus:outline-none focus:bg-gray-200 hover:bg-gray-100 transition duration-300" onclick="showContent('sectiune1-1')">Prezentare generală</button>
                <button class="w-full p-2 text-left focus:outline-none focus:bg-gray-200 hover:bg-gray-100 transition duration-300" onclick="showContent('sectiune1-2')">Editare Utilizator</button>
            </div>

            <button class="w-full p-2 text-left focus:outline-none focus:bg-gray-200 hover:bg-gray-100 transition duration-300 mt-4" onclick="toggleDropdown('dropdown2')">Postari</button>
            <div id="dropdown2" class="transform transition-all max-h-0 overflow-hidden duration-300 space-y-2 pl-4">
                <button class="w-full p-2 text-left focus:outline-none focus:bg-gray-200 hover:bg-gray-100 transition duration-300" onclick="showContent('sectiune2-1')">Prezentare generală</button>
                <button class="w-full p-2 text-left focus:outline-none focus:bg-gray-200 hover:bg-gray-100 transition duration-300" onclick="showContent('sectiune2-2')">2.2</button>
            </div>
        </div>
    </div>
    
    <div id="sectiune1-1" class="content-section transform transition-all opacity-0 -translate-y-4 h-screen">
        <!-- Conținut pentru Secțiunea 1.1 -->
        Utilizatori
        

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
            <table class="w-full bg-white shadow-md rounded-md overflow-hidden">
                <thead>
                    <tr class="text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-2 px-6 text-left bg-gray-200">@username</th>
                        <th class="py-2 px-6 text-left bg-gray-200">@name</th>
                        <th class="py-2 px-6 text-left bg-gray-200">@email</th>
                        <th class="py-2 px-6 text-left bg-gray-200">@created_at</th>
                        <th class="py-2 px-6 text-left bg-gray-200">@is_active</th>
                        <th class="py-2 px-6 text-left bg-gray-200">@is_admin</th>
                        <th class="py-2 px-6 text-left bg-gray-200">@link_edit_profile</th>
                    </tr>
                </thead>
               <tbody>
                    @foreach ($users as $user)
                        <tr class="text-gray-700 text-sm hover:bg-gray-100 transition duration-300">
                            <td class="py-2 px-6 border-b border-gray-200">{{ $user->username }}</td>
                            <td class="py-2 px-6 border-b border-gray-200">{{ $user->name }}</td>
                            <td class="py-2 px-6 border-b border-gray-200">{{ $user->email }}</td>
                            <td class="py-2 px-6 border-b border-gray-200">{{ $user->created_at }}</td>
                            <td class="py-2 px-6 border-b border-gray-200 {{ $user->is_active ? 'text-green-500' : 'text-red-500' }}">
                                {{ $user->is_active ? 'Activ' : 'Inactiv' }}
                            </td>
                            <td class="py-2 px-6 border-b border-gray-200 {{ $user->is_admin ? 'text-green-500' : 'text-red-500' }}">
                                {{ $user->is_admin ? 'Este Admin' : 'Nu  este Admin' }}
                            </td>
                            <td class="py-2 px-6 border-b border-gray-200">
                                <!-- Aici adăugați un link către pagina de editare a profilului utilizatorului -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>


            </table>
        </div>
    </div>
        
    <div id="sectiune1-2" class="content-section hidden transform transition-all opacity-0 -translate-y-4">
        <!-- Conținut pentru Secțiunea 1.2 -->
    <div class="container mx-auto px-4 w-full my-4">

        <!-- Cardul principal -->
        <div class="bg-white p-8 shadow-xl rounded-md space-y-8">
            
            <!-- Formular de căutare -->
            <div class="border-b pb-6">
                <form action="#" method="POST" class="flex items-center space-x-2">
                    @csrf
                    <input type="text" name="query" placeholder="Caută după username sau nume..." value="john_doe" class="p-2 border border-gray-300 rounded-md flex-grow focus:border-blue-400 focus:ring focus:ring-blue-200 transition">
                    <button type="submit" class="p-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">Caută</button>
                </form>
            </div>

            <!-- Grid pentru Informațiile utilizatorului și Editare informații -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Informațiile utilizatorului -->
                <div class="space-y-4 md:border md:p-4">
                    <h2 class="text-2xl font-bold">Profilul utilizatorului</h2>
                    <div>Nume: <span class="font-medium text-gray-700">John Doe</span></div>
                    <div>Email: <span class="font-medium text-gray-700">john.doe@example.com</span></div>
                    <div>Username: <span class="font-medium text-gray-700">john_doe</span></div>
                    <div>Avatar: <img src="path/to/dummy/avatar.jpg" alt="Avatar" class="w-24 h-24 rounded-full"></div>
                    <div>Este activ? <span class="font-medium text-gray-700">Da</span></div>
                    <div>Este administrator? <span class="font-medium text-gray-700">Nu</span></div>
                </div>

                <!-- Editare informații -->
                <div class="space-y-4 md:border md:p-4">
                    <h2 class="text-2xl font-bold">Editare informații</h2>

                    <form action="#" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <label for="username" class="block mb-2 text-gray-600">Username:</label>
                            <input type="text" name="username" value="john_doe" id="username" class="p-2 w-full border border-gray-300 rounded-md focus:border-blue-400 focus:ring focus:ring-blue-200 transition">
                        </div>
                        
                        <div>
                            <label for="name" class="block mb-2 text-gray-600">Nume:</label>
                            <input type="text" name="name" value="John Doe" id="name" class="p-2 w-full border border-gray-300 rounded-md focus:border-blue-400 focus:ring focus:ring-blue-200 transition">
                        </div>

                        <div>
                            <label for="email" class="block mb-2 text-gray-600">Email:</label>
                            <input type="text" name="email" value="john.doe@example.com" id="email" class="p-2 w-full border border-gray-300 rounded-md focus:border-blue-400 focus:ring focus:ring-blue-200 transition">
                        </div>

                        <div>
                            <span class="text-gray-600 block mb-2">Este activ?</span>
                            <div class="space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio text-green-500" name="is_active" value="1" checked>
                                    <span class="ml-2">Da</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio text-red-500" name="is_active" value="0">
                                    <span class="ml-2">Nu</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <span class="text-gray-600 block mb-2">Este administrator?</span>
                            <div class="space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio text-green-500" name="is_admin" value="1">
                                    <span class="ml-2">Da</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio text-red-500" name="is_admin" value="0" checked>
                                    <span class="ml-2">Nu</span>
                                </label>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="p-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition">Actualizează</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>






      

    <div id="sectiune2-1" class="content-section hidden transform transition-all opacity-0 -translate-y-4">
        <!-- Conținut pentru Secțiunea 2.1 -->

      Postari
        <hr class = "mb-4">
        <!-- Grafice -->
    <div class="flex justify-between">
    <div class="chart-container w-2/5">
        <canvas id="grafic1"></canvas>
    </div>

    <div class="border-l-2 h-64 my-4 mx-4"></div>  <!-- Linia de despărțire -->

    <div class="chart-container w-2/5">
        <canvas id="grafic2"></canvas>
    </div>
    </div>

    <div id="sectiune2-2" class="content-section hidden transform transition-all opacity-0 -translate-y-4">
        <!-- Conținut pentru Secțiunea 2.2 -->2.2
    </div>

    <!-- ... și așa mai departe pentru celelalte div-uri -->

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

    </script>

