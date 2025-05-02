<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
    $favicon = \App\Models\SystemVariable::where('type', 'favicon')->first();
    $fullName = \App\Models\SystemVariable::where('type', 'name')->first();
@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if ($fullName)
        <title>{{ $fullName->value }} | {{ env('APP_NAME') }}</title>
    @else
        <title>{{ env('APP_NAME') }}</title>
    @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @if ($favicon)
        <link rel="icon" href="{{ asset('storage/' . $favicon->value) }}" type="x-icon">
    @else
        <link rel="icon" href="" type="image/x-icon">
    @endif

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2@11.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.css') }}">
    @livewireStyles
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex h-screen overflow-hidden">
        <!-- Mobile sidebar backdrop (hidden by default) -->
        <div id="sidebarBackdrop" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-20 md:hidden hidden"></div>

        <!-- Sidebar -->
        <div id="sidebar"
            class="fixed inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 z-30 transition duration-200 ease-in-out md:flex md:flex-shrink-0">
            <div class="flex flex-col w-60 h-full bg-blue-800"> <!-- Added h-full here -->
                <div class="flex items-center justify-between h-16 flex-shrink-0 px-6 bg-blue-900">
                    <h1 class="text-white text-xl font-semibold">Laravel</h1>
                    <button id="closeSidebar" class="md:hidden text-white">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="flex-1 flex flex-col overflow-y-auto h-[calc(100%-4rem)]"> <!-- Added height calculation -->
                    <nav class="flex-1 px-4 py-4 space-y-1">
                        @can('view-dashboard')
                            <a href="{{ route('home.index') }}"
                                class="text-white group flex items-center px-2 py-2 text-lg font-medium rounded-md">
                                <i class="fas fa-home mr-3 text-white"></i>
                                Dashboard
                            </a>
                        @endcan
                        @can('view-students')
                            <a href="{{ route('students.index') }}"
                                class="text-white hover:bg-blue-600 hover:bg-opacity-75 group flex items-center px-2 py-2 text-lg font-medium rounded-md">
                                <i class="fas fa-users mr-3 text-white"></i>
                                Students
                            </a>
                        @endcan
                        @can('view-faculties')
                            <a href="{{ route('faculties.index') }}"
                                class="text-white hover:bg-blue-600 hover:bg-opacity-75 group flex items-center px-2 py-2 text-lg font-medium rounded-md">
                                <i class="fas fa-users mr-3 text-white"></i>
                                Faculties
                            </a>
                        @endcan
                        @can('view-courses')
                            <a href="{{ route('courses.index') }}"
                                class="text-white hover:bg-blue-600 hover:bg-opacity-75 group flex items-center px-2 py-2 text-lg font-medium rounded-md">
                                <i class="fas fa-book mr-3 text-white"></i>
                                Courses
                            </a>
                        @endcan
                        @can('view-sections')
                            <a href="{{ route('sections.index') }}"
                                class="text-white hover:bg-blue-600 hover:bg-opacity-75 group flex items-center px-2 py-2 text-lg font-medium rounded-md">
                                <i class="fas fa-clock mr-3 text-white"></i>
                                Sections
                            </a>
                        @endcan
                        @can('view-users')
                            <a href="{{ route('users.index') }}"
                                class="text-white hover:bg-blue-600 hover:bg-opacity-75 group flex items-center px-2 py-2 text-lg font-medium rounded-md">
                                <i class="fas fa-user mr-3 text-white"></i>
                                Users
                            </a>
                        @endcan
                        @can('view-attendances')
                            <a href="{{ route('attendances.index') }}"
                                class="text-white hover:bg-blue-600 hover:bg-opacity-75 group flex items-center px-2 py-2 text-lg font-medium rounded-md">
                                <i class="fas fa-calendar-check mr-3 text-white"></i>
                                Attendances
                            </a>
                        @endcan
                        @can('view-settings')
                            <div class="relative group">
                                <button
                                    class="text-white hover:bg-blue-600 hover:bg-opacity-75 group flex items-center justify-between w-full px-2 py-2 text-lg font-medium rounded-md">
                                    <div class="flex items-center">
                                        <i class="fas fa-cog mr-3 text-white"></i>
                                        <span>Settings</span>
                                    </div>
                                    <i
                                        class="fas fa-chevron-down text-white text-xs group-hover:rotate-180 transition-transform duration-200"></i>
                                </button>

                                <div class="ml-6 mt-1 space-y-1 hidden group-hover:block">
                                    @can('view-roles')
                                        <a href="{{ route('roles.index') }}"
                                            class="text-white hover:bg-blue-600 hover:bg-opacity-75 group flex items-center px-2 py-2 text-lg font-medium rounded-md">
                                            <i class="fas fa-ruler mr-3 text-white"></i>
                                            Roles
                                        </a>
                                    @endcan
                                    @can('view-permissions')
                                        <a href="{{ route('permissions.index') }}"
                                            class="text-white hover:bg-blue-600 hover:bg-opacity-75 group flex items-center px-2 py-2 text-lg font-medium rounded-md">
                                            <i class="fas fa-cog mr-3 text-white"></i>
                                            Permissions
                                        </a>
                                    @endcan
                                    @can('view-variables')
                                        <a href="{{ route('variables.index') }}"
                                            class="text-white hover:bg-blue-600 hover:bg-opacity-75 group flex items-center px-2 py-2 text-lg font-medium rounded-md">
                                            <i class="fas fa-cog mr-3 text-white"></i>
                                            Variables
                                        </a>
                                    @endcan

                                </div>
                            </div>
                        @endcan
                    </nav>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="flex-1 overflow-auto">
            <!-- Top header -->
            <div class="bg-white shadow-sm">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16 items-center">
                        <!-- Left side - App name and mobile menu button -->
                        <div class="flex items-center">
                            <button id="openSidebar"
                                class="md:hidden mr-4 p-1 rounded-md text-gray-500 hover:text-gray-600 focus:outline-none">
                                <i class="fas fa-bars"></i>
                            </button>
                            @if ($fullName)
                                <h1 class="text-md font-semibold text-gray-800">{{ $fullName->value }}</h1>
                            @else
                                <h1 class="text-md font-semibold text-gray-800">{{ env('APP_NAME') }}</h1>
                            @endif

                        </div>

                        <!-- Right side - Profile dropdown -->
                        <div class="flex items-center">
                            <div class="relative">
                                <div>
                                    <button id="userMenuButton"
                                        class="max-w-xs flex items-center text-base rounded-full focus:outline-none">
                                        <img class="h-8 w-8 rounded-full"
                                            src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profile">
                                        <span
                                            class="ml-2 hidden md:block text-gray-700">{{ Auth::user()->name }}</span>
                                        <i class="fas fa-chevron-down ml-1 text-gray-400 hidden md:block"></i>
                                    </button>
                                </div>

                                <!-- Profile dropdown menu (hidden by default) -->
                                <div id="userMenu"
                                    class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white z-50 focus:outline-none">
                                    <a href="{{ route('users.profile') }}"
                                        class="block px-4 py-2 text-base text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-user mr-2"></i> My Profile
                                    </a>
                                    <a href="{{ route('auth.logout') }}"
                                        class="block px-4 py-2 text-base text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Sign out
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main dashboard content -->
            <div class="p-6">
                @if (session()->has('success'))
                    <script type="text/javascript">
                        Swal.fire({
                            title: "{{ ucfirst(session('flag')) }}",
                            text: "{{ session('success') }}",
                            icon: "{{ session('flag') }}"
                        });
                    </script>
                @endif
                @yield('content')
            </div>
        </div>
    </div>

    <script type="text/javascript">
        // Toggle sidebar on mobile
        const sidebar = document.getElementById('sidebar');
        const sidebarBackdrop = document.getElementById('sidebarBackdrop');
        const openSidebarBtn = document.getElementById('openSidebar');
        const closeSidebarBtn = document.getElementById('closeSidebar');

        openSidebarBtn.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
            sidebarBackdrop.classList.remove('hidden');
        });

        closeSidebarBtn.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            sidebarBackdrop.classList.add('hidden');
        });

        sidebarBackdrop.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            sidebarBackdrop.classList.add('hidden');
        });

        // Toggle profile dropdown
        const userMenuButton = document.getElementById('userMenuButton');
        const userMenu = document.getElementById('userMenu');

        userMenuButton.addEventListener('click', () => {
            const expanded = userMenuButton.getAttribute('aria-expanded') === 'true';
            userMenuButton.setAttribute('aria-expanded', !expanded);
            userMenu.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (event) => {
            if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
                userMenu.classList.add('hidden');
                userMenuButton.setAttribute('aria-expanded', 'false');
            }
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.delete-btn').on('click', function(event) {
                event.preventDefault();
                var form = $(this).closest('form');

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    @livewireScripts
</body>

</html>
