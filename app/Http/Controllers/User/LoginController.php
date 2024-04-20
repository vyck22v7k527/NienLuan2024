<?php

namespace App\Http\Controllers\User;
use App\Models\category;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->input('email'))->first();
        if ($user && Hash::check($request->input('password'), $user->password)) {
            Auth::login($user);
            Session::put('user_email', $user->email);
            Session::put('user_username', $user->username);
            Session::put('user_address1', $user->address1);
            Session::put('user_address2', $user->address2);
            Session::put('user_phone', $user->phone);
            return redirect()->to(route("userhome.index"));
        } else {
            return redirect()->to(route("login.index"))->with('error', 'Sai email hoặc mật khẩu');
        }
    }

    public function indexRegister()
    {
        return view('user.register');
    }

    public function register(Request $request)
    {

        if (User::where('email', $request->input('email'))->exists()) {
            return redirect()->back()->withInput()->with('error', 'Email đã được đăng ký, vui lòng chọn email khác');
        }

         User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'phone' => $request->input('phone'),
            'address1' => $request->input('address'),
            'isAdmin' => 0,
        ]);

        return redirect('/');
    }

    public function logout()
    {
        session()->flush();
        Auth::logout();
        return redirect('/');
    }

}
