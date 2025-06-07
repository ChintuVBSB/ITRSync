<div x-data="{ open: true }" class="space-y-6">
    <div class="bg-white border-none rounded-xl shadow-sm">
        <button @click="open = !open"
                class="w-full flex justify-between items-center px-6 py-3 text-left text-lg font-semibold text-gray-800 hover:bg-gray-50">
            <div class="flex items-center gap-2">
                <span class="text-xl">📈</span>
                Income from Capital Gains
            </div>
            <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div x-show="open" x-collapse class="px-6 py-4 space-y-8 text-sm text-gray-700">

            <!-- Sale of Securities -->
            <div>
                <h4 class="text-md font-semibold text-gray-700 mb-2">1. Sale of Securities</h4>
                <div class="w-40">
                    <label class="block text-sm font-medium mb-1">Demat Statement</label>
                    <div class="w-32 mb-2 mt-2">
                    @include('partials.accordions.assets.file-upload', [
                        'label' => 'Demat Statement',
                        'description' => 'Upload your complete Demat account statement for the financial year showing capital gain transactions.'
                    ])
                    </div>
                </div>
            </div>

            <!-- Sale of Immovable Property -->
            <div class="flex flex-col gap-2">
                <h3 class="text-md font-semibold text-gray-700 mb-3">2. Sale of Immovable Property</h3>
                <div class="flex flex-row sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Sale Deed</label>
                        <div class="w-32 mb-2 mt-2">
                        @include('partials.accordions.assets.file-upload', [
                            'label' => 'Sale Deed',
                            'description' => 'Upload the sale deed of the immovable property sold during the year.'
                        ])
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Purchase Deed</label>
                        <div class="w-32 mb-2 mt-2">
                        @include('partials.accordions.assets.file-upload', [
                            'label' => 'Purchase Deed',
                            'description' => 'Upload the purchase deed to calculate indexed cost of acquisition.'
                        ])
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium mb-1">Improvement Expenses (if any)</label>
                        <input type="text" class="rounded border p-2 w-full"
                               placeholder="Enter amount" />
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
