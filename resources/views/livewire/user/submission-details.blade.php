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
            <livewire:income-from-salary-form :submission="$submission" />
        @endif

        @if($submission->incomeTypes->pluck('slug')->contains('house_property'))
            <livewire:income-from-house-property-form :submission="$submission" />
        @endif

        @if($submission->incomeTypes->pluck('slug')->contains('business'))
            <livewire:income-from-business-form :submission="$submission" />
        @endif

        @if($submission->incomeTypes->pluck('slug')->contains('capital_gains'))
           <livewire:income-from-capital-gains-form :submission="$submission" />
        @endif

        @if($submission->incomeTypes->pluck('slug')->contains('other_sources'))
            <livewire:income-from-other-sources-form :submission="$submission"/>
        @endif

        <h1 class="text-xl font-bold">Deduction</h1>

        @if($submission->deductionTypes->pluck('slug')->contains('80C'))
            <livewire:deduction80-c-form :submission="$submission" />
        @endif

        @if($submission->deductionTypes->pluck('slug')->contains('80D'))
            <livewire:deduction80-d-form :submission="$submission" />
        @endif

        @if($submission->deductionTypes->pluck('slug')->contains('80E'))
            <livewire:deduction80-e-form :submission="$submission" />
        @endif

        @if($submission->deductionTypes->pluck('slug')->contains('80G'))
            <livewire:deduction80-g-form :submission="$submission" />
        @endif

        @if($submission->deductionTypes->pluck('slug')->contains('other'))
            <livewire:deduction-other-form :submission="$submission" />
        @endif

        <button wire:click="saveAsDraftAndRedirect" class="px-4 py-2 bg-blue-600 text-white rounded">Save as Draft</button>

    </div>
    <!-- Save & Preview Buttons -->


</div>

