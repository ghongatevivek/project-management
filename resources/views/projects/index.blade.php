<x-app-layout>
    <x-slot name="header">
        
        @can('create', App\Models\Project::class)
        <a href="{{ route('projects.create') }}" class="float-right bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
            Create Project
        </a>
        @endcan
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 bg-white shadow-md rounded-lg">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Project Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Manager
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($projects as $project)
                                <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                        {{$project->name}}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{$project?->manager?->name??'-'}}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{App\Models\Project::PROJECT_STATUS[$project->status]}}
                                    </td>
                                    <td class="px-6 py-4 text-right whitespace-nowrap">
                                        @can('update', $project)
                                        <a href="{{ route('projects.edit', $project) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        @endcan
                                        @can('delete', $project)
                                        <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 hover:text-red-900" type="submit">Delete</button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>