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
            <!-- 1 -->
            <div class="flex items-center justify-between gap-4">
                <span class="text-sm font-medium">1. Premium payment receipts for life insurance</span>
                <div class="w-48">
                    <x-file-upload id="life_insurance" wire:model="data.deductions.80C.life_insurance" />
                </div>
            </div>

            <!-- 2 -->
            <div class="flex items-center justify-between gap-4">
                <span class="text-sm font-medium">2. PPF account statements</span>
                <div class="w-48">
                    <x-file-upload id="ppf" wire:model="data.deductions.80C.ppf" />
                </div>
            </div>

            <!-- 3 -->
            <div class="flex items-center justify-between gap-4">
                <span class="text-sm font-medium">3. EPF account statement</span>
                <div class="w-48">
                    <x-file-upload id="epf" wire:model="data.deductions.80C.epf" />
                </div>
            </div>

            <!-- 4 -->
            <div class="flex items-center justify-between gap-4">
                <span class="text-sm font-medium">4. Tax Saver Mutual Funds / FDs</span>
                <div class="w-48">
                    <x-file-upload id="mutual_funds" wire:model="data.deductions.80C.mutual_funds" />
                </div>
            </div>

            <!-- 5 -->
            <div class="flex items-center justify-between gap-4">
                <span class="text-sm font-medium">5. Tuition fees (Spouse/Children)</span>
                <div class="w-48">
                    <x-file-upload id="tuition_fees" wire:model="data.deductions.80C.tuition_fees" />
                </div>
            </div>

            <!-- 6 -->
            <div class="flex items-center justify-between gap-4">
                <span class="text-sm font-medium">6. Any other Investment Proofs</span>
                <div class="w-48">
                    <x-file-upload id="other_proofs" wire:model="data.deductions.80C.other_proofs" />
                </div>
            </div>
        </div>
    </div>
</div>
