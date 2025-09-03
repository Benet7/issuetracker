<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTagRequest;


class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('name')->paginate(20);
        return view('tags.index', compact('tags'));
    }

    public function store(StoreTagRequest $req)
    {
        Tag::create($req->validated());
        return back()->with('ok','Tag created');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index')->with('ok','Tag deleted');
    }
}
