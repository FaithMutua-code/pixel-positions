@props(['job'])
<x-panel class="flex gap-x-6">
   <div class="">
  <x-employer-logo />
       </div>
       <div class="flex-1 flex flex-col">
          <a href="#" class="self-start text-sm">{{ $job->employer->name }}</a>
            
            <h3 class=" font-bold text-xl mt-3 transition-colors duration-300 group-hover:text-indigo-600"> {{ $job->title ?? 'Job Title' }}</h3>
            <p class="text-sm text-gray-400 mt-auto"> {{ $job->salary ??}}</p>
        </div>
       <div class="mt-6 space-y-6">
                  @foreach ($job->tags as $tag )
                 <x-tag :$tag/>  
            @endforeach
           </div>
      </x-panel>
       
      
         
          
          

         
