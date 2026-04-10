<x-layout>
    <x-page-heading>Update Job</x-page-heading>
    
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
   <form method="POST" action="{{ route('jobs.update', $job->id) }}">
       @csrf
       @method('PUT')
       
        
        <x-forms.input name="title" label="Job Title" placeholder="CEO" value="{{ old('title', $job->title) }}"/>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-forms.input name="salary_min" label="Min Salary (KES)" type="number" value="{{ old('salary_min', $job->salary_min) }}" />
            <x-forms.input name="salary_max" label="Max Salary (KES)" type="number" value="{{ old('salary_max', $job->salary_max) }}" />
        </div>
        <x-forms.input name="location" label="Location" placeholder="New York" value="{{ old('location', $job->location) }}"/>

        <x-forms.select name="schedule" label="Schedule">
            <option value="full-time" {{ old('schedule', $job->schedule) == 'full-time' ? 'selected' : '' }}>Full-time</option>
            <option value="part-time" {{ old('schedule', $job->schedule) == 'part-time' ? 'selected' : '' }}>Part-time</option>
            <option value="contract" {{ old('schedule', $job->schedule) == 'contract' ? 'selected' : '' }}>Contract</option>
        </x-forms.select>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Feature (cost extra)</label>
            <input type="checkbox" name="featured" value="1" {{ old('featured', $job->featured) ? 'checked' : '' }} class="rounded border-gray-300">
            @error('featured')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <x-forms.input name="url" label="URL" placeholder="https://example.com/job" value="{{ old('url', $job->url) }}" />

        <x-forms.divider />

        <x-forms.input name="tags" value="{{ old('tags', $job->tags->pluck('name')->join(', ')) }}" label="Tags (comma separated)" placeholder="PHP, Laravel, Developer" />

        <x-forms.button type="submit">Update Job</x-forms.button>
    </form>

    <div class="pt-4">
    <form method="POST" action="/jobs/{{ $job->id }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600" 
                onclick="return confirm('Are you sure you want to delete this job?')">
            Delete Job
        </button>
    </form>
</div>
</x-layout>