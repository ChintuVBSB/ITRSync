@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">
    <h1 class="text-xl font-bold">Preview Your Submission</h1>

    @if($submission->person)
        <div class="border p-4 rounded bg-white shadow-sm">
            <h2 class="font-semibold text-gray-700 mb-2">Profile</h2>
            <p><strong>Name:</strong> {{ $submission->person->name }}</p>
            <p><strong>PAN:</strong> {{ $submission->person->pan }}</p>
            <p><strong>DOB:</strong> {{ \Carbon\Carbon::parse($submission->person->dob)->format('d-M-Y') }}</p>
            <!-- Add more fields as needed -->
        </div>
    @endif

    <div class="mt-6 flex justify-between">
        <a href="{{ route('submission.details', ['submissionId' => $submission->id]) }}"
           class="text-sm text-blue-600 hover:underline">
            ← Edit Again
        </a>

        <form method="POST" action="{{ route('user.submissions.submit', $submission->id) }}">
            @csrf
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                Submit Final
            </button>
        </form>
    </div>
</div>
@endsection
