<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;


class RegisterController extends Controller
{
   private UserRepositoryInterface $userRepository;
   public function __construct(UserRepositoryInterface $userRepository)
   {
        $this->userRepository = $userRepository;
   }
    public function register()
    {
        $data['body_class'] = 'register-page';
        return view('sites.auth.register',$data);
    }

    public function store(Request $request)
    {


        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'terms_condition' => 'required'
        ]);

        if(!isset($request->role)) {
         $request->merge([
            'role' => "subscriber",
        ]);
        if(isset($request->terms_condition) && !empty($request->terms_condition) ) {
         $request->merge([
            'terms_condition' => ($request->terms_condition == 'on')?1:0,
        ]);
     }
        $userDetails = $request->except('_token');
       
     }
     $user = $this->userRepository->createUser($userDetails);
        //Session::flash('success','User Created Successfully');

        // $user = User::create(request(['name', 'email', 'password']));

     auth()->login($user);

     return redirect()->to('/');
 }
}
