<x-layout>
    <x-page-heading>Create Job</x-page-heading>
    <x-forms.form method="POST" action="/jobs" enctype="multipart/form-data">
         @csrf
    <x-forms.input name="title" label="Job Title" placeholder="CEO" />
        <div class="grid grid-cols-2 gap-4">
    <x-forms.input 
        name="salary_min" 
        label="Salary (KES)" 
        type="number" 
        placeholder="e.g. 100000"
        value="{{ old('salary_min') }}"
    />

    <x-forms.input 
        name="salary_max" 
        label="Max Salary (optional)" 
        type="number" 
        placeholder="e.g. 150000"
        value="{{ old('salary_max') }}"
    />
</div>

<p class="text-sm text-gray-400 mt-2">
    Leave max salary empty if it's a fixed salary.
</p>
        <x-forms.input name="location" label="Location" placeholder="New York" />

        <x-forms.select name="schedule" label="Schedule">
            <option value="full-time">Full-time</option>
            <option value="part-time">Part-time</option>
            <option value="contract">Contract</option>
        </x-forms.select>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Feature (cost extra)</label>
            <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }} class="rounded border-gray-300">
        </div>

        <x-forms.input name="url" label="URL" placeholder="https://example.com/job" />

        <x-forms.divider />

        <x-forms.input name="tags" label="Tags (comma separated)" placeholder="PHP, Laravel, Developer" />

        <x-forms.button type="submit">Create Job</x-forms.button>
    </x-forms.form>
</x-layout>