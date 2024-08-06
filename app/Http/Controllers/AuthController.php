<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $app = $request->header('X-App-Identifier');
        $rules = [
            'email' =>'required|email',
            'password' =>'required|string'
        ];
        $validator = Validator::make($request->input(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => False,
                'message' => $validator->errors()->all()
            ]);
        }else{
            $user = User::where('email', $request->email)->where('password',$request->password)->first();
            if (!$user) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }else{
                return response()->json([
                    'status' => True,
                    'message' => "User login successfully",
                    'use_id' => $user->id,
                    'token' => $user->createToken('API TOKEN')->plainTextToken
                ], 200);
            }
        }
    }

    public function register(Request $request)
    {
        $app = $request->header('X-App-Identifier');
        $rules = [
            'name' => 'required|string|min:1|unique:users|max:255',
            'email' =>'required|email|unique:users',
            'password' =>'required|string'
        ];
        $validator = Validator::make($request->input(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => False,
                'message' => $validator->errors()->all()
            ]);
        }else{
            $user = new User($request->input());
            $user->photo = "/users/user.png";
            $user->save();
            return response()->json([
                'status' => True,
                'message' => "User register successfully",
                'use_id' => $user->id,
                'token' => $user->createToken('API TOKEN')->plainTextToken
            ], 200);
        }
    }

    public function show($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
