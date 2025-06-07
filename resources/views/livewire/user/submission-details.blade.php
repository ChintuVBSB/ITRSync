<div class="p-6">
    <!-- Profile Card -->
    
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

    <div x-data="{ open: null }" class="space-y-3">
    <!-- Income from Salary -->
    <h1 class="text-xl font-bold">Income</h1>
    @include('partials.accordions.income-from-salary')

    <!-- Income House Property-->
    @include('partials.accordions.income-from-house-property')

    <!-- Income From Business and Profession-->
    @include('partials.accordions.income-from-business')

    <!--Income From capital gain -->
    @include('partials.accordions.income-from-capital-gains')   

    <!-- Income From Other Souces -->
    @include('partials.accordions.income-from-other-sources')
    
    <h1 class="text-xl font-bold">Deduction</h1>

    @include('partials.accordions.deductions.deduction-from-80c')
    @include('partials.accordions.deductions.deduction-from-80d')
    @include('partials.accordions.deductions.deduction-from-80e')
    @include('partials.accordions.deductions.deduction-from-80g')
    @include('partials.accordions.deductions.deduction-from-other')
</div>


</div>
