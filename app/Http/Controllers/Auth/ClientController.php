<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();
            //Etracting validated user detail from custom request
            $data = $request->validated();

            //Creating user using static method
            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);

            //Generate t$oken for the user created
            $token = $user->createToken('user_token')->plainTextToken;
            DB::commit();
            return response()->json(['message' => "Account created successfully", "user" => $user, 'token' => $token], 201);
        } catch (Exception $error) {
            DB::rollBack();
            return response()->json([
                'error' => "something went wrong in UserController.register",
                'message' => $error->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {

        try {

            $user = User::where('email', $request->input('email'))->first();

            if ($user && Hash::check($request->input('password'), $user->password)) {
                //Delete all user old tokens
                $user->tokens()->delete();
                //Creating new user token
                $token = $user->createToken('user_token')->plainTextToken;

                return response()->json(['message' => "Logged in successfully", 'user'=>$user,  'token' => $token], 200);
            } else {
                return response()->json(['error' => 'Invalid Credentials'], 401);
            }
        } catch (\Exception $e) {
            //throw $th;
            return response()->json([
                "error" => $e->getMessage(),
                'message' => 'server error'
            ], 500);
        }
    }


    public function logout(string $userId)
    {
        $user = User::findOrFail($userId);
        $user->tokens()->delete();
        return response()->json(['message' => "Logged out successfully"], 200);
    }
}
