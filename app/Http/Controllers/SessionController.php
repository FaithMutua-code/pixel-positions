<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
class SessionController extends Controller
{
     public function create()
    {
        return view('auth.login');
    }
    public function store(){

    $creds=request()->validate([
        'email' => ['required', 'email'],
        'password' => ['required', ],
    ]);
    if(! Auth::attempt($creds)){
        throw ValidationException::withMessages([
            'email' => 'Invalid credentials',
        ]);
    }
     request()->session()->regenerate();
        return redirect('/');
            
        
    }
    public function destroy(){
        Auth::logout();
        return redirect('/');
            
        
    }
}
