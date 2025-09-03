<?php

namespace App\Http\Controllers;


use App\Models\Issue;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\StoreIssueRequest;
use App\Http\Requests\UpdateIssueRequest; 


class IssueController extends Controller
{
   public function index(Request $r)
    {
        $issues = Issue::with(['project','tags'])
            ->status($r->status)
            ->priority($r->priority)
            ->tag($r->tag_id)
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $tags = Tag::orderBy('name')->get();

        return view('issues.index', compact('issues','tags'));
    }

    public function create()
    {
        return view('issues.create', [
            'projects' => Project::orderBy('name')->get(),
            'statuses' => ['open','in_progress','closed'],
            'priorities' => ['low','medium','high'],
        ]);
    }

    public function store(StoreIssueRequest $req)
    {
        $issue = Issue::create($req->validated());
        return redirect()->route('issues.show',$issue)->with('ok','Issue created');
    }

    public function show(Issue $issue)
    {
        $issue->load(['project','tags','comments' => fn($q)=>$q->latest()]);
        $allTags = Tag::orderBy('name')->get();
        return view('issues.show', compact('issue','allTags'));
    }

    public function edit(Issue $issue)
    {
        return view('issues.edit', [
            'issue'=>$issue,
            'projects'=>Project::orderBy('name')->get(),
            'statuses'=>['open','in_progress','closed'],
            'priorities'=>['low','medium','high'],
        ]);
    }

    public function update(UpdateIssueRequest $req, Issue $issue)
    {
        $issue->update($req->validated());
        return redirect()->route('issues.show',$issue)->with('ok','Updated');
    }

    public function destroy(Issue $issue)
    {
        $issue->delete();
        return redirect()->route('issues.index')->with('ok','Deleted');
    }
}
