<x-layout>
    <x-page-heading>Search Results</x-page-heading>

    <x-forms.form action="/search" class="mt-6">
        <x-forms.input :label="false" name="q" placeholder="Web Developer..." value="{{ request('q') }}" />
    </x-forms.form>

     <div class=" space-y-6 mt-8">
      @foreach ($jobs as $job )
         <x-job-card :$job /> 
      @endforeach
    </div>
</x-layout>