<?php

namespace App\Http\Controllers;

use App\Common\Constants;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function index()
    {
        if (auth()->check()) {
            return redirect()->to(route("admin.login.index"));
        }
        return view("admin.login.index");
    }


    public function post(Request $request)
    {

        $request->validate([
            'email'    => 'required|email', // Added email validation
            'password' => 'required|min:8', // Added minimum length validation for password
        ], [
            'email.required'    => Constants::txt_input_required,
            'email.email'       => Constants::txt_invalid_email, // Customize the error message for email format
            'password.required' => Constants::txt_input_required,
            'password.min'      => Constants::txt_password_min_length, // Customize the error message for minimum length
        ]);

        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return redirect()->to(route("admin.home.index"));
        } else {
            return redirect()->to(route("admin.login.index"))->with("error_user", "Email và mật khẩu chưa chính xác");
        }
    }
}
