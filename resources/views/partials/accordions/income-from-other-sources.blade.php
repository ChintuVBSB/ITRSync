<div x-data="{ open: true }" class="space-y-6">
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

            <!-- 1. Interest Certificate -->
            <div class="flex flex-col gap-1">
                <span class="text-sm font-medium">
                    1. Interest Certificate (Savings, FD, RD)
                </span>
                <div class="w-40">
                    @include('partials.accordions.assets.file-upload', [
                        'label' => 'Interest Certificate',
                        'description' => 'Upload certificates for interest earned from savings, fixed or recurring deposits.',
                        'multiple' => true
                    ])
                </div>
            </div>

            <!-- 2. Dividend Income -->
            <div>
                <label class="block text-sm font-medium mb-1">2. Dividend Income (if any)</label>
                <div class="flex flex-wrap gap-4">
                    <input type="text" class="rounded border p-1 w-1/3" placeholder="Company Name" />
                    <input type="number" class="rounded border p-1 w-32" placeholder="Amount" />
                </div>
            </div>

            <!-- 3. Interest from Other Party -->
            <div>
                <label class="block text-sm font-medium mb-1">3. Interest from Other Party (if any)</label>
                <div class="flex flex-wrap gap-4">
                    <input type="text" class="rounded border p-1 w-1/3" placeholder="Name of Party / Lender" />
                    <input type="number" class="rounded border p-1 w-32" placeholder="Amount" />
                </div>
            </div>

            <!-- 4. Crypto Income -->
            <div class="flex flex-col gap-1">
                <span class="text-sm font-medium">
                    4. Crypto / VDA Annual Statement
                </span>
                <div class="w-40">
                    @include('partials.accordions.assets.file-upload', [
                        'label' => 'Crypto Income Statement',
                        'description' => 'Upload annual summary from crypto platforms for VDA income.',
                        'multiple' => true
                    ])
                </div>
            </div>

            <!-- 5. Other Income -->
            <div>
                <label class="block text-sm font-medium mb-1">5. Other Income (not covered above)</label>
                <div class="flex flex-wrap gap-4">
                    <input type="text" class="rounded border p-1 w-1/2" placeholder="Description" />
                    <input type="number" class="rounded border p-1 w-32" placeholder="Amount" />
                </div>
            </div>
        </div>
    </div>
</div>
