@props(['job' => null])
<x-panel class="flex flex-col text-left group h-full">
       <div class="text-left">{{ $job->employer->name }}</div>
    <div class="py-8 flex-1">
        <h3 class="mb-4 text-xl font-bold group-hover:text-indigo-600 transition-colors duration-300">
            {{ $job->title ?? 'Job Title' }}
        </h3>
        <p class="text-sm text-gray-400 mt-2">
             {{ $job->salary ?? 'Salary not specified' }}
        </p>
    </div>

    <div class="flex justify-between items-center mt-auto">
        <div class="flex gap-2 flex-wrap">
            @foreach ($job?->tags ?? [] as $tag)
                <x-tag size="small" :tag="$tag" />
            @endforeach
        </div>

        <x-employer-logo :width="42" :employer="$job?->employer" />
    </div>
</x-panel>