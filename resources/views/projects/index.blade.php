<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Projects') }}
        </h2>
        @can('create', App\Models\Project::class)
            <a class="underline float-right text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('projects.create') }}">
                {{ __('Create Project') }}
            </a>
        @endcan
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="w-full whitespace-no-wrapw-full whitespace-no-wrap">
                        <thead>
                            <tr class="text-center font-bold">
                                <td class="border px-6 py-4">Name</td>
                                <td class="border px-6 py-4">Description</td>
                                <td class="border px-6 py-4">Action</td>
                            </tr>
                        </thead>
                        @foreach($projects as $project)
                            <tr class="text-center font-bold">
                                <td class="border px-6 py-4">{{$project->name}}</td>
                                <td class="border px-6 py-4">{{$project->description}}</td>
                                <td class="border px-6 py-4">
                                    @can('update', $project)
                                        <a href="{{ route('projects.edit', $project) }}">Edit</a>
                                    @endcan
                                    @can('delete', $project)
                                        <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Delete</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </table>
                
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
