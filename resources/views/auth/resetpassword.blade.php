<!DOCTYPE html>
<html lang="en">
@php
    $logo = \App\Models\SystemVariable::where('type', 'logo')->first();
    $fullName = \App\Models\SystemVariable::where('type', 'name')->first();
    $favicon = \App\Models\SystemVariable::where('type', 'favicon')->first();
    $shortName = \App\Models\SystemVariable::where('type', 'shortname')->first();
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

</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="relative text-center flex items-center justify-center min-h-[75px] mb-5">
            @if ($logo)
                <img src="{{ asset('storage/' . $logo->value) }}" alt="logo"
                    class="mx-auto max-w-[220px] max-h-[100px] object-contain">
            @endif
        </div>
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="relative bg-blue-800 text-center flex items-center justify-center min-h-[75px]">
                @if ($shortName)
                    <div>
                        <h1 class="text-2xl font-bold text-white">{{ $shortName->value }}</h1>
                    </div>
                @else
                    <div>
                        <h1 class="text-2xl font-bold text-white">Welcome Back</h1>
                        <p class="text-white/80 mt-1">Login to your account</p>
                    </div>
                @endif
            </div>

            <form class="p-6 space-y-6" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" id="email" name="email"
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg" />
                        @error('email')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <button type="submit"
                    class="w-full flex justify-center items-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition">
                    <i class="fas fa-sign-in-alt mr-2"></i> Send Email
                </button>
                <a href="{{ route('login') }}" class="text-center">Back to Login</a>
            </form>
        </div>
    </div>
</body>

</html>
