<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit',[
            'user'=>Auth::user()
        ]);
    }
    public function update(Request $request){
        $user = Auth::user();
        $request->validate([
            'name'=> 'required',
            'employer_name'=>'required',
              'logo' => ['required', \Illuminate\Validation\Rules\File::types(['jpg','jpeg','png'])->max(1024)],
        ]);

        $user->update([
            'name'=>$request->name,
        ]);

        if ($user->employer) {
            $data =[
                 'name' => $request->employer_name,


            ];
            if($request->hasFile('logo')){
                $path = $request->file('logo')->store('logos', 'public');

                $data['logo']=$path;
            }
            $user->employer()->update($data);
        }

        return redirect()->back()->with('success','Profile updated successfully');
    }
}
