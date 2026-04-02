@props(['job'])
<x-layout>
    <div class="max-w-4xl mx-auto py-10">
        <div class="mb-6">
            <a href="/" class="text-indigo-600 hover:text-indigo-800">← Back to jobs</a>
        </div>
        
        <x-panel class="flex flex-col gap-6">
            <div class="flex items-start gap-6">
                <x-employer-logo :width="120" :employer="$job->employer" />
                
                <div class="flex-1">
                    <div class="text-sm text-gray-500">{{ $job->employer?->name ?? 'No employer' }}</div>
                    <h1 class="text-3xl font-bold mt-2">{{ $job->title }}</h1>
                    <p class="text-xl text-gray-600 mt-4">{{ $job->salary }}</p>
                </div>
            </div>
            
            <div class="border-t pt-6">
                <h2 class="text-xl font-semibold mb-4">Job Details</h2>
                <dl class="grid grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm text-gray-500">Location</dt>
                        <dd class="font-medium">{{ $job->location ?? 'Not specified' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Schedule</dt>
                        <dd class="font-medium">{{ $job->schedule ?? 'Not specified' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Application URL</dt>
                        <dd class="font-medium">
                            <a href="{{ $job->url }}" target="_blank" class="text-indigo-600 hover:underline">
                                Apply here →
                            </a>
                        </dd>
                    </div>
                </dl>
            </div>
            
            @if($job->tags->count())
                <div class="border-t pt-6">
                    <h2 class="text-xl font-semibold mb-4">Tags</h2>
                    <div class="flex gap-2 flex-wrap">
                        @foreach($job->tags as $tag)
                            <x-tag :tag="$tag" />
                        @endforeach
                    </div>
                </div>
            @endif
        </x-panel>
        
        {{-- Edit button - only show for job owner --}}
        @auth
            @if(auth()->user()->employer && $job->employer_id === auth()->user()->employer->id)
                <div class="mt-6 flex justify-end">
                    <a href="/jobs/{{ $job->id }}/edit" 
                       class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Edit Job
                    </a>
                </div>
            @endif
        @endauth
    </div>
</x-layout>