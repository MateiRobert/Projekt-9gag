<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 shadow sticky top-0 z-50 border-b border-gray-200 dark:border-gray-900 dark:text-white dark:bg-gray-800">
    <!-- Primary Navigation Menu -->
    <div class=" mx-auto px-4 sm:px-6 lg:px-8">
        <div class=" flex justify-between h-16">
            <div class="flex">

            
                

                <!-- Search Bar -->
                <form action="{{ route('posts.index') }}" method="GET" class="sm:ml-10 flex items-center bg-dark rounded-full p-2 shadow">
                    <input type="text" name="search" class="py-1 border border-gray-300 shadow-sm rounded-full p-2 bg-transparent focus:outline-none w-64" placeholder="Caută..." value="{{ request()->get('search') }}">
                    <button type="submit" class="ml-2 rounded-full p-1.5 bg-blue-500 hover:bg-blue-600 text-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 11-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </form>

                
               
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.index')">
                        <svg width="20" height="20" fill="currentColor" class="inline-block mr-2" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 9.185l7 6.514v6.301h-3v-5h-8v5h-3v-6.301l7-6.514zm0-2.732l-9 8.375v9.172h7v-5h4v5h7v-9.172l-9-8.375zm12 5.695l-12-11.148-12 11.133 1.361 1.465 10.639-9.868 10.639 9.883 1.361-1.465z"/></svg>
                           </svg>
                        {{ __('Acasa') }}
                    </x-nav-link>


                    <x-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.index')">
                        <svg width="20" height="20" fill="currentColor" class="inline-block mr-2" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M1.926 7l-.556-2.999h21.256l-.556 2.999h-20.144zm1.514-5l-.439-2h17.994l-.439 2h-17.116zm-3.44 7.001l2.035 14.999h19.868l2.097-14.999h-24zm3.782 13l-1.22-9.001h18.86l-1.259 9.001h-16.381zm8.317-1.284l.004.283h-5.939l-.048-.292c-.133-.779-.177-1.224.582-1.43.842-.227 1.684-.429 1.168-1.289-1.627-2.546-.848-3.989.634-3.989 1.454 0 2.516 1.39 1.355 3.99-.348.854.5 1.056 1.401 1.289.801.207.834.654.843 1.438zm6.628-4.717h-4.784l-.028 1h4.675l.137-1zm.273-2h-5l-.028 1h4.892l.136-1zm-.548 4h-4.566l-.029 1h4.459l.136-1zm-.273 2h-4.351l-.028 1h4.241l.138-1z"/></svg> 
                        </svg>                     
                        {{ __('Profile') }}
                    </x-nav-link>

                    
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="focus:outline-none">
                                    <svg width="20" height="20" fill="currentColor" class="inline-block mr-2" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="..."></path></svg>
                                    </svg>
                                    {{ __('Categorii') }}
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                @foreach($categories as $category)
                                    <x-dropdown-link :href="route('posts.index', ['category' => $category->id])" class="{{ request('category') == $category->id ? 'bg-blue-100 text-blue-600' : '' }}">
                                        {{ $category->name }} 


                                    </x-dropdown-link>
                                @endforeach
                            </x-slot>
                        </x-dropdown>
                    </div>

                </div>


                
                
            </div>

            @if (Auth::check())
                <div class="sm:flex sm:items-center sm:ml-6">
                    <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-800 focus:outline-none focus:border-blue-900 focus:shadow-outline-blue transition ease-in-out duration-150 mr-4">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                           <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier"> 
                                <path d="M15 12L12 12M12 12L9 12M12 12L12 9M12 12L12 15" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> 
                                <path d="M7 3.33782C8.47087 2.48697 10.1786 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 10.1786 2.48697 8.47087 3.33782 7" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> 
                            </g>
                        </svg>
                        Add Posts
                    </a>
                </div>


                <!-- Settings Dropdown for authenticated user -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <!-- Profile Photo -->
                                @if (!empty(Auth::user()->avatar_path))
                                    <img src="{{ asset('storage/' . Auth::user()->avatar_path) }}" class="rounded-full h-8 w-8 mr-2" alt="{{ Auth::user()->name }}">
                                @else
                                    <div class="rounded-full h-8 w-8 bg-gray-300 mr-2"></div>
                                @endif
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Setari Cont') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @else
                <!-- Login/Register Links for guests -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-700">Login</a>
                    <span class="mx-2">|</span>
                    <a href="{{ route('register') }}" class="text-gray-500 hover:text-gray-700">Register</a>
                </div>
            @endif

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.index')">
                {{ __('Home') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @if (Auth::check())
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Setari Cont') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="px-4 mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Login') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                </div>
            @endif
        </div>
    </div>
</nav>