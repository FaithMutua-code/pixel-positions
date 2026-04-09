@props(['job'])

<x-layout>
    {{-- Background feel --}}
    <div class="min-h-screen  from-white to-gray-50">

        <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

            {{-- Back link --}}
            <div class="mb-8">
                <a href="/" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 transition">
                    ← Back to jobs
                </a>
            </div>

            {{-- Glass Card --}}
            <x-panel class="p-8 flex flex-col gap-8
                bg-white/70 backdrop-blur-md
                border border-gray-200/60
                shadow-lg rounded-2xl">

                {{-- Header --}}
                <div class="flex flex-col sm:flex-row sm:items-start gap-6">

                    <div class="shrink-0">
                        <x-employer-logo :width="90" :employer="$job->employer" class=" rounded-md" />
                    </div>

                    <div class="flex-1">
                        <p class="text-sm text-gray-500">
                            {{ $job->employer?->name ?? 'No employer' }}
                        </p>

                        <h1 class="text-3xl font-bold leading-tight mt-1">
                            {{ $job->title }}
                        </h1>

                        <p class="text-xl text-gray-600 mt-3 font-medium">
                          ksh  {{ $job->salary }}
                        </p>
                    </div>
                </div>

                {{-- Details --}}
                <div class="border-t pt-6">

                    <h2 class="text-xl font-semibold mb-5">
                        Job Details
                    </h2>

                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                        <div class="space-y-1">
                            <dt class="text-sm text-gray-100">Location</dt>
                            <dd class="font-medium text-gray-400">
                                {{ $job->location ?? 'Not specified' }}
                            </dd>
                        </div>

                        <div class="space-y-1">
                            <dt class="text-sm text-gray-100">Schedule</dt>
                            <dd class="font-medium text-gray-400">
                                {{ $job->schedule ?? 'Not specified' }}
                            </dd>
                        </div>

                    </dl>
                </div>

                {{-- Tags --}}
                @if($job->tags->count())
                    <div class="border-t pt-6">
                        <h2 class="text-xl font-semibold mb-4">Tags</h2>

                        <div class="flex flex-wrap gap-2">
                            @foreach($job->tags as $tag)
                                <x-tag :tag="$tag" />
                            @endforeach
                        </div>
                    </div>
                @endif

            </x-panel>

            {{-- Sticky Apply Button --}}
            <div class="fixed bottom-6 right-6">
                <a href="{{ $job->url }}" target="_blank"
                   class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-full shadow-lg hover:bg-indigo-700 transition">
                    Apply Now →
                </a>
            </div>

            {{-- Edit button --}}
            @auth
                @if(auth()->user()->employer && $job->employer_id === auth()->user()->employer->id)
                    <div class="mt-6 flex justify-end">
                        <a href="/jobs/{{ $job->id }}/edit"
                           class="inline-flex items-center px-5 py-2 bg-indigo-600 border border-transparent rounded-md text-xs font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                            Edit Job
                        </a>
                    </div>
                @endif
            @endauth

        </div>
    </div>
</x-layout>