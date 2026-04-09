<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pixel positions</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-black font-hanken-grotesk text-white border-b border-white/10 py-10">
<div class="px-10">  
      <nav class="flex justify-between items-center py-4">
        <div>
            <a href="/"><img src="{{ asset('images/logo.svg') }}" alt="Logo"/></a>
        </div>
        <div class="space-x-6 font-bold ">
            <a href="/jobs">Jobs</a>
            <a href="/careers">Careers</a>
            <a href="/salaries">Salaries</a>
            <a href="/companies">Companies</a>
        </div>
    @auth
       <a href="/jobs/create"> Post a Job</a>
       <a href="/profile" class="flex items-center gap-2">
    <x-employer-logo class="rounded-md" :width="38" :employer="auth()->user()->employer" />
   
</a>
         <form method="POST" action="/logout" class="inline">
    @csrf

    <button type="submit" class="flex items-center"  onclick="return confirm('Are you sure you want to logout?')">
        <img src="{{ asset('images/logout1.png') }}" 
             alt="Log out"
             class="w-6 h-6 hover:opacity-70 transition">
    </button>
</form>
    @endauth

    @guest
       <a href="/login"> Login</a>
       <a href="/register"> Register</a>
        
    @endguest
   

    </nav>
 <main class="mt-10 max-w-[986px]: mx-auto"> {{ $slot }}</main> </div>   
</body>
</html>