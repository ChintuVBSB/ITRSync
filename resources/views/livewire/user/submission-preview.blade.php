<div class="p-6 space-y-6">
    <h1 class="text-xl font-bold">Preview Your Submission</h1>

    {{-- Profile --}}
    @if($submission->person)
        <div class="border p-4 rounded bg-white shadow-sm">
            <h2 class="font-semibold text-gray-700 mb-2">Profile</h2>
            <p><strong>Name:</strong> {{ $submission->person->name }}</p>
            <p><strong>PAN:</strong> {{ $submission->person->pan }}</p>
            <p><strong>DOB:</strong> {{ \Carbon\Carbon::parse($submission->person->dob)->format('d-M-Y') }}</p>
        </div>
    @endif

    {{-- Income From Salary --}}
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

    {{-- Income From House Property --}}
    {{-- Income From House Property --}}
@php
    $houseCollection = collect($submission->incomeFromHouseProperty);
@endphp

@if($houseCollection->isNotEmpty())
    @foreach ($houseCollection as $house)
        @php
            $self = collect($house->selfOccupiedProperties)->first();
            $rentedProps = collect($house->rentedProperties);
        @endphp

        <div class="border p-4 rounded bg-white shadow-sm mt-6">
            <h2 class="font-semibold text-gray-700 mb-2">Income – House Property</h2>

            {{-- Self-Occupied --}}
            @if($self)
                <h3 class="font-medium mt-2 text-gray-600">Self-Occupied</h3>
                <p><strong>Address:</strong> {{ $self->property_address ?? '—' }}</p>
                <p><strong>Ownership %:</strong> {{ $self->ownership_percent ?? '—' }}</p>
            @endif

            {{-- Rented --}}
            @if($rentedProps->isNotEmpty())
                <h3 class="font-medium mt-4 text-gray-600">Rented Properties</h3>
                @foreach($rentedProps as $rent)
                    <div class="border p-3 rounded mb-2 bg-gray-50">
                        <p><strong>Tenant:</strong> {{ $rent->tenant_name ?? '—' }}</p>
                        <p><strong>Address:</strong> {{ $rent->property_address ?? '—' }}</p>
                        <p><strong>Income:</strong> ₹{{ $rent->rental_income ?? '—' }}</p>
                        <p><strong>Ownership %:</strong> {{ $rent->ownership_percent ?? '—' }}</p>
                        <p><strong>Months Occupied:</strong> {{ $rent->months_occupied ?? '—' }}</p>
                    </div>
                @endforeach
            @endif
        </div>
    @endforeach
@endif

@if($submission->incomeFromBusiness)
    <div class="border p-4 rounded bg-white shadow-sm mt-6">
        <h2 class="font-semibold text-gray-700 mb-2">Income – Business & Profession</h2>

        {{-- Presumptive Businesses --}}
        @if($submission->incomeFromBusiness->presumptiveBusinesses->isNotEmpty())
            <h3 class="font-medium text-gray-600 mt-2">Presumptive Scheme</h3>
            @foreach($submission->incomeFromBusiness->presumptiveBusinesses as $p)
                <p><strong>Name:</strong> {{ $p->name }}</p>
                <p><strong>Bank Sales:</strong> ₹{{ $p->bank_sales }}</p>
                <p><strong>Cash Sales:</strong> ₹{{ $p->cash_sales }}</p>
            @endforeach
        @endif

        {{-- Normal Business --}}
        @php $normal = $submission->incomeFromBusiness->normalBusinesses->first(); @endphp
        @if($normal)
            <h3 class="font-medium text-gray-600 mt-4">Normal Business</h3>
            <p><strong>Total Sales:</strong> ₹{{ $normal->total_sales }}</p>
            <p><strong>Total Expenses:</strong> ₹{{ $normal->total_expenses }}</p>
        @endif

        {{-- Firm Income --}}
        @php $firm = $submission->incomeFromBusiness->firmIncomes->first(); @endphp
        @if($firm)
            <h3 class="font-medium text-gray-600 mt-4">Income from Firm</h3>
            <p><strong>Firm Name & PAN:</strong> {{ $firm->name_pan }}</p>
            <p><strong>% Share:</strong> {{ $firm->share_percent }}</p>
            <p><strong>Remuneration:</strong> ₹{{ $firm->remuneration }}</p>
            <p><strong>Interest:</strong> ₹{{ $firm->interest }}</p>
            <p><strong>Profit or Loss:</strong> ₹{{ $firm->profit_or_loss }}</p>
            <p><strong>Closing Balance:</strong> ₹{{ $firm->closing_balance }}</p>
        @endif
    </div>
@endif

@if($submission->incomeFromCapitalGains)
    <div class="border p-4 rounded bg-white shadow-sm mt-6">
        <h2 class="font-semibold text-gray-700 mb-2">Income – Capital Gains</h2>

        @if(!empty($submission->incomeFromCapitalGains->demat_statements))
            <p><strong>Demat Statement:</strong></p>
            <ul>
                @foreach($submission->incomeFromCapitalGains->demat_statements as $file)
                    <li><a href="{{ asset('storage/' . $file) }}" target="_blank">View File</a></li>
                @endforeach
            </ul>
        @endif

        @if(!empty($submission->incomeFromCapitalGains->sale_deeds))
            <p><strong>Sale Deed:</strong></p>
            <ul>
                @foreach($submission->incomeFromCapitalGains->sale_deeds as $file)
                    <li><a href="{{ asset('storage/' . $file) }}" target="_blank">View File</a></li>
                @endforeach
            </ul>
        @endif

        @if(!empty($submission->incomeFromCapitalGains->purchase_deeds))
            <p><strong>Purchase Deed:</strong></p>
            <ul>
                @foreach($submission->incomeFromCapitalGains->purchase_deeds as $file)
                    <li><a href="{{ asset('storage/' . $file) }}" target="_blank">View File</a></li>
                @endforeach
            </ul>
        @endif

        <p><strong>Improvement Expense:</strong> {{ $submission->incomeFromCapitalGains->improvement_expense_details ?? '—' }}</p>
    </div>
@endif

@if($submission->incomeFromOtherSources)
    <div class="border p-4 rounded bg-white shadow-sm mt-6">
        <h2 class="font-semibold text-gray-700 mb-2">Income – Other Sources</h2>

        <p><strong>Dividend Company:</strong> {{ $submission->incomeFromOtherSources->dividend_company ?? '—' }}</p>
        <p><strong>Dividend Amount:</strong> ₹{{ $submission->incomeFromOtherSources->dividend_amount ?? '—' }}</p>
        <p><strong>Other Party Name:</strong> {{ $submission->incomeFromOtherSources->other_party_name ?? '—' }}</p>
        <p><strong>Other Party Amount:</strong> ₹{{ $submission->incomeFromOtherSources->other_party_amount ?? '—' }}</p>
        <p><strong>Other Description:</strong> {{ $submission->incomeFromOtherSources->other_description ?? '—' }}</p>
        <p><strong>Other Amount:</strong> ₹{{ $submission->incomeFromOtherSources->other_amount ?? '—' }}</p>

        @if($submission->incomeFromOtherSources->interest_certificate)
            <p><strong>Interest Certificate:</strong>
                <a href="{{ asset('storage/' . $submission->incomeFromOtherSources->interest_certificate) }}" target="_blank">View File</a>
            </p>
        @endif

        @if($submission->incomeFromOtherSources->crypto_statement)
            <p><strong>Crypto Statement:</strong>
                <a href="{{ asset('storage/' . $submission->incomeFromOtherSources->crypto_statement) }}" target="_blank">View File</a>
            </p>
        @endif
    </div>
@endif


    {{-- Deductions --}}
    @if($submission->deduction80C)
    <div class="border p-4 rounded bg-white shadow-sm mt-6">
        <h2 class="font-semibold text-gray-700 mb-2">Deduction – 80C</h2>

        @foreach([
            'life_insurance_receipts' => 'Life Insurance Receipts',
            'ppf_statements' => 'PPF Statements',
            'epf_statements' => 'EPF Statements',
            'mutual_fund_fds' => 'Mutual Funds / FDs',
            'tuition_fee_receipts' => 'Tuition Fee Receipts',
            'other_investment_proofs' => 'Other Investment Proofs'
        ] as $field => $label)
            @php $files = $submission->deduction80C->$field; @endphp
            @if(!empty($files))
                <p class="font-semibold mt-2">{{ $label }}:</p>
                <ul class="list-disc list-inside text-sm text-blue-600">
                    @foreach($files as $file)
                        <li><a href="{{ asset('storage/' . $file) }}" target="_blank">View File</a></li>
                    @endforeach
                </ul>
            @endif
        @endforeach
    </div>
    @endif

    @if($submission->deduction80D && !empty($submission->deduction80D->mediclaim_receipts))
    <div class="border p-4 rounded bg-white shadow-sm mt-6">
        <h2 class="font-semibold text-gray-700 mb-2">Deduction – 80D (Mediclaim)</h2>
        <p class="font-semibold">Uploaded Mediclaim Receipts:</p>
        <ul class="list-disc list-inside text-sm text-blue-600">
            @foreach($submission->deduction80D->mediclaim_receipts as $file)
                <li><a href="{{ asset('storage/' . $file) }}" target="_blank">View File</a></li>
            @endforeach
        </ul>
    </div>
@endif

    @if($submission->deduction80E && !empty($submission->deduction80E->education_loan_interest_proofs))
    <div class="border p-4 rounded bg-white shadow-sm mt-6">
        <h2 class="font-semibold text-gray-700 mb-2">Deduction – 80E (Education Loan)</h2>
        <p class="font-semibold">Uploaded Interest Proofs:</p>
        <ul class="list-disc list-inside text-sm text-blue-600">
            @foreach($submission->deduction80E->education_loan_interest_proofs as $file)
                <li><a href="{{ asset('storage/' . $file) }}" target="_blank">View File</a></li>
            @endforeach
        </ul>
    </div>
@endif


    @if($submission->deductionOther)
        <div class="border p-4 rounded bg-white shadow-sm mt-6">
            <h2 class="font-semibold text-gray-700 mb-2">Other Deductions</h2>
            <p><strong>Description:</strong> {{ $submission->deductionOther->description ?? '—' }}</p>
        </div>
    @endif

    {{-- Submit Button --}}
    <div class="mt-6 flex justify-between">
        <a href="{{ route('submission.details', ['submissionId' => $submission->id]) }}"
           class="text-sm text-blue-600 hover:underline">
            ← Edit Again
        </a>

        <form wire:submit.prevent="submitFinal">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                Submit Final
            </button>
        </form>
    </div>
</div>
