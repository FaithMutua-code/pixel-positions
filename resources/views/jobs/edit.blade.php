<x-layout>
    <x-page-heading>Update Job</x-page-heading>
    <x-forms.form method="POST" action="/jobs/{{ $job->id }}" enctype="multipart/form-data">

         @csrf
         @method('PUT')
        <x-forms.input name="title" label="Job Title" placeholder="CEO" value="{{ $job->title }}"/>
        <x-forms.input name="salary" label="Salary" placeholder="$120k"value="{{ $job->salary }}" />
        <x-forms.input name="location" label="Location" placeholder="New York" value="{{ $job->location }}"/>

        <x-forms.select name="schedule" label="Schedule">
            <option value="full-time">Full-time</option>
            <option value="part-time">Part-time</option>
            <option value="contract">Contract</option>
        </x-forms.select>

        <x-forms.checkbox name="featured" label="Feature (cost extra)" />

        <x-forms.input name="url" label="URL" placeholder="https://example.com/job" />

        <x-forms.divider />

        <x-forms.input name="tags" value="{{ $job->tags }}" label="Tags (comma separated)" value="{{ $job->url }}" placeholder="PHP, Laravel, Developer" />

        <x-forms.button type="submit">Update Job</x-forms.button>
    </x-forms.form>

    <form method="POST" id="delete-form" action="/jobs/{{ $job->id }}" class="hidden pt-4">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete Job</button>


           
        </form>
</x-layout>