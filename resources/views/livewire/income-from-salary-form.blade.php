<div x-data="{ open: true }" class="space-y-3">
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
            <div class="flex flex-col sm:grid sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Form 16</label>
                    <input type="file" wire:model="form16" multiple class="w-full rounded border" />
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Salary Slips</label>
                    <input type="file" wire:model="salarySlips" multiple class="w-full rounded border" />
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Arrear Sheet</label>
                    <input type="file" wire:model="arrearSheet" multiple class="w-full rounded border" />
                </div>
            </div>

            <!-- Pension-only -->
            <div class="space-y-2 mt-6">
                <p class="font-semibold">If no Form 16 (e.g. Pension Only)</p>
                <div class="flex flex-col sm:grid sm:grid-cols-3 gap-4">
                    <input type="text" wire:model.defer="employerPan" placeholder="PAN of Employer" class="rounded border p-1" />
                    <input type="text" wire:model.defer="employerAddress" placeholder="Employer Address" class="rounded border p-1" />
                    <input type="number" wire:model.defer="salaryAmount" placeholder="Salary Amount" class="rounded border p-1" />
                </div>
            </div>

            <!-- HRA -->
            <!-- HRA -->
<div class="mt-6 space-y-2 flex flex-col gap-2">
    <p class="font-semibold">Details required for claiming HRA</p>

    <div class="flex flex-row justify-between sm:grid-cols-4 gap-4 mb-2">
        <!-- Rent Paid -->
        <div class="">
            <input type="number" wire:model.defer="hraRentPaid" placeholder="Rent Paid" class="rounded border p-1" />
        </div>

        <!-- City of Residence -->
        <div class="">
            <input type="text" wire:model.defer="hraCity" placeholder="City of Residence" class="rounded border p-1 w-1/3" />
        </div>

        <!-- Landlord Name -->
        <div class="">
            <input type="text" wire:model.defer="hraLandlordName" placeholder="Name of Landlord" class="rounded border p-1" />
        </div>
    </div>
        <!-- Property Address -->
        <div class="w-full">
            <div class="w-32">
            <input type="text" wire:model.defer="hraPropertyAddress" placeholder="Property Address" class="rounded border p-1" />
        </div>
        </div>
        
</div>
            <!-- Save Button & Flash Message -->
            <div class="mt-6">
                <button wire:click="save" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Save
                </button>

                @if (session()->has('message'))
                    <p class="mt-2 text-green-600 font-medium">{{ session('message') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
