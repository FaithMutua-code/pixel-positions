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
            <a href="#">Jobs</a>
            <a href="#">Careers</a>
            <a href="#">Salaries</a>
             <a href="#">Companies</a>

        </div>
    @auth
       <a href="/jobs/create"> Post a Job</a>
         <form method="POST" action="/logout" class="inline">
          @csrf
          @method('DELETE')
          <button type="submit"> Logout</button>
        
    @endauth

    @guest
       <a href="/login"> Login</a>
       <a href="/register"> Register</a>
        
    @endguest
   

    </nav>
 <main class="mt-10 max-w-[986px]: mx-auto"> {{ $slot }}</main> </div>   
</body>
</html>