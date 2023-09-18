<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('frontend.users.profile');
    }

    public function updateUserDetails(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'phone' => ['required', 'digits:10'],
            'pin_code' => ['required', 'digits:6'],
            'address' => ['required', 'string', 'max:499'],
        ]);

        $user = User::findOrFail(Auth::user()->id);

        // Update user details
        $user->update([
            'name' => $request->input('username')
        ]);

        // Update or create user details
        $user->userDetail()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'phone' => $request->phone,
                'pin_code' => $request->pin_code,
                'address' => $request->address,
            ]
        );

        return redirect()->back()->with('message', 'User Profile Updated');
    }
}
