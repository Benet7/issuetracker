@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Issues</h1>

<div class="mb-4">
    <a href="{{ route('issues.create') }}"
       class="px-4 py-2 bg-black text-white rounded">+ New Issue</a>
</div>

<form method="GET" class="mb-4 grid grid-cols-1 sm:grid-cols-4 gap-3">
  <select name="status" class="border p-2 rounded">
    <option value="">Status</option>
    @foreach(['open','in_progress','closed'] as $s)
      <option value="{{ $s }}" @selected(request('status')===$s)>{{ ucfirst(str_replace('_',' ',$s)) }}</option>
    @endforeach
  </select>
  <select name="priority" class="border p-2 rounded">
    <option value="">Priority</option>
    @foreach(['low','medium','high'] as $p)
      <option value="{{ $p }}" @selected(request('priority')===$p)>{{ ucfirst($p) }}</option>
    @endforeach
  </select>
  <select name="tag_id" class="border p-2 rounded">
    <option value="">Tag</option>
    @foreach($tags as $t)
      <option value="{{ $t->id }}" @selected(request('tag_id')==$t->id)>{{ $t->name }}</option>
    @endforeach
  </select>
  <button class="bg-black text-white rounded px-4">Filter</button>
</form>

<div class="grid gap-3">
  @foreach($issues as $issue)
    <div class="bg-white p-4 rounded border">
      <div class="font-semibold">{{ $issue->title }}</div>
      <div class="text-sm text-gray-600">{{ $issue->project->name }}</div>
      <div class="flex gap-2 mt-2">
        <span class="px-2 py-1 text-xs border rounded">{{ $issue->status }}</span>
        <span class="px-2 py-1 text-xs border rounded">{{ $issue->priority }}</span>
        @foreach($issue->tags as $tag)
          <span class="px-2 py-1 text-xs rounded border" style="background: {{ $tag->color ?? '#fff' }}">{{ $tag->name }}</span>
        @endforeach
      </div>

      <div class="mt-3 flex gap-4">
        <a href="{{ route('issues.show',$issue) }}" class="text-blue-600 hover:underline">View</a>
        <a href="{{ route('issues.edit',$issue) }}" class="text-green-600 hover:underline">Edit</a>
        <form method="POST" action="{{ route('issues.destroy',$issue) }}" class="inline"
              onsubmit="return confirm('Are you sure?')">
          @csrf
          @method('DELETE')
          <button type="submit" class="text-red-600 hover:underline">Delete</button>
        </form>
      </div>
    </div>
  @endforeach
</div>

<div class="mt-4">{{ $issues->links() }}</div>
@endsection
