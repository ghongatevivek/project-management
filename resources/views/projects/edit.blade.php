<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto p-6 bg-white rounded shadow-md">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Edit Project</h2>

                <!-- Project Edit Form -->
                <form method="POST" action="{{ route('projects.update', [$project->id]) }}">
                    @method('PUT')
                    @csrf
                    <!-- Project Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Project Name</label>
                        <input type="text" name="name" id="name" required
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            value="{{$project->name}}"
                            placeholder="Enter project name">
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="4"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="Enter project description">{{$project->description}}</textarea>
                    </div>

                    <!-- Employees Selection -->
                    <div class="mb-4">
                        <label for="employees" class="block text-sm font-medium text-gray-700">Assign Employees</label>
                        <div class="mt-2">
                            <!-- Multi-select dropdown (Alternative: replace this with checkboxes if needed) -->
                            <div class="grid grid-cols-3 gap-4 mt-2">
                                @foreach ($employees as $employee)
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="employees[]" value="{{ $employee->id }}" 
                                            class="form-checkbox" 
                                            {{ $project->employees->contains($employee->id) ? 'checked' : '' }}>
                                        <span class="ml-2">{{ $employee->name }}</span>
                                    </label>
                                @endforeach
                        </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Create Project
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
</x-app-layout>