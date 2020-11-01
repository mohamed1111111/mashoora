<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRegister;
use App\Http\Requests\VendorRegister;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\API\BaseController  as BaseController;
use Illuminate\Support\Facades\Password;
use App\ApiCode;
use App\Http\Requests\ResetPasswordRequest;
use App\User;
use Validator;
use Response;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends BaseController
{
    public function customerRegister(CustomerRegister $request){

        $validated=$request->validated();

        $user = User::create(([
            'name'=>$request->get('name')
            , 'email'=>$request->get('email')
            , 'gender'=>$request->get('gender')
            , 'phone_number'=>$request->get('phone_number')
            , 'type'=>'2'
            ,'password'=>bcrypt($request['password'])
            ,'confirm_password'=>bcrypt($request['confirm_password'])

         ]));
        $user->customer()->create($validated);
        $user->save();

        $token=$user->createToken('MyApp')->accessToken;
        return response()->json(['token'=>$token],201);

        }



        public function vendorRegister(VendorRegister $request){

        $validated=$request->validated();

        $user = User::create(([
            'name'=>$request->get('name')
            , 'email'=>$request->get('email')
            , 'gender'=>$request->get('gender')
            , 'phone_number'=>$request->get('phone_number')
            , 'type'=>'3'
            ,'password'=>bcrypt($request['password'])
            ,'confirm_password'=>bcrypt($request['confirm_password'])

         ]));

              $file_extension=$request->profile_image->getClientOriginalExtension();
                $file_name=time().''.rand().'.'.$file_extension;
                $path='images/vendors';
                $request->profile_image->move($path,$file_name);

              $userVendorCreate= $user->vendor()->create($validated);
               $userVendorCreate->profile_image = $file_name;
                $userVendorCreate->save();
                $token=$user->createToken('MyApp')->accessToken;
                 return $this->sendResponse(['token'=>$token],201);
        }

    public function getGoogleUser(){

          $user = Socialite::driver('github')->userFromToken($token);

        }
    public function getSnapchatUser(){

          $user = Socialite::driver('snapchat')->userFromToken($token);

      }
    public function getTwitterUser(){

          $user = Socialite::driver('twitter')->userFromToken($token);

      }

  }
