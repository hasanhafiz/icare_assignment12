<?php

namespace App\Http\Controllers\Api\V2;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register( Request $request ) {
        
        $fields = $request->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ]);
        
        $user = User::create( $fields ); 
        
        // now create user token
        // $token = $user->createToken( $request->input('name') );
        
        // Generate a Sanctum token
        // $token = $user->createToken('API Token')->plainTextToken;     
        $token = $user->createToken( $request->input('name') )->plainTextToken;           
        // return response()->json(['token' => $token], 200);        
        return response()->json(['message' => 'User registered successfully.'], 200);        
        
        // return [
        //     'user' => $user,
        //     'token' => $token,
        //     'plainTextToken' => $token->plainTextToken,
        // ];
        
    }
    public function login( Request $request ) {
        $request->validate([
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required'],
        ]);        
        
        // check user exist or not 
        $user = User::where( 'email', '=', $request->input('email') )->first();
        
        if ( ! $user || ! Hash::check( $request->input('password') , $user->password ) ) {
            return [
                'message' => 'The provided credentials are incorrect'
            ];
        }
        
        // regenerate user token
        $token = $user->createToken( $user->name )->plainTextToken;
        return response()->json(['token' => $token], 200);        

        // return [
        //     'user' => $user,
        //     'token' => $token,
        //     'plainTextToken' => $token->plainTextToken,
        // ];
    }
    
    public function logout( Request $request ) {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);        
        // return [
        //     'message' => 'You are logged out.'
        // ];        
    } 
    
    /**
     * Get a User List
     * 
     */
    public function userList() {
        return User::all();
    }
}
