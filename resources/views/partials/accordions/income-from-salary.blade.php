<div x-data="{ open: true}" class="space-y-3">
    <div class="bg-white border-none rounded-xl shadow-sm">
        <button @click="open = !open"
            class="w-full flex justify-between items-center px-6 py-3 text-left text-lg font-semibold text-gray-800 hover:bg-gray-50">
            <div class="flex items-center gap-2">
                <span class="text-xl">💵</span>
                Income from Salary
            </div>
            <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div x-show="open" x-collapse class="px-6 py-4 space-y-6 text-sm text-gray-700">

            <!-- Upload Row -->
            <div class="flex flex-col gap-2 sm:grid-cols-3 gap-5">
                <!-- Form 16 -->
                <div>
                    <label class="block text-sm font-medium mb-1">Form 16</label>
                    <div class="w-48">
                       <x-file-upload id="form_16" />
                    </div>
                </div>

                <!-- Salary Slips -->
                <div>
                    <label class="block text-sm font-medium mb-1">Salary Slips</label>
                    <div class="w-48">
                        <x-file-upload id="salary_slips" />
                    </div>
                </div>

                <!-- Arrear Sheet -->
                <div>
                    <label class="block text-sm font-medium mb-1">Arrear Sheet (if received)</label>
                    <div class="w-48">
                       <x-file-upload id="arrear_sheet" />
                    </div>
                </div>
            </div>

            <!-- Pension-only -->
            <div class="space-y-2 mt-6">
                <p class="font-semibold">If no Form 16 (e.g. Pension Only)</p>
                <div class="flex flex-row sm:grid-cols-5 gap-4">
                    <input type="text" placeholder="TAN or PAN of Employer" class="rounded border p-2" />
                    <input type="text" placeholder="Address of Employer" class="rounded border p-2" />
                    <input type="number" placeholder="Salary Amount" class="rounded border p-2" />
                </div>
            </div>

            <!-- HRA -->
            <div class="mt-6 space-y-2">
                <p class="font-semibold">Details required for claiming HRA</p>
                <div class="flex flex-row gap-4">
                    <input type="number" placeholder="Rent Paid" class="rounded border p-2" />
                    <input type="text" placeholder="City of Residence" class="rounded border p-2" />
                </div>
                <div class="pl-4 border-l-4 border-indigo-300 mt-4">
                    <p class="font-medium text-sm mb-2">Landlord Details</p>
                    <div class="flex flex-row sm:grid-cols-4 gap-4">
                        <input type="text" placeholder="Name of Landlord" class="rounded border p-2" />
                        <input type="text" placeholder="Address of the Property" class="rounded border p-2 col-span-2" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
