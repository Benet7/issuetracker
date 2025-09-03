@extends('layouts.app')
@section('content')
<div class="bg-white p-5 rounded border">
  <div class="flex items-start justify-between">
    <div>
      <h2 class="text-xl font-bold">{{ $issue->title }}</h2>
      <div class="text-sm text-gray-600">Project: {{ $issue->project->name }}</div>
      <div class="mt-2 flex gap-2">
        <span class="px-2 py-1 text-xs border rounded">{{ $issue->status }}</span>
        <span class="px-2 py-1 text-xs border rounded">{{ $issue->priority }}</span>
        @if($issue->due_date)<span class="px-2 py-1 text-xs border rounded">Due: {{ $issue->due_date }}</span>@endif
      </div>
      <p class="mt-3">{{ $issue->description }}</p>
    </div>
    <div>
      <a href="{{ route('issues.edit',$issue) }}" class="text-blue-600">Edit</a>
    </div>
  </div>

  <hr class="my-4">

  <div>
    <h3 class="font-semibold">Tags</h3>
    <div id="tag-list" class="flex gap-2 mt-2 flex-wrap">
      @foreach($issue->tags as $tag)
        <button data-id="{{ $tag->id }}" class="tag-pill px-2 py-1 text-xs rounded border" style="background: {{ $tag->color ?? '#fff' }}">
          {{ $tag->name }} &times;
        </button>
      @endforeach
    </div>

    <div class="mt-3">
      <select id="tag-select" class="border p-2 rounded">
        <option value="">Add tag…</option>
        @foreach($allTags as $t)
          <option value="{{ $t->id }}">{{ $t->name }}</option>
        @endforeach
      </select>
      <button id="add-tag" class="ml-2 px-3 py-2 bg-black text-white rounded">Attach</button>
    </div>
  </div>

  <hr class="my-4">

  <div>
    <h3 class="font-semibold mb-2">Comments</h3>

    <!-- New comment -->
    <form id="comment-form" class="mb-3">
      @csrf
      <input name="author_name" class="border p-2 rounded mr-2" placeholder="Your name">
      <input name="body" class="border p-2 rounded mr-2 w-1/2" placeholder="Add a comment...">
      <button class="px-3 py-2 bg-black text-white rounded">Post</button>
    </form>

    <!-- List -->
    <div id="comments"></div>
    <button id="load-more" class="mt-3 px-3 py-2 border rounded">Load more</button>
  </div>
</div>

<script>
const issueId = {{ $issue->id }};

// ----------------- TAGS ----------------- //
// Attach tag
document.getElementById('add-tag').addEventListener('click', async () => {
  const tagId = document.getElementById('tag-select').value;
  if (!tagId) return;
  const res = await fetch(`{{ route('issues.tags.attach',$issue) }}`, {
    method:'POST',
    headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
    body: JSON.stringify({tag_id: Number(tagId)})
  });
  const data = await res.json();
  renderTags(data.tags);
});

// Detach tag (click on pill)
document.getElementById('tag-list').addEventListener('click', async (e)=>{
  const btn = e.target.closest('.tag-pill'); 
  if(!btn) return;
  const tagId = btn.dataset.id;
  const res = await fetch(`{{ route('issues.tags.detach',$issue) }}`, {
    method:'POST',
    headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
    body: JSON.stringify({tag_id: Number(tagId)})
  });
  const data = await res.json();
  renderTags(data.tags);
});

function renderTags(tags){
  const wrap = document.getElementById('tag-list');
  wrap.innerHTML = '';
  tags.forEach(t=>{
    const el = document.createElement('button');
    el.className='tag-pill px-2 py-1 text-xs rounded border';
    el.dataset.id = t.id;
    el.textContent = t.name+' ×';
    if (t.color) el.style.background = t.color;
    wrap.appendChild(el);
  });
}

// ----------------- COMMENTS ----------------- //
// Load paginated comments
let nextPageUrl = `{{ route('issues.comments.index',$issue) }}`;
async function loadComments(){
  if(!nextPageUrl) return;
  const res = await fetch(nextPageUrl, {headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}','Accept':'text/html'}});
  const html = await res.text();
  if(html.trim()==='') { nextPageUrl=null; return; }
  const container = document.createElement('div');
  container.innerHTML = html;
  const next = container.querySelector('[data-next]');
  nextPageUrl = next ? next.getAttribute('data-next') : null;
  document.getElementById('comments').append(...container.querySelectorAll('.comment-item'));
}
document.getElementById('load-more').addEventListener('click', loadComments);
loadComments();

// Add new comment
document.getElementById('comment-form').addEventListener('submit', async (e)=>{
  e.preventDefault();
  const form = e.target;
  const formData = new FormData(form); // ✅ collects author_name + body

  const res = await fetch(`{{ route('issues.comments.store',$issue) }}`, {
    method:'POST',
    headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}','Accept':'text/html'},
    body: formData
  });

  const liHTML = await res.text();
  const wrapper = document.createElement('div');
  wrapper.innerHTML = liHTML;
  const item = wrapper.querySelector('.comment-item');
  document.getElementById('comments').prepend(item);
  form.reset();
});
</script>



@endsection
