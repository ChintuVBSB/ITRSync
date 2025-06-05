<div x-data="{ open: false, hasForm16: true }" class="bg-white border border-gray-200 rounded-xl shadow-sm mb-6 overflow-hidden">
    <!-- Accordion Header -->
    <button @click="open = !open" class="w-full px-6 py-4 flex justify-between items-center text-left text-gray-800 font-semibold hover:bg-gray-50 transition">
        <span>Income from Salary</span>
        <svg :class="{'rotate-180': open}" class="h-5 w-5 transform transition-transform text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
        </svg>
    </button>
   
    <!-- Accordion Content -->
    <div x-show="open" x-collapse class="px-6 py-4 border-t border-gray-100 space-y-6 text-sm text-gray-700 bg-white">
        
        <!-- Toggle for Form 16 -->
        <div class="flex items-center space-x-2">
            <input type="checkbox" id="hasForm16" x-model="hasForm16" class="form-checkbox h-4 w-4 text-purple-600 border-gray-300">
            <label for="hasForm16" class="text-sm">I have Form 16</label>
        </div>

        <!-- Form 16 Attachments -->
        <div class="flex flex-wrap gap-4">
            <div x-show="hasForm16" x-transition class="w-1/3 min-w-[200px]">
                <label class="block text-sm font-medium mb-1">Form 16</label>
                <input type="file" class="file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 border rounded w-full" />
            </div>
            <div class="w-1/3 min-w-[200px]">
                <label class="block text-sm font-medium mb-1">Arrears sheet</label>
                <input type="file" class="file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 border rounded w-full" />
            </div>
            <div class="w-1/3 min-w-[200px]">
                <label class="block text-sm font-medium mb-1">Salary slips</label>
                <input type="file" class="file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 border rounded w-full" />
            </div>
        </div>

        <!-- Manual Fields if no Form 16 -->
        <div x-show="!hasForm16" x-transition>
            <label class="block text-sm font-medium mb-1">If no Form 16 (e.g. Pension only)</label>
            <div class="flex flex-wrap gap-4 mt-2">
                <input type="text" placeholder="TAN or PAN of Employer" class="form-input w-1/3 rounded border-gray-300" />
                <input type="text" placeholder="Address of Employer" class="form-input flex-1 rounded border-gray-300" />
                <input type="number" placeholder="Salary Amount" class="form-input w-1/4 rounded border-gray-300" />
            </div>
        </div>

        <!-- HRA Details -->
        <div>
            <label class="block text-sm font-medium mb-1">Details required for claiming HRA</label>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-2">
                <input type="text" placeholder="Rent paid" class="form-input rounded border-gray-300" />
                <input type="text" placeholder="City of residence" class="form-input rounded border-gray-300" />
                <input type="text" placeholder="Landlord name" class="form-input rounded border-gray-300" />
                <input type="text" placeholder="Address of the property" class="form-input rounded border-gray-300" />
            </div>
        </div>
    </div>
</div>

<!-- House Property Section -->
<div x-data="{ rentedProperties: [{ tenant: '', address: '', rent: '', ownership: '', months: '' }] }" class="space-y-6">
    <div x-data="{ open: false }" class="bg-white border rounded-xl shadow-sm">
        <button @click="open = !open" class="w-full px-6 py-4 flex justify-between items-center text-left font-semibold text-gray-800 hover:bg-gray-50">
            <span>Income from House Property</span>
            <svg :class="{'rotate-180': open}" class="h-5 w-5 transform transition-transform text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div x-show="open" x-collapse class="px-6 py-4 space-y-6 bg-white text-sm text-gray-700">
            <!-- Rented Properties -->
            <template x-for="(property, index) in rentedProperties" :key="index">
                <div class="border rounded p-4 space-y-4 bg-gray-50">
                    <h3 class="font-semibold text-gray-800">Rented Property #<span x-text="index + 1"></span></h3>

                    <div class="grid grid-cols-2 gap-4">
                        <input type="text" x-model="property.tenant" placeholder="Tenant Name" class="form-input rounded border-gray-300 w-[40px]" />
                        <input type="text" x-model="property.address" placeholder="Address of Property" class="form-input rounded border-gray-300" />
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <input type="number" x-model="property.rent" placeholder="Rental Income" class="form-input rounded border-gray-300" />
                        <input type="number" x-model="property.ownership" placeholder="Ownership %" class="form-input rounded border-gray-300" />
                        <input type="number" x-model="property.months" placeholder="Months" class="form-input rounded border-gray-300" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Receipts of House/Municipal/Property Tax</label>
                            <input type="file" class="form-input w-full" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Interest Certificate</label>
                            <input type="file" class="form-input w-full" />
                        </div>
                    </div>
                </div>
            </template>

            <button @click="rentedProperties.push({ tenant: '', address: '', rent: '', ownership: '', months: '' })"
                class="text-sm text-purple-600 hover:underline font-medium">
                ➕ Add More Rented Property
            </button>

            <!-- Self Occupied Property -->
            <div class="border-t pt-4">
                <h3 class="font-semibold text-gray-800 mb-4">Self-Occupied Property</h3>
                <input type="text" placeholder="Address of Property" class="form-input rounded border-gray-300 mb-3 w-2/3" />
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Interest Certificate</label>
                    <input type="file" class="form-input w-full" />
                </div>
                <input type="number" placeholder="Percentage of Ownership" class="form-input w-1/4 rounded border-gray-300" />
            </div>
        </div>
    </div>
</div>
