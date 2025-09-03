@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Projects</h1>

    <div class="mb-4">
        <a href="{{ route('projects.create') }}" 
           class="px-4 py-2 bg-black text-white rounded">
            + New Project
        </a>
    </div>

    <div class="grid gap-3">
        @foreach ($projects as $project)
            <div class="bg-white p-4 rounded border shadow">
                <h2 class="font-semibold text-lg">{{ $project->name }}</h2>
                <p class="text-sm text-gray-700">{{ $project->description }}</p>
                <p class="text-xs text-gray-500">
                    Start: {{ $project->start_date }} | Deadline: {{ $project->deadline }}
                </p>

                <div class="mt-3 flex gap-4">
                    <a href="{{ route('projects.show', $project) }}" 
                       class="text-blue-600 hover:underline">View</a>

                    <a href="{{ route('projects.edit', $project) }}" 
                       class="text-green-600 hover:underline">Edit</a>

                    <form method="POST" action="{{ route('projects.destroy', $project) }}" 
                          onsubmit="return confirm('Are you sure?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $projects->links() }}
    </div>
@endsection
