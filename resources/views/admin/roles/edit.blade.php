<x-admin-layout>
    <div class="container px-6 mx-auto grid">
        <div class="flex justify-between items-center">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Update Role
            </h2>
            {{-- <a href="{{ route('admin.roles.create') }}"
                class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-fuchsia-700 border border-transparent rounded-lg active:bg-fuchsia-600 hover:bg-fuchsia-800 focus:outline-none focus:shadow-outline-purple">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4 mr-2 -ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Add New</span>
            </a> --}}
        </div>


        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form action="{{ route('admin.roles.update', $role) }}" method="POST">
                @csrf
                @method('PUT')
                <label class="block text-sm mb-3">
                    <span class="text-gray-700 dark:text-gray-400">Name</span>
                    <input name="name"
                        class="block w-full rounded mt-1 text-sm form-input {{ $errors->has('name') ? 'border-red-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red' : 'dark:border-gray-600 dark:bg-gray-700 focus:border-fuchsia-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray' }} "
                        value="{{ $role->name }}">
                    @error('name')
                        <span class="text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </span>
                    @enderror
                </label>
                <button
                    class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Update
                </button>
            </form>
        </div>

        <h2 class=" text-xl font-semibold text-gray-700 dark:text-gray-200">
            Role Permissions
        </h2>
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            @if (session('success'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded mb-3 text-teal-900 px-4 py-3 shadow-md"
                    role="alert">
                    <div class="flex">
                        <div class="py-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-teal-500 mr-4" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold">Great!</p>
                            <p class="text-sm">
                                @if (session('success'))
                                    {{ session('success') }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border-t-4 border-red-500 rounded mb-3 text-red-900 px-4 py-3 shadow-md"
                    role="alert">
                    <div class="flex">
                        <div class="py-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-500 mr-4" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                            </svg>

                        </div>
                        <div>
                            <p class="font-bold">Error!</p>
                            <p class="text-sm">
                                @if (session('error'))
                                    {{ session('error') }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endif
            @if ($role->permissions)
                <div>
                    @foreach ($role->permissions as $permission)
                        <div class="flex items-center">
                            <p class="text-gray-700 dark:text-gray-400">
                                {{ $permission->name }}
                            </p>
                            <button>
                                <form
                                    action="{{ route('admin.roles.permissions.detach', [$role->id, $permission->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Delete">
                                        <svg class="w-5 h-5 text-red-700" aria-hidden="true" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </form>
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('admin.roles.permissions', $role->id) }}" method="POST">
                @csrf
                <label class="block text-sm mb-3">
                    <span class="text-gray-700 dark:text-gray-400">Permissions</span>
                    <select name="permission"
                        class="block w-full rounded mt-1 text-sm form-input {{ $errors->has('permissions') ? 'border-red-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red' : 'dark:border-gray-600 dark:bg-gray-700 focus:border-fuchsia-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray' }} ">
                        @foreach ($permissions as $permission)
                            <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                        @endforeach
                    </select>
                    @error('permissions')
                        <span class="text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </span>
                    @enderror
                </label>
                <button
                    class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Assing
                </button>
            </form>
        </div>
    </div>
</x-admin-layout>
