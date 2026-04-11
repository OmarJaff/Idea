<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SessionsController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        Session::regenerate();

        $validation = $request->validate([
            'email' => ['required', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($validation)) {
            return redirect('/');
        }

        return back()->withErrors(['email' => 'The provided credentails does not match our records']);
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
