<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLogoutController extends Controller
{
    public function logout() {
        Auth::logout();
        return redirect()->to(route("admin.login.index"));
    }
}
