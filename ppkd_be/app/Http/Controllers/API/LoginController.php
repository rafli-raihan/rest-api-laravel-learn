<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class LoginController extends Controller
{
    //
    public function login(Request $request)
    {
        try {
            //code...
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:8'
            ]);

            if ($validator->fails()) {
                # code...
                return response()->json([
                    'message' => 'Verification fail',
                    'errors' => $validator->errors()
                ], 422);
            }
            $credentials = $request->only('email', 'password');
            if (!Auth::attempt($credentials)) {
                return response()->json([
                    "status" => false,
                    "message" => "Invalid credentials"
                ], 401);
            }

            $user = Auth::user();
            $token = $user->createToken('api-token')->plainTextToken;
            return response()->json([
                "status" => true,
                "message" => "Login Success",
                "token" => $token,
                "user" => $user,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                "status" => false,
                "message" => $th->getMessage(),
            ], 500);
        }
    }

    public function me()
    {
        return response()->json([
            'user' => auth('sanctum')->user(),
        ]);
    }
}
