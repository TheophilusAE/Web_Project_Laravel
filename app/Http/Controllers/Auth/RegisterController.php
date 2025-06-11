<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:UMKM Owner'],
            'business_name' => ['required_if:role,UMKM Owner', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20'],
            'profile_picture' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile-pictures', 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'business_name' => $request->business_name,
            'phone_number' => $request->phone_number,
            'profile_picture' => $profilePicturePath,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }

    protected function registered(Request $request, $user)
    {
        return redirect()->route('login');
    }
} 