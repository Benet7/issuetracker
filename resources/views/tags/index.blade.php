@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Tags</h1>

{{-- Create new tag --}}
<form method="POST" action="{{ route('tags.store') }}" class="mb-4 flex gap-2">
    @csrf
    <input type="text" name="name" placeholder="Tag name" 
           class="border p-2 rounded w-1/3" required>
    <input type="text" name="color" placeholder="#hexcolor" 
           class="border p-2 rounded w-1/3">
    <button type="submit" class="bg-black text-white px-4 py-2 rounded">
        Add Tag
    </button>
</form>

{{-- List tags --}}
<div class="grid gap-2">
    @foreach ($tags as $tag)
        <div class="p-3 bg-white border rounded flex items-center justify-between">
            <span class="px-2 py-1 text-sm rounded"
                  style="background: {{ $tag->color ?? '#f1f1f1' }}">
                {{ $tag->name }}
            </span>
            <form method="POST" action="{{ route('tags.destroy', $tag) }}" 
                  onsubmit="return confirm('Delete this tag?')" class="inline">
                @csrf
                @method('DELETE')
                <button class="text-red-600 hover:underline text-sm">Delete</button>
            </form>
        </div>
    @endforeach
</div>

<div class="mt-4">
    {{ $tags->links() }}
</div>
@endsection
