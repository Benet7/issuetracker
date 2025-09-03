@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Create Issue</h1>

<form method="POST" action="{{ route('issues.store') }}" class="space-y-3">
    @csrf
    <input type="text" name="title" placeholder="Title" class="border p-2 w-full rounded" required>
    <textarea name="description" placeholder="Description" class="border p-2 w-full rounded"></textarea>

    <label>Project:</label>
    <select name="project_id" class="border p-2 w-full rounded">
        @foreach($projects as $p)
            <option value="{{ $p->id }}">{{ $p->name }}</option>
        @endforeach
    </select>

    <label>Status:</label>
    <select name="status" class="border p-2 w-full rounded">
        @foreach($statuses as $s)
            <option value="{{ $s }}">{{ ucfirst($s) }}</option>
        @endforeach
    </select>

    <label>Priority:</label>
    <select name="priority" class="border p-2 w-full rounded">
        @foreach($priorities as $p)
            <option value="{{ $p }}">{{ ucfirst($p) }}</option>
        @endforeach
    </select>

    <input type="date" name="due_date" class="border p-2 rounded">

    <button class="px-4 py-2 bg-black text-white rounded">Save</button>
</form>
@endsection
