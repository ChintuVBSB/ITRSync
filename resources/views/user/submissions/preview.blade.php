@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">
    <h1 class="text-xl font-bold">Preview Your Submission</h1>

    {{-- Profile Info --}}
    @if($submission->person)
        <div class="border p-4 rounded bg-white shadow-sm">
            <h2 class="font-semibold text-gray-700 mb-2">Profile</h2>
            <p><strong>Name:</strong> {{ $submission->person->name }}</p>
            <p><strong>PAN:</strong> {{ $submission->person->pan }}</p>
            <p><strong>DOB:</strong> {{ \Carbon\Carbon::parse($submission->person->dob)->format('d-M-Y') }}</p>
        </div>
    @endif

    {{-- Income – Salary --}}
    @if($submission->incomeFromSalary)
    <div class="border p-4 rounded bg-white shadow-sm mt-6">
        <h2 class="font-semibold text-gray-700 mb-2">Income – Salary</h2>
        <p><strong>Employer PAN:</strong> {{ $submission->incomeFromSalary->employer_pan ?? '—' }}</p>
        <p><strong>Employer Address:</strong> {{ $submission->incomeFromSalary->employer_address ?? '—' }}</p>
        <p><strong>Salary Amount:</strong> ₹{{ $submission->incomeFromSalary->salary_amount ?? '—' }}</p>
        <p><strong>HRA City:</strong> {{ $submission->incomeFromSalary->hra_city ?? '—' }}</p>
        <p><strong>Rent Paid:</strong> ₹{{ $submission->incomeFromSalary->hra_rent_paid ?? '—' }}</p>
    </div>
    @endif
    
    {{-- Deduction – 80C --}}
    @if($submission->deduction80C)
    <div class="border p-4 rounded bg-white shadow-sm mt-6">
        <h2 class="font-semibold text-gray-700 mb-2">Deduction – 80C</h2>
        <p><strong>Tuition Fees:</strong> ₹{{ $submission->deduction80C->tuition_fees ?? '—' }}</p>
        <p><strong>PPF:</strong> ₹{{ $submission->deduction80C->ppf ?? '—' }}</p>
    </div>
    @endif

    {{-- Other Deductions --}}
    @if($submission->deductionOther)
    <div class="border p-4 rounded bg-white shadow-sm mt-6">
        <h2 class="font-semibold text-gray-700 mb-2">Other Deductions</h2>
        <p><strong>Description:</strong> {{ $submission->deductionOther->description ?? '—' }}</p>
    </div>
    @endif

    {{-- Footer Actions --}}
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
