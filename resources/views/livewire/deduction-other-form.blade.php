<div x-data="{ open: true }" class="bg-white rounded-xl shadow-sm">
    <button @click="open = !open"
        class="w-full flex justify-between items-center px-6 py-3 text-left text-lg font-semibold text-gray-800 hover:bg-gray-50">
        <div class="flex items-center gap-2">
            <span class="text-xl">📂</span>
            Any Other Deduction Document
        </div>
        <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 transition-transform">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <div x-show="open" x-collapse class="px-6 py-4 space-y-4 text-sm text-gray-700">
        <div class="flex items-center justify-between gap-4">
            <span class="font-medium">
                🧾 Upload proof for deductions like EV loan, disability certificate, NPS, etc.
            </span>
            <input 
                type="file" 
                wire:model="document" 
                class="w-48 rounded border" 
                accept="*/*" 
            />
        </div>
        @error('document')
            <p class="text-red-500 text-xs">{{ $message }}</p>
        @enderror

        <div>
            <label class="block text-sm font-medium mb-1">Description (optional)</label>
            <input 
                type="text"
                wire:model="description"
                class="rounded border p-1 w-full sm:w-1/2"
                placeholder="e.g. EV Vehicle Loan interest certificate"
            />
        </div>
        @error('description')
            <p class="text-red-500 text-xs">{{ $message }}</p>
        @enderror

        <button 
            wire:click="save" 
            class="px-4 py-2 bg-blue-600 text-white rounded"
            {{-- 3. Disable until a file is chosen --}}
            @disabled(!$document)
        >
            Save
        </button>

        @if (session()->has('message'))
            <p class="text-green-600 text-sm mt-2">
                {{ session('message') }}
            </p>
        @endif

        {{-- List previous uploads, if any --}}
        @php($uploads = optional($submission->deductionOtherDocument)->other_deduction_documents ?? [])
        @if(count($uploads))
            <div class="mt-4">
                <h4 class="text-sm font-semibold mb-2">Previous uploads:</h4>
                <ul class="list-disc list-inside text-sm space-y-1">
                    @foreach($uploads as $doc)
                        <li>
                            <a href="{{ Storage::url($doc['path']) }}" target="_blank" class="underline">
                                {{ basename($doc['path']) }}
                            </a>
                            @if(!empty($doc['description']))
                                — {{ $doc['description'] }}
                            @endif
                            <span class="text-gray-500 text-xs">({{ $doc['uploaded_at'] }})</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
