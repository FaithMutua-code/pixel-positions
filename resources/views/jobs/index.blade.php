<x-layout>
 <div class="space-y-16">
    <section class="text-center pt-6">
        <h1 class="font-bold text-4xl">Let's Find Your Next Job</h1>
        <form action="" method="get" class="mt-6">
            <input type="text" name="" id="" placeholder="Wed Developer..." class="bg-white/5 placeholder:text-white/50 border border-white/10 px-5 py-4 w-full max-w-xl rounded-xl"    >
        </form>
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