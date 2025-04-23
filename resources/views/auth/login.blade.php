<!DOCTYPE html>
<html lang="en">
@php
    $logo = \App\Models\SystemVariable::where('type', 'logo')->first();
    $fullName = \App\Models\SystemVariable::where('type', 'name')->first();
    $favicon = \App\Models\SystemVariable::where('type', 'favicon')->first();
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if ($favicon)
        <link rel="icon" href="{{ asset('storage/' . $favicon->value) }}" type="x-icon">
    @else
        <link rel="icon" href="" type="image/x-icon">
    @endif
    @if ($fullName)
        <title>{{ $fullName->value }} | {{ $title }}</title>
    @else
        <title>{{ env('APP_NAME') }}</title>
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="{{ asset('assets/js/sweetalert2@11.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.css') }}">
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="relative bg-blue-800 text-center flex items-center justify-center min-h-[75px]">
                @if ($logo)
                    <img src="{{ asset('storage/' . $logo->value) }}" alt="logo"
                        class="mx-auto max-w-[140px] max-h-[80px] object-contain">
                @else
                    <div>
                        <h1 class="text-2xl font-bold text-white">Welcome Back</h1>
                        <p class="text-white/80 mt-1">Login to your account</p>
                    </div>
                @endif
            </div>

            <form action="{{ route('auth.login') }}" class="p-6 space-y-6" method="POST">
                @csrf
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" id="email" name="email" required
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg" />
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" id="password" name="password" required
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg" />
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                            class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                    </div>
                    <a href="#" class="text-sm text-primary hover:text-primary-dark">Forgot password?</a>
                </div>
                <button type="submit"
                    class="w-full flex justify-center items-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition">
                    <i class="fas fa-sign-in-alt mr-2"></i> Sign In
                </button>
            </form>
        </div>
    </div>
    @if (session()->has('msg'))
        <script type="text/javascript">
            Swal.fire({
                title: "{{ ucfirst(session('flag')) }}",
                text: "{{ session('msg') }}",
                icon: "{{ session('flag') }}"
            });
        </script>
    @endif
</body>

</html>
