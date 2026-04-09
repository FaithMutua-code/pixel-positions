<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
#use Illuminate\Validation\Rules\Password;
#use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisteredUserController extends Controller
{
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $userAttributes=$request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::min(6)],
       ]);
         
       $employerAttributes=$request->validate([
        'employer'=>'required',
          'logo' => ['required', \Illuminate\Validation\Rules\File::types(['jpg','jpeg','png'])->max(1024)],
       ]);

       $user=User::create($userAttributes);

       $logoPath = $request->file('logo')->store('logos', 'public');

       $user->employer()->create([
        'name' => $employerAttributes['employer'],
        'logo' => $logoPath,
       ]);
        Auth::login($user);
       return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
