<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>{{ $title ?? 'Mini Issue Tracker' }}</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100 text-gray-900">
  <div class="max-w-6xl mx-auto p-6">
    <header class="mb-6 flex items-center justify-between">
      <h1 class="text-2xl font-bold">Mini Issue Tracker</h1>
      <nav class="space-x-4">
        <a href="{{ route('projects.index') }}">Projects</a>
        <a href="{{ route('issues.index') }}">Issues</a>
        <a href="{{ route('tags.index') }}">Tags</a>
      </nav>
    </header>

    @if(session('ok'))
      <div class="mb-4 p-3 bg-green-100 border border-green-300 rounded">{{ session('ok') }}</div>
    @endif
    @if($errors->any())
      <div class="mb-4 p-3 bg-red-100 border border-red-300 rounded">
        <ul class="list-disc list-inside">
          @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
        </ul>
      </div>
    @endif

    {{ $slot ?? '' }}
    @yield('content')
  </div>

  <script>
    window.csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  </script>
</body>
</html>
