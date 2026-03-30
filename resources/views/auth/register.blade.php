<x-layout>
    <x-page-heading>Register</x-page-heading>
    <x-forms.form method="POST" action="/register" enctype="multipart/form-data">
         @csrf
        <x-forms.input name="name" label="Name" />
        <x-forms.input name="email" label="Email" type="email" />
        <x-forms.input name="password" label="Password" type="password" />
        <x-forms.input name="password_confirmation" label="Confirm Password" type="password" />
 
        <x.forms.divider />
        <x-forms.input name="employer" label="Employer Name" />
        <x-forms.input name="logo" type="file" label="Employer Logo" />

        <x-forms.button>Register</x-forms.button>

    </x-forms.form>
</x-layout>    