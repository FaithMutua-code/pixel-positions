@props(['job'])
<x-panel class="flex flex-col text-left group h-full">
    <div class="text-sm self-start">
        {{ $job->employer?->name ?? 'No employer' }}
    </div>
    
    <div class="py-8 flex-1">
        <h3 class="mb-4 text-xl font-bold group-hover:text-indigo-600 transition-colors duration-300">
            <a href="{{ route('jobs.show', $job->id) }}" target="_blank">
                {{ $job->title }}
            </a>
        </h3>
        <p class="text-sm text-gray-400 mt-2">
            {{ $job->salary ?? 'Salary not specified' }}
        </p>
    </div>

    <div class="flex justify-between items-center mt-auto">
        <div class="flex gap-2 flex-wrap">
            @forelse ($job->tags as $tag)
                <x-tag size="small" :tag="$tag" />
            @empty
                {{-- No tags --}}
            @endforelse
        </div>

        <x-employer-logo :width="42" :employer="$job->employer" />
    </div>
</x-panel>