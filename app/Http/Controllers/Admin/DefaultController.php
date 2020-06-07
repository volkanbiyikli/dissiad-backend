<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DefaultController extends Controller
{

    public function index()
    {
        return view('admin.index');
    }

    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $request->flash();
        $credientials = $request->only('email', 'password');
        $remember_me = $request->has('remember_me') ? true : false;

        if (Auth::attempt($credientials, $remember_me)) {
            return redirect()->intended(route(('admin.index')));
        } else {
            return back()->with('error', 'E-posta adresi veya parolanız yanlış!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('admin.login'))->with('success', 'Güvenli çıkış yapıldı!');
    }
}
