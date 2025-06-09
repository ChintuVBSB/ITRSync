<?php

use App\Http\Controllers\User\SubmissionController;
use App\Livewire\User\SubmissionDetails;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user/submissions/{submissionId}/view', SubmissionDetails::class)
    ->middleware(['auth'])
    ->name('submission.details');
    
    Route::post('/user/submissions/{submission}/preview', [SubmissionController::class, 'saveAsDraft'])->name('user.submissions.preview');
    Route::get('/user/submissions/{submission}/preview', [SubmissionController::class, 'preview'])->name('user.submissions.preview.view');
    Route::post('/user/submissions/{submission}/submit', [SubmissionController::class, 'finalSubmit'])->name('user.submissions.submit');
