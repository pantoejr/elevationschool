<form wire:submit.prevent="submit" class="max-w-3xl mx-auto">
    @csrf
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Form Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4">
            <h2 class="text-1xl font-bold text-white">
                <i class="fas fa-key mr-2"></i> Assign Permissions for {{ $role->name }}
            </h2>
        </div>

        <!-- Form Content -->
        <div class="p-6">
            @if (empty($availablePermissions))
                <div class="text-center py-8">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                        <i class="fas fa-check text-green-600"></i>
                    </div>
                    <h3 class="mt-3 text-lg font-medium text-gray-900">All Permissions Assigned</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        This role already has all available permissions.
                    </p>
                </div>
            @else
                <!-- Permissions Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($availablePermissions as $permissionId => $permissionName)
                        <div class="relative flex items-start">
                            <div class="flex items-center h-5">
                                <input wire:model="selectedPermissions" type="checkbox" value="{{ $permissionName }}"
                                    class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded"
                                    id="perm_{{ $permissionId }}">
                            </div>
                            <div class="ml-3">
                                <label for="perm_{{ $permissionId }}"
                                    class="block text-sm font-medium text-gray-700 group-hover:text-gray-900">
                                    {{ ucwords(str_replace('_', ' ', $permissionName)) }}
                                </label>
                                <p class="text-xs text-gray-500">
                                    <i class="fas fa-shield-alt mr-1"></i> {{ $permissionName }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Submit Button -->
                <div class="mt-8 pt-5">
                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                            <i class="fas fa-save mr-2"></i> Assign Selected Permissions
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</form>
