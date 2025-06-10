<div x-data="{ open: true }" class="space-y-6">
    <div class="bg-white border-none rounded-xl shadow-sm">
        <button @click="open = !open"
            class="w-full flex justify-between items-center px-6 py-3 text-left text-lg font-semibold text-gray-800 hover:bg-gray-50">
            <div class="flex items-center gap-2">
                <span class="text-xl">📊</span>
                Income from Business & Profession
            </div>
            <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 transition-transform">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div x-show="open" x-collapse class="px-6 py-4 space-y-10 text-sm text-gray-700">

            <!-- Presumptive -->
            <div>
                <div class="flex justify-between mb-3">
                    <h4 class="font-semibold">1. Presumptive Scheme</h4>
                    <button wire:click="addPresumptiveBusiness" class="text-indigo-600 text-sm hover:underline">+ Add More Business</button>
                </div>
                @foreach ($presumptive as $index => $b)
                    <div class="bg-gray-50 border rounded-lg p-4 space-y-4 mb-4">
                        <div class="flex flex-wrap gap-4">
                            <input type="text" wire:model="presumptive.{{ $index }}.name" placeholder="Business Name" class="rounded border p-1">
                            <input type="number" wire:model="presumptive.{{ $index }}.bank_sales" placeholder="Bank Sales" class="rounded border p-1">
                            <input type="number" wire:model="presumptive.{{ $index }}.cash_sales" placeholder="Cash Sales" class="rounded border p-1">
                        </div>
                        <div class="text-right">
                            <button wire:click="removePresumptiveBusiness({{ $index }})" class="text-red-600 text-sm hover:underline">Remove</button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Normal -->
            <div>
                <h4 class="font-semibold mb-3">2. Normal Business</h4>
                <div class="grid sm:grid-cols-4 gap-4">
                    <input type="number" wire:model="normalSales" placeholder="Total Sales" class="rounded border p-1">
                    <input type="number" wire:model="normalExpenses" placeholder="Total Expenses" class="rounded border p-1">
                    <div>
                        <label class="text-sm font-medium">Profit & Loss Statement</label>
                        <input type="file" wire:model="plStatement" class="w-48 rounded border">
                    </div>
                </div>
            </div>

            <!-- Firm -->
            <div>
                <h4 class="font-semibold mb-3">3. Income from Firm</h4>
                <div class="grid sm:grid-cols-4 gap-4">
                    <input type="text" wire:model="firmNamePan" placeholder="Firm Name & PAN" class="rounded border p-1">
                    <input type="text" wire:model="firmSharePercent" placeholder="% Share" class="rounded border p-1">
                    <input type="number" wire:model="firmRemuneration" placeholder="Remuneration" class="rounded border p-1">
                    <input type="number" wire:model="firmInterest" placeholder="Interest" class="rounded border p-1">
                </div>
                <div class="grid sm:grid-cols-4 gap-4 mt-4">
                    <input type="number" wire:model="firmProfitOrLoss" placeholder="Profit/Loss" class="rounded border p-1">
                    <input type="number" wire:model="firmClosingBalance" placeholder="Closing Balance" class="rounded border p-1">
                </div>
            </div>

            <div>
                <button wire:click="save" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
                @if (session()->has('message'))
                    <p class="mt-2 text-green-600">{{ session('message') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
