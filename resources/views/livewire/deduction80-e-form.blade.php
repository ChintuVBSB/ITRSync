<div x-data="{ open: true }" class="bg-white border-none rounded-xl shadow-sm">
    <button @click="open = !open"
            class="w-full flex justify-between items-center px-6 py-3 text-left text-lg font-semibold text-gray-800 hover:bg-gray-50">
        <div class="flex items-center gap-2">
            <span class="text-xl">🎓</span>
            80E - Education Loan
        </div>
        <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 transition-transform">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <div x-show="open" x-collapse class="px-6 py-4 text-sm text-gray-700 space-y-4">
        <div class="flex items-center justify-between gap-4">
            <span class="text-sm font-medium">
                🏦 Bank statement showing interest payments OR Interest Certificate
            </span>
            <input type="file" wire:model="educationLoanCertificate" class="w-48 rounded border" />
        </div>

        <div>
            <button wire:click="save" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">Save</button>
            @if (session()->has('message'))
                <p class="mt-2 text-green-600">{{ session('message') }}</p>
            @endif
        </div>
    </div>
</div>
