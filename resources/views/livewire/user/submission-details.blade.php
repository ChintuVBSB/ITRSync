<div class="p-6">
    <!-- Profile Card -->
    @if($submission->person)
    <div class="bg-white mb-4 border border-gray-200 rounded-xl shadow-sm">
        <div class="px-6 py-4 border-b">
            <h2 class="text-lg font-semibold text-gray-800">Profile</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 px-6 py-4 text-sm text-gray-900">
            <div>
                <p class="text-gray-500 flex items-center gap-1">
                    Name
                </p>
                <p class="font-medium">{{ $submission->person->name ?? '—' }}</p>
            </div>
            <div>
                <p class="text-gray-500 flex items-center gap-1">
                    PAN
                    <span class="text-gray-400" title="Permanent Account Number">ℹ️</span>
                </p>
                <p class="font-medium">{{ $submission->person->pan ?? '—' }}</p>
            </div>
            <div>
                <p class="text-gray-500">Date of Birth</p>
                <p class="font-medium">
                    {{ $submission->person->dob ? \Carbon\Carbon::parse($submission->person->dob)->format('d-M-Y') : '—' }}
                </p>
            </div>
            <div>
                <p class="text-gray-500 flex items-center gap-1">
                    Aadhaar Number
                    <span class="text-gray-400" title="Masked for security">ℹ️</span>
                </p>
                <p class="font-medium">
                    {{ $submission->person->aadhar ? '2xxx xxxx ' . substr($submission->person->aadhar, -4) : '—' }}
                </p>
            </div>
            <div>
                <p class="text-gray-500">Mobile</p>
                <p class="font-medium">{{ $submission->person->mobile ?? '—' }}</p>
            </div>
            <div>
                <p class="text-gray-500">Email</p>
                <p class="font-medium">{{ $submission->person->email ?? '—' }}</p>
            </div>
        </div>
    </div>
    @else
        <p class="text-gray-500 px-6">No person details linked to this submission.</p>
    @endif

    <div x-data="{ open: null }" class="space-y-3">

    <!-- Income from Salary -->
    <h1 class="text-xl font-bold">Income</h1>

        @if($submission->incomeTypes->pluck('slug')->contains('salary'))
            @include('partials.accordions.income-from-salary')
        @endif

        @if($submission->incomeTypes->pluck('slug')->contains('house_property'))
            @include('partials.accordions.income-from-house-property')
        @endif

        @if($submission->incomeTypes->pluck('slug')->contains('business'))
            @include('partials.accordions.income-from-business')
        @endif

        @if($submission->incomeTypes->pluck('slug')->contains('capital_gains'))
            @include('partials.accordions.income-from-capital-gains')
        @endif

        @if($submission->incomeTypes->pluck('slug')->contains('other_sources'))
            @include('partials.accordions.income-from-other-sources')
        @endif

        <h1 class="text-xl font-bold">Deduction</h1>

        @if($submission->deductionTypes->pluck('slug')->contains('80C'))
            @include('partials.accordions.deductions.deduction-from-80c')
        @endif

        @if($submission->deductionTypes->pluck('slug')->contains('80D'))
            @include('partials.accordions.deductions.deduction-from-80d')
        @endif

        @if($submission->deductionTypes->pluck('slug')->contains('80E'))
            @include('partials.accordions.deductions.deduction-from-80e')
        @endif

        @if($submission->deductionTypes->pluck('slug')->contains('80G'))
            @include('partials.accordions.deductions.deduction-from-80g')
        @endif

        @if($submission->deductionTypes->pluck('slug')->contains('other'))
            @include('partials.accordions.deductions.deduction-from-other')
        @endif
    </div>
    <!-- Save & Preview Buttons -->
<div class="flex justify-end gap-2 mt-6 space-x-4">
   

    <button 
        class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-semibold text-gray-700 hover:bg-gray-200 transition">
        Preview
    </button>
     <button
        wire:click="save"
        class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-semibold  hover:bg-blue-700 transition">
        Save
    </button>
</div>

</div>

