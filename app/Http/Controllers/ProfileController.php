<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $route = $user->name . '  '.  $user->team->name;
        
        return view('profile.show', compact('user', 'route'));
    }

    public function passwordUpdate(Request $request)
    {
    	$old_pass = $request->get('old_password');
        $pass = $request->get('password');
        $pass_confirm = $request->get('password_confirmation');

        if(Auth::attempt(array('email' => Auth::user()->email, 'password' => $old_pass))){
            if($pass == $pass_confirm){
                $pass = bcrypt($pass);
                $data['password'] = $pass;
                Auth::user()->update($data);
                $request->session()->flash('status', 'Your password has successfuly changed!');
                return redirect()->back()->with('message', 'Uspešno ste promenili šifru.');
            }
            return Redirect::back()->withErrors(['Niste dobro ponovili šifru!']);
        }
        return Redirect::back()->withErrors(['Niste dobro uneli šifru!']);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $user = Auth::user();
        if($file = $request->file('image')) {
            $file_name = time() . $file->getClientOriginalName();
            $file->move(public_path('/images'), $file_name);
            $image = '/images/' . $file_name;
            $input['image'] =  $image;
        }
        $user->update($input);
        
        return redirect('/profile');
    }
}
