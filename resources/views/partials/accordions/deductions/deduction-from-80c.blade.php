<div x-data="{ open: false }" class="space-y-6">
    <div class="bg-white border-none rounded-xl shadow-sm">
        <button @click="open = !open"
            class="w-full flex justify-between items-center px-6 py-3 text-left text-lg font-semibold text-gray-800 hover:bg-gray-50">
            <div class="flex items-center gap-2">
                <span class="text-xl">💸</span>
                80C - Investments
            </div>
            <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div x-show="open" x-collapse class="px-6 py-4 space-y-4 text-sm text-gray-700">
            @foreach([
                'Premium payment receipts for life insurance',
                'PPF account statements',
                'EPF account statement',
                'Tax Saver Mutual Funds / FDs',
                'Tuition fees (Spouse/Children)',
                'Any other Investment Proofs.'
            ] as $label)
                <div class="flex items-center justify-between gap-4">
                    <span class="text-sm font-medium">{{ $loop->iteration }}. {{ $label }}</span>
                    <div class="w-40">
                        @include('partials.accordions.assets.file-upload', ['label' => 'Upload'])
                    </div>
                </div>
            @endforeach

            <div>
                @include('partials.accordions.assets.next')
            </div>
        </div>
    </div>
</div>
