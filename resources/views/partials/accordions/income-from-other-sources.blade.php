<div x-data="{ open:false }" class="space-y-6">
    <div class="bg-white border-none rounded-xl shadow-sm">
        <button @click="open = !open"
            class="w-full flex justify-between items-center px-6 py-3 text-left text-lg font-semibold text-gray-800 hover:bg-gray-50">
            <div class="flex items-center gap-2">
                <span class="text-xl">💰</span>
                Income from Other Sources
            </div>
            <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div x-show="open" x-collapse class="px-6 py-4 space-y-6 text-sm text-gray-700">
            <div class="flex flex-col gap-1">
                <span class="text-sm font-medium">1. Interest Certificate (Savings, FD, RD)</span>
                <div class="w-48">
                    <x-file-upload wire:model="data.income.other_sources.interest_certificate" />
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">2. Dividend Income (if any)</label>
                <div class="flex flex-wrap gap-4">
                    <input type="text" class="rounded border p-1 w-1/3" placeholder="Company Name"
                        wire:model="data.income.other_sources.dividend.company" />
                    <input type="number" class="rounded border p-1 w-32" placeholder="Amount"
                        wire:model="data.income.other_sources.dividend.amount" />
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">3. Interest from Other Party (if any)</label>
                <div class="flex flex-wrap gap-4">
                    <input type="text" class="rounded border p-1 w-1/3" placeholder="Name of Party / Lender"
                        wire:model="data.income.other_sources.otherParty.name" />
                    <input type="number" class="rounded border p-1 w-32" placeholder="Amount"
                        wire:model="data.income.other_sources.otherParty.amount" />
                </div>
            </div>

            <div class="flex flex-col gap-1">
                <span class="text-sm font-medium">4. Crypto / VDA Annual Statement</span>
                <div class="w-48">
                    <x-file-upload wire:model="data.income.other_sources.crypto_statement" />
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">5. Other Income (not covered above)</label>
                <div class="flex flex-wrap gap-4">
                    <input type="text" class="rounded border p-1 w-1/2" placeholder="Description"
                        wire:model="data.income.other_sources.other.description" />
                    <input type="number" class="rounded border p-1 w-32" placeholder="Amount"
                        wire:model="data.income.other_sources.other.amount" />
                </div>
            </div>
        </div>
    </div>
</div>
