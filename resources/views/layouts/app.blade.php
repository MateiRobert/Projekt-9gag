<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', '9gag - Clone') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>


    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')
                    @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow mb-4">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            
            

            <!-- Page Content -->
            <main>
                @yield('content')

            </main>
        </div>

        


        
        <script>
            function openReportModal(postId) {
            // Set the value of the hidden input to the postId
            document.getElementById('reportPostId').value = postId;

            // Update the form action to include the postId
            document.querySelector('#reportModal form').action = '/report/' + postId;

            // Show the modal
            document.getElementById('reportModal').style.display = 'flex';

            }

            function closeReportModal() {
                document.getElementById('reportModal').style.display = 'none';
                    document.querySelector('#reportModal form').action = '/report/' + postId;

            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == document.getElementById('reportModal')) {
                    closeReportModal();
                }
            }


            
        </script>

        
        
    </body>
</html>
