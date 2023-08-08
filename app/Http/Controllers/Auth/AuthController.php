<?php

namespace App\Http\Controllers\Auth;

use App\Models\City;
use App\Models\Perdin;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'dashboard', 'history', 'city',
        ]);
    }

    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $name = Auth::user()->name;
            $request->session()->regenerate();

            return redirect()->route('dashboard')->withSuccess('Selamat Datang ' . $name . '!');
        }

        return back()->withError('Data Tidak Ditemukan!');

    } 

    public function dashboard()
    {
        if(Auth::check())
        {
            $role = Auth::user()->role;

            if($role == 'admin' && Auth::user()->status) {
                $users = User::where('role', '!=', 'admin')->get();

                return view('dashboard', compact('users'));
            } elseif ($role == 'sdm' && Auth::user()->status ) {
                $today = date('Y-m-d');
                $perdin = Perdin::where('date_from', '>', $today)->where('status', 'pending')->get();

                return view('dashboard', compact('perdin'));
            } else {
                $perdin = Auth::user()->perdin;
                $cities = City::select('id', 'city')->get();
                
                return view('dashboard', compact('perdin', 'cities'));
            }
        }
        
        return redirect()->route('login')->withError('Silahkan Login!');
    }
    
    public function history(Request $request)
    {
        if(Auth::check())
        {
            $role = Auth::user()->role;

            if($role == 'sdm' && Auth::user()->status) {
                $today = date('Y-m-d');
                $perdin = Perdin::where('date_from', '>', $today)->where('status', 'pending')->get();
                $history = Perdin::where('date_from', '<=', $today)->orWhereIn('status', ['approved', 'rejected'])->get();
                
                return view('dashboard', compact('perdin', 'history'));
            }

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->withError('Authorization Failed!');
        }
        
        return redirect()->route('login')->withError('Silahkan Login!');
    } 

    public function city(Request $request)
    {
        if(Auth::check())
        {
            $role = Auth::user()->role;

            if($role == 'sdm' && Auth::user()->status) {
                $cities = City::all();

                return view('dashboard', compact('cities'));
            }

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->withError('Authorization Failed!');
        }
        
        return redirect()->route('login')->withError('Silahkan Login!');
    } 

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->withSuccess('Anda Telah Berhasil Log Out!');;
    }
}
