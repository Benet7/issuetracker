@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Issue</h1>

<form method="POST" action="{{ route('issues.update',$issue) }}" class="space-y-3">
    @csrf
    @method('PUT')
    <input type="text" name="title" value="{{ old('title',$issue->title) }}" class="border p-2 w-full rounded" required>
    <textarea name="description" class="border p-2 w-full rounded">{{ old('description',$issue->description) }}</textarea>

    <label>Project:</label>
    <select name="project_id" class="border p-2 w-full rounded">
        @foreach($projects as $p)
            <option value="{{ $p->id }}" @selected($p->id==$issue->project_id)>{{ $p->name }}</option>
        @endforeach
    </select>

    <label>Status:</label>
    <select name="status" class="border p-2 w-full rounded">
        @foreach($statuses as $s)
            <option value="{{ $s }}" @selected($s==$issue->status)>{{ ucfirst($s) }}</option>
        @endforeach
    </select>

    <label>Priority:</label>
    <select name="priority" class="border p-2 w-full rounded">
        @foreach($priorities as $p)
            <option value="{{ $p }}" @selected($p==$issue->priority)>{{ ucfirst($p) }}</option>
        @endforeach
    </select>

    <input type="date" name="due_date" value="{{ $issue->due_date }}" class="border p-2 rounded">

    <button class="px-4 py-2 bg-black text-white rounded">Update</button>
</form>
@endsection
