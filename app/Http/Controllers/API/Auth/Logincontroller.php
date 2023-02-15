<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Logincontroller extends Controller
{

    public function register(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        
        $data['password'] = Hash::make($request->password);
        
        $user = User::create($data);
        
        $token = $user->createToken('API Token')->accessToken;
        
        return response()->json(['user'=>$user,
        'token'=>$token
    ]);
       

    }
    public function sigin(Request $request){
                $data = $request->validate([
                    'email' => 'required',
                    'password' => 'required'
                ]);

                if (!auth()->attempt($data)) {
                    return response(['error_message' => 'Incorrect Details.Please try again']);
                }

                $token = auth()->user()->createToken('API Token')->accessToken;

                return response(['user' => auth()->user(), 'token' => $token]);
    }
    public function logout(){
        Auth::user()->token()->revoke();
        return response()->json([
            'msg'=>'logout_Successfuly'
        ]);
    }
}
