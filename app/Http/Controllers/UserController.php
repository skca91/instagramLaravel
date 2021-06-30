<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function config(){
        return view('user.config');
    }

    public function update(Request $request){

        $user = User::find(Auth::user()->id);
        $id = $user->id;

        $validate = $this->validate($request, [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        ]);
        
        $name = $request->input('name');
        $lastname = $request->input('lastname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        $user->name = $name;
        $user->lastname = $lastname;
        $user->nick = $nick;
        $user->email = $email;

        $user->save();
       
        return redirect()->route('config')
                         ->with(['message' => 'User updated']);

    }
}
