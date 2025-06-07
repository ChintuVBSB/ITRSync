<div x-data="{ open: false }" class="bg-white border-none rounded-xl shadow-sm">
    <button @click="open = !open"
            class="w-full flex justify-between items-center px-6 py-3 text-left text-lg font-semibold text-gray-800 hover:bg-gray-50">
        <div class="flex items-center gap-2">
            <span class="text-xl">📂</span>
            Any Other Deduction Document
        </div>
        <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <div x-show="open" x-collapse class="px-6 py-4 space-y-4 text-sm text-gray-700">

        <!-- Upload with label -->
        <div class="flex items-center justify-between gap-4">
            <span class="text-sm font-medium">
                🧾 Upload proof for deductions like EV loan, disability certificate, NPS, etc.
            </span>
            <div class="w-40">
                @include('partials.accordions.assets.file-upload', [
                    'label' => 'Other Deduction Proof',
                    'description' => 'Upload document for deduction not covered elsewhere (e.g., EV Loan, Disability Certificate, NPS).'
                ])
            </div>
        </div>

        <!-- Text input for user to describe the attachment -->
        <div>
            <label class="block text-sm font-medium mb-1">Description (optional)</label>
            <input type="text" class="rounded border p-1 w-full sm:w-1/2"
                   placeholder="e.g. EV Vehicle Loan interest certificate" />
        </div>
    </div>
</div>
