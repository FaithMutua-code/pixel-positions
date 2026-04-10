<x-layout>
    <x-page-heading>Search jobs with salary ranges</x-page-heading>

    <x-forms.form action="/salaries" class="mt-6">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <x-forms.input name="salary_min" label="Min Salary (KES)" type="number" value="{{ request('salary_min') }}" />
            <x-forms.input name="salary_max" label="Max Salary (KES)" type="number" value="{{ request('salary_max') }}" />
        </div>
        <x-forms.button type="submit"> Search</x-forms.button>
    </x-forms.form>

     <div class=" space-y-6 mt-8">
      @foreach ($jobs as $job )
         <x-job-card :$job /> 
      @endforeach
    </div>
</x-layout>