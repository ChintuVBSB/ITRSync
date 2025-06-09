@extends('layouts.app')

@section('content')
<h1 class="text-xl font-bold mb-4">Your Submissions</h1>

<table class="w-full bg-white shadow rounded">
    <thead class="bg-gray-100 text-left">
        <tr>
            <th class="p-3">Name</th>
            <th class="p-3">PAN</th>
            <th class="p-3">Status</th>
            <th class="p-3">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($submissions as $submission)
        <tr class="border-t">
            <td class="p-3">{{ $submission->person->name ?? '—' }}</td>
            <td class="p-3">{{ $submission->person->pan ?? '—' }}</td>
            <td class="p-3">
                <span class="px-2 py-1 rounded bg-gray-200 text-xs">{{ ucfirst($submission->status) }}</span>
            </td>
            <td class="p-3">
                <a href="{{ route('submission.details', $submission->id) }}" class="text-blue-500 hover:underline">View</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
