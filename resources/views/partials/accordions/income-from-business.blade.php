<div x-data="{ open: false, businesses: [1] }" class="space-y-6">
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
                    <button @click="businesses.push(businesses.length + 1)"
                            class="text-indigo-600 text-sm font-medium hover:underline">
                        + Add More Business
                    </button>
                </div>

                <template x-for="index in businesses" :key="index">
                    <div class="border rounded-lg p-4 mb-4 bg-gray-50 space-y-4">
                        <div class="flex flex-row justify-between gap-4">
                            <input type="text" class="rounded border p-1 sm:col-span-2" placeholder="Name of the Business">
                            <input type="number" class="rounded border p-1" placeholder="Bank Sales">
                            <input type="number" class="rounded border p-1" placeholder="Cash Sales">
                        </div>
                    </div>
                </template>
            </div>

            <!-- Normal Business -->
            <div>
                <h4 class="text-md font-semibold text-gray-700 mb-3">2. Normal Business</h4>
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                    <div class="flex flex-row gap-4">
                    <input type="number" class="rounded border p-1" placeholder="Total Sales">
                    <input type="number" class="rounded border p-1" placeholder="Total Expenses">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Profit & Loss Statement</label>
                        <div class="w-32 mb-2 mt-2">
                        @include('partials.accordions.assets.file-upload', [
                            'label' => 'P&L Statement',
                            'description' => 'Upload profit & loss statement or ledger report from your accounting software.'
                        ])
                        </div>
                    </div>
                </div>
            </div>

            <!-- Income from Firm -->
            <div>
                <h4 class="text-md font-semibold text-gray-700 mb-3">3. Interest / Remuneration / Profit From Firm</h4>
                <div class="flex flex-row sm:grid-cols-4 gap-4">
                    <input type="text" class="rounded border p-1 sm:col-span-1" placeholder="Firm Name & PAN">
                    <input type="text" class="rounded border p-1" placeholder="% Share">
                    <input type="number" class="rounded border p-1" placeholder="Remuneration / Salary">
                    </div>
                    <div class="flex flex-row gap-4 mb-2 mt-2">
                    <input type="number" class="rounded border p-1" placeholder="Interest on Capital">
                    <input type="number" class="rounded border p-1" placeholder="Profit / Loss of Firm">
                    <input type="number" class="rounded border p-1 w-full sm:w-1/2" placeholder="Closing Balance as on 31st March">
                </div>
            </div>
        </div>
    </div>
</div>
