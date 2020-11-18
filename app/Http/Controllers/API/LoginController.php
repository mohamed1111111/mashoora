<?php

namespace App\Http\Controllers\API;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\User as UserResource;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\User;
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
        if(auth()->user()->type == 1){
          $user_id = auth()->user()->id;
          $user = User::where('id',$user_id)->with('admin')->get();
        }
        if(auth()->user()->type == 2){
          $user_id = auth()->user()->id;
          $user = new UserResource(User::where('id',$user_id)->with('customer')->first());
        }
        if(auth()->user()->type == 3){
          $user_id = auth()->user()->id;
          $user = new UserResource(User::where('id',$user_id)->with('vendor')->first());
        }

        return response()->json(['status'=>'done','token' => $token,'user'=>new UserResource($user)], 200);
      }
      return response()->json(['status'=>'Credentials does not match'], 404);

}
}
