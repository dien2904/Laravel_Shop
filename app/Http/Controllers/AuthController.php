<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Authrequest; 
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        if(Auth::id() > 0)
        {
            return redirect()->route('auth.dashboard');
        }
        return view('admin.login');
    }

    public function showregister()
    {
        if(Auth::id() > 0)
        {
            return redirect()->route('auth.dashboard');
        }
        return view('admin.register');
    }

    public function login(Authrequest $request) 
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        

        if(Auth::attempt($credentials))
        {
            return redirect()->route('auth.dashboard')->with('success', 'Đăng nhập thành công'); 
        }

        return redirect()->route('auth.signin')->with('error', 'Email hoặc mật khẩu không chính xác');
    }

    public function logout( Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.signin');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // Automatically log in the user after registration
        // auth()->login($user);

        return redirect()->route('home')->with('success', 'Registration successful!');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    
}
