<x-layout>
    <x-page-heading>My Profile</x-page-heading>

    @if(session('success'))
        <p class="text-green-500">{{ session('success') }}</p>
    @endif

    <form method="POST" action="/profile" class="space-y-4" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div>
             <x-forms.input name="name" label="Name" value="{{ old('name', $user->name) }}"/>
        </div>

        <div>
          
             <x-forms.input name="email" label="Email" value="{{ old('email', $user->email) }}" disabled/>
        </div>

        <div>
                <x-forms.input name="employer_name" label="Employer Name" value="{{ old('employer_name', $user->employer ? $user->employer->name : '') }}"/>
        </div>

        @if($user->employer && $user->employer->logo)
    <div class="mb-2">
        <p class="text-sm text-gray-400">Current Logo:</p>
       <x-employer-logo :width="200" :employer="$user->employer"  class="rounded-sm " />
    </div>
@endif

<x-forms.input 
    name="logo" 
    type="file" 
    label="Change Employer Logo"
/>

          <x-forms.button type="submit">Update Profile</x-forms.button>
    </form>
</x-layout>