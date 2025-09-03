@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold">{{ $project->name }}</h1>
<p class="mb-2">{{ $project->description }}</p>
<p><strong>Start:</strong> {{ $project->start_date }} | <strong>Deadline:</strong> {{ $project->deadline }}</p>

<h2 class="text-xl font-semibold mt-6">Issues</h2>
<div class="grid gap-3 mt-3">
    @foreach($project->issues as $issue)
        <a href="{{ route('issues.show',$issue) }}" class="block p-3 border bg-white rounded">
            <div class="font-semibold">{{ $issue->title }}</div>
            <div class="text-sm text-gray-600">{{ $issue->status }} | {{ $issue->priority }}</div>
        </a>
    @endforeach
</div>
@endsection
