<?php

use App\Http\Controllers\User\SubmissionController;
use App\Livewire\User\SubmissionDetails;
use App\Livewire\User\SubmissionPreview;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user/submissions/{submissionId}/view', SubmissionDetails::class)
    ->middleware(['auth'])
    ->name('submission.details');
    
Route::get('/user/submissions/{submissionId}/preview', SubmissionPreview::class)
    ->middleware(['auth'])
    ->name('user.submissions.preview.view');