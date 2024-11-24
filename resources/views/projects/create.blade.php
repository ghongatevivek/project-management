    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create Project') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                        <div class="max-w-4xl mx-auto p-6 bg-white rounded shadow-md">
                            <h2 class="text-xl font-semibold text-gray-800 mb-6">Add Project</h2>

                            <!-- Project Creation Form -->
                            <form action="{{ route('projects.store') }}" method="POST">
                                @csrf

                                <!-- Project Name -->
                                <div class="mb-4">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Project Name</label>
                                    <input type="text" name="name" id="name" required
                                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                        placeholder="Enter project name">
                                </div>

                                <!-- Description -->
                                <div class="mb-4">
                                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                    <textarea name="description" id="description" rows="4"
                                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                        placeholder="Enter project description"></textarea>
                                </div>

                                <!-- Employees Selection -->
                                <div class="mb-4">
                                    <label for="employees" class="block text-sm font-medium text-gray-700">Assign Employees</label>
                                    <div class="mt-2">
                                        <!-- Multi-select dropdown (Alternative: replace this with checkboxes if needed) -->
                                        <select name="employees[]" id="employees" multiple
                                            class="block w-full mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            @foreach($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                            @endforeach
                                        </select>
                                        <p class="mt-2 text-sm text-gray-500">Hold Ctrl or Cmd to select multiple employees.</p>
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