<?php

use App\Livewire\User\SubmissionDetails;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user/submissions/{submissionId}/view', SubmissionDetails::class)
    ->middleware(['auth'])
    ->name('submission.details');

