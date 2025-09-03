<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Tag;
use Illuminate\Http\Request;


class IssueTagController extends Controller
{
    public function attach(Request $r, Issue $issue)
    {
        $r->validate(['tag_id'=>['required','exists:tags,id']]);
        $issue->tags()->syncWithoutDetaching([$r->integer('tag_id')]);
        $issue->load('tags');
        return response()->json([
            'ok'=>true,
            'tags'=>$issue->tags->map(fn($t)=>[
                'id'=>$t->id,'name'=>$t->name,'color'=>$t->color
            ])
        ]);
    }

    public function detach(Request $r, Issue $issue)
    {
        $r->validate(['tag_id'=>['required','exists:tags,id']]);
        $issue->tags()->detach($r->integer('tag_id'));
        $issue->load('tags');
        return response()->json([
            'ok'=>true,
            'tags'=>$issue->tags->map(fn($t)=>[
                'id'=>$t->id,'name'=>$t->name,'color'=>$t->color
            ])
        ]);
    }
}
