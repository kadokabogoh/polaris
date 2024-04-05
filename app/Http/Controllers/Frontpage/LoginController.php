<?php

namespace App\Http\Controllers\Frontpage;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('frontpage.login.index');
    }

    public function doLogin(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $user = User::where('username', $credentials['username'])->first();
        $valid = false;
        if ($user)
        {
            $credentials['email'] = $user->email;
            unset($credentials['username']);
            if (Auth::attempt($credentials))
            {
                $valid = true;
            }
        }
        if ($valid)
        {
            return redirect()->route('secure.home.index');
        } else
        {
            return redirect()->route('frontpage.login.index');
        }
    }
}
