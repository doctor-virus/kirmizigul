<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function index()
    {
        return view('pages.profile');
    }
    function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|max:255',
        ]);
        $data = auth()->user();
        if (isset($data)) {
            if (Hash::check($request->password, $data->password)) {
                $data->name = $request->name;
                $data->email = $request->email;
                $data->save();
                // session()->put('user', $data->id);
                return  back()->withSuccess('Updated User');
            } else {
                return redirect()->back()->withErrors('Incorrect password');
            }
        }
    }
    function password(Request $request)
    {
        $validated = $request->validate([
            'old_password' => 'required|max:255|min:6',
            'new_password' => 'required|max:255|min:6|different:old_password',
            'confirm_password' => 'same:new_password',
        ]);
        $data = auth()->user();
        if (isset($data)) {
            if (Hash::check($request->old_password, $data->password)) {
                $data->password = Hash::make($request->new_password);
                $data->save();
                // session()->put('user', $data->id);
                return  back()->withSuccess('Password updated');
            } else {
                return redirect()->back()->withErrors('Incorrect password');
            }
        }
    }
}
