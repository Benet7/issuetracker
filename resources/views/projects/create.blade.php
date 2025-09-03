@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Create Project</h1>

<form method="POST" action="{{ route('projects.store') }}" class="space-y-3">
    @csrf
    <input type="text" name="name" placeholder="Project name" class="border p-2 w-full rounded" required>
    <textarea name="description" placeholder="Description" class="border p-2 w-full rounded"></textarea>
    <input type="date" name="start_date" class="border p-2 rounded">
    <input type="date" name="deadline" class="border p-2 rounded">
    <button class="px-4 py-2 bg-black text-white rounded">Save</button>
</form>
@endsection
