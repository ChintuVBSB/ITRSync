<div x-data="{ open: false }" class="space-y-6">
    <div class="bg-white border-none rounded-xl shadow-sm">
        <button @click="open = !open"
            class="w-full flex justify-between items-center px-6 py-3 text-left text-lg font-semibold text-gray-800 hover:bg-gray-50">
            <div class="flex items-center gap-2">
                <span class="text-xl">📊</span>
                Income from Business & Profession
            </div>
            <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div x-show="open" x-collapse class="px-6 py-4 space-y-10 text-sm text-gray-700">

            <!-- Presumptive Scheme -->
            <div>
                <div class="flex justify-between items-center mb-3">
                    <h4 class="text-md font-semibold text-gray-700">1. Presumptive Scheme</h4>
                    <button type="button" wire:click="addPresumptiveBusiness"
                        class="text-indigo-600 text-sm font-medium hover:underline">
                        + Add More Business
                    </button>
                </div>

                @foreach ($data['income']['business']['presumptive'] as $index => $business)
                    <div class="border rounded-lg p-4 mb-4 bg-gray-50 space-y-4">
                        <div class="flex flex-row justify-between gap-4">
                            <input type="text" class="rounded border p-1"
                                placeholder="Name of the Business"
                                wire:model="data.income.business.presumptive.{{ $index }}.name">
                            <input type="number" class="rounded border p-1"
                                placeholder="Bank Sales"
                                wire:model="data.income.business.presumptive.{{ $index }}.bank_sales">
                            <input type="number" class="rounded border p-1"
                                placeholder="Cash Sales"
                                wire:model="data.income.business.presumptive.{{ $index }}.cash_sales">
                        </div>
                        <div class="text-right">
                            <button type="button" wire:click="removePresumptiveBusiness({{ $index }})"
                                class="text-red-600 text-sm hover:underline">
                                Remove
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Normal Business -->
            <div>
                <h4 class="text-md font-semibold text-gray-700 mb-3">2. Normal Business</h4>
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                    <input type="number" class="rounded border p-1"
                        placeholder="Total Sales"
                        wire:model="data.income.business.normal.sales">
                    <input type="number" class="rounded border p-1"
                        placeholder="Total Expenses"
                        wire:model="data.income.business.normal.expenses">
                    <div>
                        <label class="block text-sm font-medium mb-1">Profit & Loss Statement</label>
                        <div class="w-48">
                            <x-file-upload wire:model="data.income.business.normal.pl_statement" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Income from Firm -->
            <div>
                <h4 class="text-md font-semibold text-gray-700 mb-3">3. Interest / Remuneration / Profit From Firm</h4>
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                    <input type="text" class="rounded border p-1" placeholder="Firm Name & PAN"
                        wire:model="data.income.business.firm.name_pan">
                    <input type="text" class="rounded border p-1" placeholder="% Share"
                        wire:model="data.income.business.firm.share_percent">
                    <input type="number" class="rounded border p-1" placeholder="Remuneration / Salary"
                        wire:model="data.income.business.firm.remuneration">
                    <input type="number" class="rounded border p-1" placeholder="Interest on Capital"
                        wire:model="data.income.business.firm.interest">
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mt-4">
                    <input type="number" class="rounded border p-1" placeholder="Profit / Loss of Firm"
                        wire:model="data.income.business.firm.profit_or_loss">
                    <input type="number" class="rounded border p-1" placeholder="Closing Balance as on 31st March"
                        wire:model="data.income.business.firm.closing_balance">
                </div>
            </div>

        </div>
    </div>
</div>
