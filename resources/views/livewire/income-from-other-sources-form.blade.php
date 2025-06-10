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
                <label class="text-sm font-medium">1. Interest Certificate (Savings, FD, RD)</label>
                <input type="file" wire:model="interestCertificate" class="w-48 rounded border" />
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">2. Dividend Income (if any)</label>
                <div class="flex flex-wrap gap-4">
                    <input type="text" class="rounded border p-1 w-1/3" placeholder="Company Name" wire:model.defer="dividendCompany" />
                    <input type="number" class="rounded border p-1 w-32" placeholder="Amount" wire:model.defer="dividendAmount" />
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">3. Interest from Other Party</label>
                <div class="flex flex-wrap gap-4">
                    <input type="text" class="rounded border p-1 w-1/3" placeholder="Name of Lender" wire:model.defer="otherPartyName" />
                    <input type="number" class="rounded border p-1 w-32" placeholder="Amount" wire:model.defer="otherPartyAmount" />
                </div>
            </div>

            <div class="flex flex-col gap-1">
                <label class="text-sm font-medium">4. Crypto / VDA Statement</label>
                <input type="file" wire:model="cryptoStatement" class="w-48 rounded border" />
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">5. Other Income</label>
                <div class="flex flex-wrap gap-4">
                    <input type="text" class="rounded border p-1 w-1/2" placeholder="Description" wire:model.defer="otherDescription" />
                    <input type="number" class="rounded border p-1 w-32" placeholder="Amount" wire:model.defer="otherAmount" />
                </div>
            </div>

            <div class="mt-4">
                <button wire:click="save" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
                @if (session()->has('message'))
                    <p class="mt-2 text-green-600">{{ session('message') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
