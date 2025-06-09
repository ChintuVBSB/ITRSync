@php
    $uploadId = 'file-upload-' . uniqid();
@endphp

<div 
    x-data="{ files: [] }" 
    class="space-y-2 w-full"
>
    <!-- Hidden file input -->
    <input 
        type="file" 
        multiple 
        class="hidden"
        id="{{ $uploadId }}"
        @change="
            let newFiles = Array.from($event.target.files).map(file => ({
                name: file.name,
                size: (file.size / 1024 / 1024).toFixed(2) + 'MB',
                type: file.name.split('.').pop().toUpperCase()
            }));
            files = files.concat(newFiles);
            $event.target.value = null; // Reset input to allow re-uploads
        "
    />

    <!-- Upload button -->
    <label 
        for="{{ $uploadId }}"
        class="inline-flex items-center gap-2 px-3 py-1 bg-white hover:bg-gray-50 text-sm rounded-md cursor-pointer border border-gray-300 shadow-sm"
    >
        📎 Attach Files
    </label>

    <!-- File list -->
    <template x-for="(file, index) in files" :key="index">
        <div class="flex items-center justify-between p-2 rounded-md border bg-gray-50 hover:bg-gray-100">
            <div class="flex items-center gap-2 truncate">
                <div class="w-8 h-8 flex items-center justify-center bg-gray-200 text-gray-600 font-semibold text-xs rounded-full">
                    <span x-text="file.type"></span>
                </div>
                <div class="text-sm truncate">
                    <div class="font-medium truncate max-w-[150px]" x-text="file.name"></div>
                    <div class="text-xs text-gray-500" x-text="file.size"></div>
                </div>
            </div>
            <button @click="files.splice(index, 1)"
                    class="text-red-500 hover:text-red-700 transition text-sm">
                🗑️
            </button>
        </div>
    </template>
</div>
