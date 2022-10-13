<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
    public function register(Request $request){
    	$validate = validator::make($request->all(),[
    		'name' => 'required',
    		'email' => 'required|email',
    		'password' => 'required',
    	]);

    	if($validate->fails()){
    		return response()->json([
    			'errors'=>$validate->errors()
    		], 401);
    	}

    	$user = User::create([
    		'name' => $request->name,
    		'email' => $request->email,
    		'password' => Hash::make($request->password)
    	]);

    	return response()->json([
    		'user'=> $user,
    		'token' => $user->createToken("API TOKEN")->plainTextToken
    	], 200);


    }


    public function login(Request $request){
    	$validate = validator::make($request->all(),[
    		'email' => 'required|email|exists:users',
    		'password' => 'required',
    	]);

    	if($validate->fails()){
    		return response()->json([
    			'errors'=>$validate->errors()
    		]);
    	}

    	$req = request()->only('email', 'password');
    	if(Auth::attempt($req)){
			$user = Auth::user();

			return response()->json([
    			'user'=> $user,
    			'token' => $user->createToken("API TOKEN")->plainTextToken
    		]);
    	}
    	else{
    		return response()->json([
    			'errors'=>'Eamil atau Password Salah'
    		]);	
    	}

    	// return $request->all();
    }
}
