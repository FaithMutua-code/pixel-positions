<x-layout>
    <x-page-heading>Login</x-page-heading>
    <x-forms.form method="POST" action="/login">
         @csrf
        <x-forms.input name="email" label="Email" type="email" />
        <x-forms.input name="password" label="Password" type="password" />
   
 
        

        <x-forms.button>Login</x-forms.button>

    </x-forms.form>
       <a href="/auth/google" 
   class="flex items-center justify-center gap-2 bg-white text-gray-700 border px-4 py-2 rounded-lg shadow hover:shadow-md transition">

    <img src="https://developers.google.com/identity/images/g-logo.png" class="w-5 h-5">
    <span>Continue with Google</span>
</a>
</x-layout>    