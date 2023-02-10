<x-admin-layout>
    <div class="container px-6 mx-auto grid">
        <div class="flex justify-between items-center">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Create New Roles
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
            <form action="{{ route('admin.roles.store') }}" method="POST">
                @csrf
                <label class="block text-sm mb-3">
                    <span class="text-gray-700 dark:text-gray-400">Name</span>
                    <input name="name"
                        class="block w-full rounded mt-1 text-sm form-input {{ $errors->has('name') ? 'border-red-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red' : 'dark:border-gray-600 dark:bg-gray-700 focus:border-fuchsia-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray' }} "
                        value="{{ old('name') }}">
                    @error('name')
                        <span class="text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </span>
                    @enderror
                </label>
                <button
                    class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Create
                </button>
            </form>
        </div>


    </div>
</x-admin-layout>
