<x-layout>
    <x-page-heading>Login</x-page-heading>
    <x-forms.form method="POST" action="/login">
         @csrf
        <x-forms.input name="email" label="Email" type="email" />
        <x-forms.input name="password" label="Password" type="password" />
   
 
        

        <x-forms.button>Login</x-forms.button>

    </x-forms.form>
</x-layout>    