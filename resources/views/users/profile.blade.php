@extends('layouts.admin')
@section('content')
    <div class="grid grid-cols-1 mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-6 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('home.index') }}"
                        class="px-3 py-1 border border-gray-300 text-gray-700 rounded hover:bg-gray-50 transition duration-150">
                        <i class="fas fa-arrow-left mr-1"></i> Back
                    </a>
                </div>
            </div>

            <!-- Profile Header -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 mb-8 pb-6 border-b border-gray-200">
                <div class="flex-shrink-0">
                    @if ($user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}" alt="User Photo"
                            class="h-32 w-32 rounded-full object-cover border-4 border-white shadow-md">
                    @else
                        <div
                            class="h-32 w-32 rounded-full bg-gray-200 flex items-center justify-center text-4xl text-gray-500">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <div class="flex-1">
                    <h1 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h1>
                    <p class="text-lg text-gray-600">{{ $user->email }}</p>
                    <div class="mt-2">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                            {{ $user->roles->first()->name ?? 'No Role' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- User Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Personal Information -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4 pb-2 border-b border-gray-200">
                        <i class="fas fa-user-circle mr-2"></i>Personal Information
                    </h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Full Name</p>
                            <p class="text-gray-800">{{ $user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Email Address</p>
                            <p class="text-gray-800">{{ $user->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Account Status</p>
                            <p class="text-gray-800">
                                <span
                                    class="px-2 py-1 text-xs rounded-full 
                                    {{ $user->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $user->status ? 'Active' : 'Inactive' }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Role Information -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4 pb-2 border-b border-gray-200">
                        <i class="fas fa-shield-alt mr-2"></i>Role & Permissions
                    </h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Assigned Role</p>
                            <p class="text-gray-800">{{ $user->roles->first()->name ?? 'No Role Assigned' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Permissions</p>
                            @if ($user->roles->isNotEmpty())
                                <div class="flex flex-wrap gap-2 mt-1">
                                    @foreach ($user->roles->first()->permissions as $permission)
                                        <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded">
                                            {{ $permission->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 text-sm">No permissions assigned</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Account Information -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4 pb-2 border-b border-gray-200">
                        <i class="fas fa-calendar-alt mr-2"></i>Account Information
                    </h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Created At</p>
                            <p class="text-gray-800">{{ $user->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Last Updated</p>
                            <p class="text-gray-800">{{ $user->updated_at->format('M d, Y h:i A') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Activity Log (Optional) -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4 pb-2 border-b border-gray-200">
                        <i class="fas fa-history mr-2"></i>Recent Activity
                    </h3>
                    @if ($user->activities->count() > 0)
                        <!-- Fix: count() is a method -->
                        <div class="space-y-3">
                            @foreach ($user->activities->take(3) as $activity)
                                <div class="text-sm">
                                    <p class="font-medium text-gray-800">
                                        {{ $activity->description }} <!-- Use 'description', not 'name' -->
                                    </p>
                                    <p class="text-gray-500">
                                        {{ $activity->created_at->diffForHumans() }}
                                    </p>
                                    <!-- Optional: Display extra properties -->
                                    @if ($activity->properties->count() > 0)
                                        <div class="text-xs text-gray-400 mt-1">
                                            @foreach ($activity->properties as $key => $value)
                                                {{ $key }}: {{ $value }}<br>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">No recent activity</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
