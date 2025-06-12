<div x-data="{ open: true }" class="space-y-6">
    <div class="bg-white border-none rounded-xl shadow-sm">
        <button @click="$dispatch('switch-tab'); open = !open"
                class="w-full flex justify-between items-center px-6 py-3 text-left text-lg font-semibold text-gray-800 hover:bg-gray-50">
            <div class="flex items-center gap-2">
                <span class="text-xl">🏠</span>
                Income from House Property
            </div>
            <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 transition-transform">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div x-show="open" x-collapse class="px-6 py-4 space-y-8 text-sm text-gray-700">
            <!-- Rented Property -->
            <div>
                <div class="flex justify-between items-center mb-3">
                    <h4 class="font-semibold">1. Rented Property</h4>
                    <button type="button" wire:click="addRentedProperty"
                        class="text-indigo-600 text-sm font-medium hover:underline">+ Add More Property</button>
                </div>

                @foreach ($rentedInputs as $index => $property)
                
                    <div class="rounded-lg p-4 mb-4 space-y-4 bg-gray-50">
                        <div class="grid sm:grid-cols-3 gap-4">
                            <input type="text" wire:model="rentedInputs.{{ $index }}.tenant_name" placeholder="Tenant Name" class="rounded border p-1">
                            <input type="number" wire:model="rentedInputs.{{ $index }}.rental_income" placeholder="Rental Income" class="rounded border p-1">
                            <input type="text" wire:model="rentedInputs.{{ $index }}.property_address" placeholder="Property Address" class="rounded border p-1">
                        </div>

                        <div class="grid sm:grid-cols-3 gap-4">
                            <div>
                                <label class="text-sm font-medium mb-1">House Tax Receipt</label>
                                <input type="file" wire:model="rentedInputs.{{ $index }}.house_tax_receipt" class="w-full rounded border">
                            </div>
                            <div>
                                <label class="text-sm font-medium mb-1">Interest Certificate</label>
                                <input type="file" wire:model="rentedInputs.{{ $index }}.interest_certificate" class="w-full rounded border">
                            </div>
                        </div>

                        <div class="grid sm:grid-cols-3 gap-4">
                            <input type="text" wire:model="rentedInputs.{{ $index }}.ownership_percent" placeholder="% Ownership" class="rounded border p-1">
                            <input type="number" wire:model="rentedInputs.{{ $index }}.months_occupied" placeholder="Months Occupied" class="rounded border p-1">
                        </div>

                        <div class="text-right">
                            <button type="button" wire:click="removeRentedProperty({{ $index }})"
                                class="text-red-500 text-sm font-medium hover:underline">Remove</button>
                        </div>
                    </div>
                @endforeach 
            </div>

            <!-- Self-Occupied Property -->
            <div>
                <h4 class="font-semibold mb-3">2. Self-Occupied Property</h4>
                <div class="grid sm:grid-cols-3 gap-4">
                    <input type="text" wire:model="selfAddress" placeholder="Property Address" class="rounded border p-1">
                    <input type="text" wire:model="selfOwnershipPercent" placeholder="% Ownership" class="rounded border p-1">
                </div>
                <div class="flex items-center gap-4 mt-4">
                    <span class="text-sm font-medium">Interest Certificate</span>
                    <input type="file" wire:model="selfInterestCertificate" class="w-48 rounded border">
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
