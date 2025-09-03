<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\IssueTagController;


Route::get('/', fn()=>redirect()->route('projects.index'));

Route::resource('projects', ProjectController::class);
Route::resource('issues', IssueController::class)->except(['show']);
Route::get('issues/{issue}', [IssueController::class,'show'])->name('issues.show');

Route::resource('tags', TagController::class)->only(['index','store','destroy']);

// AJAX for tags on an issue
Route::post('/issues/{issue}/tags', [IssueTagController::class, 'attach'])->name('issues.tags.attach');
Route::delete('/issues/{issue}/tags', [IssueTagController::class, 'detach'])->name('issues.tags.detach');

// AJAX for comments
Route::get('/issues/{issue}/comments', [CommentController::class,'index'])->name('issues.comments.index');
Route::post('/issues/{issue}/comments', [CommentController::class,'store'])->name('issues.comments.store');

