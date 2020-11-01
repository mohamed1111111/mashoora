<?php

namespace App\Http\Controllers\API;
use App\Http\Requests\LoginRequest;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public  function username(){
      $login = request()->input('username');

              $field = 'phone_number';
          if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
              $field = 'email';
          }
          return $field;
            }
    public function login(LoginRequest $request){
      $field=  $this->username();

      $credentials = [$field => $request->username, 'password'=>$request->password];

      if (Auth::attempt($credentials)){
        $token = auth()->user()->createToken('TutsForWeb')->accessToken;
        return response()->json(['token' => $token], 200);
      }

}
}
