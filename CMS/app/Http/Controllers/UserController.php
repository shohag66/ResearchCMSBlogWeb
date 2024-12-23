<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all(); 
        return view('users.index', compact('users')); 
    }


    public function create()
    {
        return view('users.create'); 
    }


    public function store(Request $request)
    {
        // Validate the form input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'designation' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'cv_link' => 'nullable|url',
            'website_link' => 'nullable|url',
            'status' => 'required|in:current,life,alumni',
        ]);

        // Handle file upload if there's a profile picture
        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        // Create new user record
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'designation' => $request->designation,
            'description' => $request->description,
            'profile_picture' => $profilePicturePath,
            'cv_link' => $request->cv_link,
            'website_link' => $request->website_link,
            'status' => $request->status,
        ]);

        // Redirect back to users list with success message
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }


    public function edit($id)
    {
        $user = User::findOrFail($id); 
        return view('users.edit', compact('user')); 
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id); 
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'designation' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cv_link' => 'nullable|url',
            'website_link' => 'nullable|url',
            'status' => 'nullable|in:current,life,alumni',
        ]);
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        } else {
            $profilePicturePath = $user->profile_picture;
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'designation' => $request->designation,
            'description' => $request->description,
            'profile_picture' => $profilePicturePath,
            'cv_link' => $request->cv_link,
            'website_link' => $request->website_link,
            'status' => $request->status ?? $user->status,
        ]);
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); 

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
