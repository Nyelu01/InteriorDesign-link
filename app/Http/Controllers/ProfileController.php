<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function purchase(){
        return view('designer.pages.purchase');
    }


    public function editVendor()
    {
        $user = Auth::user();
        return view('vendor.pages.profile', compact('user'));
    }

    public function vendorUpdate(RegisterRequest $request, User $user)
    {
        try {
            // Handle the file upload
            if ($request->hasFile('business_licence')) {
                $fileName = 'business_licence_' . time() . '.' . $request->file('business_licence')->extension();
                $request->file('business_licence')->storeAs('public/img/licence', $fileName);

                // Delete the old business licence if it exists
                if ($user->business_licence) {
                    Storage::delete('public/img/licence/' . $user->business_licence);
                }
            } else {
                $fileName = $user->business_licence;
            }

            // Prepare the user data
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'location' => $request->location,
                'business_licence' => $fileName,
            ];

            // Update the password only if provided
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            // Update the user
            $user->update($userData);

            // Redirect back with a success message
            return redirect()->route('vendor.profile')->with(['message' => 'Profile updated successfully!', 'status' => 'success']);
        } catch (\Exception $e) {
            Log::error('Error updating profile: ' . $e->getMessage());
            return back()->with(['message' => 'Failed to update profile. Please try again later.', 'status' => 'error']);
        }
    }
}
