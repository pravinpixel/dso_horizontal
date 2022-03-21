<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Activations\EloquentActivation;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        if(Sentinel::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }
    
    public function login(Request $request)
    {
       
        $credentials = [
            'email'     => $request->user_login_id,
            'password'  => config('auth.password'),
        ];
        
        Sentinel::authenticate($credentials);
        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Sentinel::logout();
        return redirect()->back();
    }

    public function registerIndex(Request $request)
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $credentials = [
            'email'     => $request->user_login_id,
            'password'  => config('auth.password'),
        ];
        $user = Sentinel::registerAndActivate($credentials);
        return redirect()->back();
    }
}