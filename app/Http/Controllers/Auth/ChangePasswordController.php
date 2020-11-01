<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\User;
use  Auth;
class ChangePasswordController extends Controller
{
  /**
  * Create a new controller instance.
  *
  * @return void
  */
 public function __construct()
 {
     $this->middleware('auth');
 }

 /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Contracts\Support\Renderable
  */
 public function index()
 {
     return view('auth.changePassword');
 }

 /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Contracts\Support\Renderable
  */
 public function store(Request $request)
 {
     $request->validate([
         'current_password' => ['required', new MatchOldPassword],
         'new_password' => ['required'],
         'new_confirm_password' => ['same:new_password'],
     ]);

     User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password),'confirm_password'=> Hash::make($request->new_confirm_password)]);


     Auth::logout();
     return redirect()->route('home');

            }
}
