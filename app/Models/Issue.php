<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    /** @use HasFactory<\Database\Factories\IssueFactory> */
    use HasFactory;

    protected $fillable = [
        'project_id','title','description','status','priority','due_date'
    ];

    public function project()  { return $this->belongsTo(Project::class); }
    public function comments() { return $this->hasMany(Comment::class)->latest(); }
    public function tags()     { return $this->belongsToMany(Tag::class)->withTimestamps(); }

    /* Query scopes for filters */
    public function scopeStatus($q, $status)
    {
        return $status ? $q->where('status', $status) : $q;
    }
    public function scopePriority($q, $priority)
    {
        return $priority ? $q->where('priority', $priority) : $q;
    }
    public function scopeTag($q, $tagId)
    {
        return $tagId ? $q->whereHas('tags', fn($qq)=>$qq->where('tags.id',$tagId)) : $q;
    }
}
