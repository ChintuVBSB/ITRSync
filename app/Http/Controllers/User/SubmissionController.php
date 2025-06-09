<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Submission;

class SubmissionController extends Controller
{
    public function saveAsDraft(Request $request, Submission $submission)
    {
        // Save partial data here from form if using POST inputs
        // Or mark submission as draft
        $submission->status = 'draft';
        $submission->save();

        return redirect()->route('user.submissions.preview.view', $submission->id);
    }



    public function preview(Submission $submission)
    {
        $submission->load(['person', 'incomeTypes', 'deductionTypes']);
        return view('user.submissions.preview', compact('submission'));
    }

    public function finalSubmit(Request $request, Submission $submission)
    {
        // Mark as submitted
        $submission->status = 'submitted';
        $submission->save();

        return redirect()->route('user.submissions.index')->with('success', 'Submission complete.');
    }
}
