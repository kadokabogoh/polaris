<?php

namespace App\Http\Controllers\Secure;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('secure.home.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('frontpage.login.index');
    }
}
