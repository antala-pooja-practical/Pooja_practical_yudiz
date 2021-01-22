<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class UserController  extends Controller
{
    public $moduleName = 'user';

    public function __construct()
    {
    }
    public function loginView(Request $request)
    {
        return view('admin.login');
    }
    
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('admin/login')
                        ->withErrors($validator)
                        ->withInput();
        }
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            $user = Auth::getLastAttempted();
        if ($user->is_admin == 0) {
            return back()->withErrors(['message'=>'Incorrect login credentials.'])
                        ->withInput();
        }else{
            return redirect()->to('/admin/dashboard');
        }
        }else{
            return back()->withErrors(['message'=>'Your email and password is incorrect,Please try again!'])
                        ->withInput();
        }
    }
    public function logout() {
        auth()->logout();
        return redirect()->to('/admin/login');
    }
    
    
}
