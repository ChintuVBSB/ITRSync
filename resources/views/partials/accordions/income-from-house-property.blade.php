<div x-data="{ open: false }" class="space-y-6">
    <div class="bg-white border-none rounded-xl shadow-sm">
        <button @click="open = !open"
                class="w-full flex justify-between items-center px-6 py-3 text-left text-lg font-semibold text-gray-800 hover:bg-gray-50">
            <div class="flex items-center gap-2">
                <span class="text-xl">🏠</span>
                Income from House Property
            </div>
            <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div x-show="open" x-collapse class="px-6 py-4 space-y-8 text-sm text-gray-700">
            <!-- Rented Property Section -->
            <div>
                <div class="flex justify-between items-center mb-3">
                    <h4 class="text-md font-semibold text-gray-700">1. Rented Property</h4>
                    <button type="button" wire:click="addRentedProperty"
                            class="text-indigo-600 text-sm font-medium hover:underline">
                        + Add More Property
                    </button>
                </div>

                @foreach ($data['income']['house_property']['rentedProperties'] as $index => $property)
<div class="rounded-lg p-4 mb-4 space-y-4 bg-gray-50">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <input type="text" class="rounded border p-1"
            placeholder="Tenant Name"
            wire:model="data.income.house_property.rentedProperties.{{ $index }}.tenant_name">

        <input type="number" class="rounded border p-1"
            placeholder="Rental Income"
            wire:model="data.income.house_property.rentedProperties.{{ $index }}.rental_income">

        <input type="text" class="rounded border p-1"
            placeholder="Address of Property"
            wire:model="data.income.house_property.rentedProperties.{{ $index }}.property_address">
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">House Tax / Municipal Tax Receipt</label>
            <div class="w-48">
                <x-file-upload wire:model="data.income.house_property.rentedProperties.{{ $index }}.house_tax_receipt" />
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Interest Certificate</label>
            <div class="w-48">
                <x-file-upload wire:model="data.income.house_property.rentedProperties.{{ $index }}.interest_certificate" />
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <input type="text" class="rounded border p-1"
            placeholder="% Ownership in Property"
            wire:model="data.income.house_property.rentedProperties.{{ $index }}.ownership_percent">

        <input type="number" class="rounded border p-1"
            placeholder="Months of Occupancy"
            wire:model="data.income.house_property.rentedProperties.{{ $index }}.months_occupied">
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
                <h4 class="text-md font-semibold text-gray-700 mb-3">2. Self-Occupied Property</h4>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <input type="text" class="rounded border p-1" placeholder="Address of Property"
                        wire:model="data.income.self.address">
                    <input type="text" class="rounded border p-1" placeholder="% Ownership in Property"
                        wire:model="data.income.self.ownership_percent">
                </div>
                <div class="flex items-center gap-4 mt-4">
                    <span class="text-sm font-medium">
                        Interest Certificate
                    </span>
                    <div class="w-48">
                        <x-file-upload wire:model="data.income.self.interest_certificate" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
