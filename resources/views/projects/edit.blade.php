@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Project</h1>

<form method="POST" action="{{ route('projects.update', $project) }}" class="space-y-3">
    @csrf
    @method('PUT')
    <input type="text" name="name" value="{{ old('name',$project->name) }}" class="border p-2 w-full rounded" required>
    <textarea name="description" class="border p-2 w-full rounded">{{ old('description',$project->description) }}</textarea>
    <input type="date" name="start_date" value="{{ $project->start_date }}" class="border p-2 rounded">
    <input type="date" name="deadline" value="{{ $project->deadline }}" class="border p-2 rounded">
    <button class="px-4 py-2 bg-black text-white rounded">Update</button>
</form>
@endsection
