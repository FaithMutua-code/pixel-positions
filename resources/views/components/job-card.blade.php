<x-panel class="flex flex-col text-center group h-full">
        
    <div class="text-left">Fai</div>

    <div class="py-8 flex-1">
        <h3 class="mb-4 text-xl font-bold group-hover:text-indigo-600 transition-colors duration-300">
            title
        </h3>
        <p class="text-sm text-gray-400 mt-2">
            description
        </p>
    </div>

    <div class="flex justify-between items-center mt-auto">
        <div class="flex gap-2 flex-wrap">
            <x-tag size="small">Backend</x-tag>
            <x-tag size="small">Frontend</x-tag>
            <x-tag size="small">Manager</x-tag>
        </div>

        <x-employer-logo :width="42" />
    </div>

</x-panel>