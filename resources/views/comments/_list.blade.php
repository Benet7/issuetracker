@foreach($comments as $comment)
  @include('comments._item', ['comment' => $comment])
@endforeach

@if($comments->hasMorePages())
  <div data-next="{{ $comments->nextPageUrl() }}"></div>
@endif
