<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function index()
    {
        return view('Home.home');
    }

    public function login()
    {
        return view('Auth.login');
    }

    public function register_designer()
    {
        return view('Auth.designer_register');
    }

    public function register_vendor()
    {
        return view('Auth.vendor_register');
    }

    public function designerRegister(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();

            $file = $request->file('certificate');
            $fileName = 'certificate_' . time() . '.' . $file->extension();
            $file->move(public_path('assets/img/certificate'), $fileName);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'location' => $request->location,
                'service_type' => $request->service_type,
                'project_type' => $request->project_type,
                'certificate' => $fileName,
                'role' => $request->role, // Ensure role is being set correctly
            ]);

            // Generate token for the user created
            $token = $user->createToken('user_token')->plainTextToken;

            Auth::login($user);

            DB::commit();

            // Redirect the user to the dashboard
            return redirect()->route('projects.index')->with('success', 'Account created successfully');
        } catch (Exception $error) {
            DB::rollBack();
            return response()->json([
                'error' => "something went wrong in AuthController.designerRegister",
                'message' => $error->getMessage()
            ], 500);
        }
    }


    public function vendorRegister(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();

            $file = $request->file('business_licence');
            $fileName = 'business_licence_' . time() . '.' . $file->extension();
            $file->move(public_path('assets/img/license'), $fileName);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'location' => $request->location,
                'business_licence' => $fileName,
                'role' => $request->role,

            ]);
            //Generate t$oken for the user created
            $token = $user->createToken('user_token')->plainTextToken;

            // Log the user in
            Auth::login($user);

            DB::commit();

            // Redirect the user to the dashboard
            return redirect()->route('product.index')->with('success', 'Account created successfully');
            //     return response()->json(['message' => "Account created successfully", "user" => $user, 'token' => $token], 201);
        } catch (Exception $error) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $error->getMessage());

            //     return response()->json([
            //         'error' => "something went wrong in AuthController.designerRegister",
            //         'message' => $error->getMessage()
            //     ], 500);
            // }
        }
    }

    

    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function userlogin(LoginRequest $request)
    {
        $user = $request->validated();
        $user = User::where('email', $request->input('email'))->first();

        if ($user && Hash::check($request->input('password'), $user->password)) {

            // delete old user token
            $user->tokens()->delete();

            // creating new token
            $token = $user->createToken('user_token')->plainTextToken;

            // log in the user
            Auth::login($user);

            if (auth()->user()->role == 'designer') {
                return redirect()->route('projects.index')->with('success', 'Logged in successfully');
            } else if (auth()->user()->role == 'vendor') {
                return redirect()->route('product.index')->with('success', 'Logged in successfully');
            }
        }

        return redirect()->route('auth.login')->withErrors(['email' => 'No matching user found with the provided email or password']);
    }



    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete(); // Deletes all tokens for the user

        Auth::logout(); // Logs out the user


        //return response()->json(['message' => "Logged out successfully"], 200);
        return redirect('/login/form')->with('success', 'Logged out successfully'); // Redirect to login page
    }
}
