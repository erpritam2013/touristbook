<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request)
    {

        $auth = false;
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials,$request->has('rememberme'))) {
            $request->session()->regenerate();

            // Redirection to Editor or Admin
            if ($request->ajax()) {
                return response()->json([
                    'auth' => true,
                    'intended' => url()->previous()
                ]);
            } else {
                return redirect()->intended('admin');
            }

            
        }

         if ($request->ajax()) {

            return response()->json([ 'email' => 'The provided credentials do not match our records.'],302);
        }else{

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
        }
    }

    public function getLoginStatus()
    {
        return response()->json(['auth' => auth()->check(),'token'=>csrf_token()]);
    }

    public function login()
    {
        $data['body_class'] = 'login-page';
        $data['title'] = 'Login';
        return view('sites.auth.login',$data);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
