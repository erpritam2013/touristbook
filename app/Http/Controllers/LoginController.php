<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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
                if ($request->has('redirect_to')) {   
                    return redirect()->to($request->get('redirect_to'));
                }
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

    public function getLoginStatus(Request $request)
    {
        $data['auth'] = auth()->check();
       //$data['isEditing'] = true;
        // if ($request->has('id') && $request->has('model') && auth()->check()) {
        // $NamespacedModel = 'App\\Models\\'.$request->get('model');
        // $id = $request->get('id');
        // $model_data = $NamespacedModel::find($id);
        // if ($model_data->isEditing()) {
        //   $editor = User::find($model_data->editor_id);
        //   $data['isEditing'] = false;
        //   $data['editor'] = $editor;
        //   $data['user'] = true;
        // }
        // }
        if (!auth()->check()) {
            $data['token'] =csrf_token();
        }
        return response()->json($data);
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
