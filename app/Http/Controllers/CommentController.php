<?php

namespace App\Http\Controllers;


use App\Models\Issue;
use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    public function index(Issue $issue)
    {
        $comments = $issue->comments()->paginate(5);
        // Return a small HTML fragment (Blade partial) for easy prepend/replace
        return view('comments._list', compact('comments'))->render();
    }

    public function store(StoreCommentRequest $req, Issue $issue)
    {
        $comment = $issue->comments()->create($req->validated());
        // Return just the new list item to prepend
        return view('comments._item', compact('comment'))->render();
    }
}
