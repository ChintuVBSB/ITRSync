<div x-data="{ open: true }" class="space-y-6">
    <div class="bg-white border-none rounded-xl shadow-sm">
        <button @click="open = !open"
                class="w-full flex justify-between items-center px-6 py-3 text-left text-lg font-semibold text-gray-800 hover:bg-gray-50">
            <div class="flex items-center gap-2">
                <span class="text-xl">📈</span>
                Income from Capital Gains
            </div>
            <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div x-show="open" x-collapse class="px-6 py-4 space-y-8 text-sm text-gray-700">
            <!-- Sale of Securities -->
            <div>
                <h4 class="text-md font-semibold text-gray-700 mb-2">1. Sale of Securities</h4>
                <div class="w-48">
                    <label class="block text-sm font-medium mb-1">Demat Statement</label>
                    <input type="file" wire:model="dematStatement" class="rounded border w-full" />
                </div>
            </div>

            <!-- Sale of Immovable Property -->
            <div class="flex flex-col gap-2">
                <h4 class="text-md font-semibold text-gray-700 mb-3">2. Sale of Immovable Property</h4>
                <div class="flex flex-wrap gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Sale Deed</label>
                        <input type="file" wire:model="saleDeed" class="rounded border w-48" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Purchase Deed</label>
                        <input type="file" wire:model="purchaseDeed" class="rounded border w-48" />
                    </div>
                    <div class="sm:col-span-2 w-full">
                        <label class="block text-sm font-medium mb-1">Improvement Expenses (if any)</label>
                        <input type="text" wire:model.defer="improvementExpense" placeholder="Amount"
                               class="rounded border p-2 w-full" />
                    </div>
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
