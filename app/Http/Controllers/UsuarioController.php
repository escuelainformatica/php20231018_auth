<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UsuarioController extends Controller
{
    public function index(Request $request) 
    {
        return view('welcome');
    }
    public function todos(Request $request) 
    {
        return view('todos');
    }
    public function loginGet(Request $request) {
        var_dump(Auth::user());
        return view("formulariologin");
    }
    public function loginPost(Request $request) {
        $arreglo=['email'=>$request->post('email'),'password'=>$request->post('password')];
        if (Auth::guard('web')->attempt($arreglo)) {
            $request->session()->regenerate(); // guardando la autenticacion.
            return redirect()->intended('/');
        }
        return view("formulariologin");
    }
    public function loginAdminPost(Request $request) {
        $arreglo=['email'=>$request->post('email'),'password'=>$request->post('password')];
        if (Auth::guard('admin')->attempt($arreglo)) {
            $request->session()->regenerate(); // guardando la autenticacion.
            return redirect()->intended('/');
        }
        return view("formulariologin");
    }
    public function logout(Request $request) {
        Auth::logout();
        Session::flush();
        return redirect()->intended('/login');
    }
}
