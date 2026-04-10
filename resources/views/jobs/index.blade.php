<x-layout>
 <div class="space-y-16">
    <section class="text-center pt-6">
        <h1 class="font-bold text-4xl">Let's Find Your Next Job</h1>
      <x-forms.form action="/search" class="mt-6" >
      <x-forms.input :label="false" name="q" placeholder="Web Developer..." value="{{ request('q') }}" />
      </x-forms.form>
    </section>

      <section class="pt-10">
<x-section-heading>Featured Jobs</x-section-heading>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
     @foreach ($featuredJobs as $job)
        <x-job-card :$job />
     @endforeach
  </div>
    
   </section>

   <section>
    <x-section-heading>Tags</x-section-heading>

    
    <div class="mt-6 space-x-1">
       @foreach ($tags as $tag)
 <x-tag :$tag/>
 <!-- <x-tag :tag="$tag"/> --->
         
       @endforeach
        
    </div>
   </section>
      <section>
    <x-section-heading>Recent Jobs</x-section-heading>
    <div class="mt-6 space-y-6">
      @foreach ($jobs as $job )
         <x-job-card :$job /> 
      @endforeach
        
      
    </div>

   </section>
   
 </div>
</x-layout>