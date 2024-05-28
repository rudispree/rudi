<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function proseslogin(Request $request)
    {
        //echo "teslogin";

       // untuk membuat password jadi Hash
        // $pass = 123;
        // echo Hash::make($pass);
        if (Auth::guard('karyawan')->attempt(['nik' => $request->nik, 'password' => $request->password])) {
            //echo "Berhasil Login";
            return redirect('/dashboard');
        } else {
            // echo "Gagal Login";
            return redirect('/')->with(['warning' => 'Nik/Password Salah']);
        }
    }

    public function proseslogout() {
        if (Auth::guard('karyawan')->check()) {
            Auth::guard('karyawan')->logout();
            return redirect('/');
        }
        
    }


    // login admin
    public function prosesloginadmin(Request $request)
    {
       
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            //echo "Berhasil Login";
            return redirect('/panel/dashboardadmin');
        } else {
            // echo "Gagal Login";
            return redirect('/panel')->with(['warning' => 'Username atau Password Salah']);
        }
    }

    public function proseslogoutadmin() {
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
            return redirect('/panel');
        }
        
    }
}
