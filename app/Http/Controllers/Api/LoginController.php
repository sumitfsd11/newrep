<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $fields = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::whereEmail($fields['email'])->first();

        if (! $user || ! Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'wrong credentials',
            ], 401);
        }

        $token = $user->createToken('spa-token')->plainTextToken;

        return response(['message' => 'success', 'user' => $user, 'token' => $token], 200);
    }
}
