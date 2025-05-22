<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Login;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Session;

// class LoginController extends Controller
// {
//     public function showForm()
//     {
//         return view('beranda');
//     }

//     public function login(Request $request)
//     {
//         $user = Login::where('email', $request->email)->first();

//         if ($user && Hash::check($request->password, $user->password)) {
//             // Simpan data ke session
//             Session::put('user', $user);

//             return redirect('/beranda');
//         }

//         return back()->with('error', 'Email atau password salah');
//     }

//     public function logout()
//     {
//         Session::forget('user');
//         return redirect('/login');
//     }
// }
