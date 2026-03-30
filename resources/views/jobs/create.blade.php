<x-layout>
    <x-page-heading>Create Job</x-page-heading>
    <x-forms.form method="POST" action="/jobs" enctype="multipart/form-data">
         @csrf
        <x-forms.input name="title" label="Job Title"  placeholder="CEO"/>
        <x-forms.input name="salary" label="Salary" placeholder="CEO" />
        <x-forms.input name="Location" label="Location" placeholder="New York" />

        <x-forms.select label="schedule" name="schedule">
            <option value="full-time">Full-time</option>
            <option value="part-time">Part-time</option>
            <option value="contract">Contract</option>
        </x-forms.select>
        <x-forms.checkbox name="featured" label="Feature(Cost Extra)" />
        <x-forms.input name="URL" label="URL" placeholder="https://example.com/job" />
        <x-forms.divider />
        <x-forms.input name="tags" label="Tags (comma separated)" placeholder="PHP, Laravel, Developer" />
        <x-forms.button type="submit">Create Job</x-forms.button>
    </x-forms.form>
</x-layout>