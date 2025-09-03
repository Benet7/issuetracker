<div class="comment-item p-3 mb-2 border rounded bg-gray-50">
  <div class="font-semibold text-sm">{{ $comment->author_name }}</div>
  <div class="text-sm">{{ $comment->body }}</div>
  <div class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</div>
</div>
