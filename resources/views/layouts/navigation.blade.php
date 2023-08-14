<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 shadow">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('posts.index') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">

                
                    <x-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.index')">
                        <svg width="20" height="20" fill="currentColor" class="inline-block mr-2" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.70711 2.29289C10.0976 1.90237 10.7308 1.90237 11.1213 2.29289L18.1213 9.29289C18.5118 9.68342 18.5118 10.3166 18.1213 10.7071C17.7308 11.0976 17.0976 11.0976 16.7071 10.7071L11 5.41421L11 17C11 17.5523 10.5523 18 10 18C9.44772 18 9 17.5523 9 17L9 5.41421L3.29289 10.7071C2.90237 11.0976 2.2692 11.0976 1.87868 10.7071C1.48815 10.3166 1.48815 9.68342 1.87868 9.29289L8.87868 2.29289C9.2692 1.90237 9.90237 1.90237 10.2929 2.29289L10.2929 2.29289L9.70711 2.29289Z">
                            </path>
                           </svg>
                        {{ __('Acasa') }}
                    </x-nav-link>
                </div>

                
            </div>

            @if (Auth::check())
                <!-- Add Posts Button and Settings Dropdown for authenticated user -->
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
