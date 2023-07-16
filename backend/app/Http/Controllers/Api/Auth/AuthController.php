<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\Exceptions\TokenNotFoundException;


class AuthController extends Controller
{
    public function register(AuthRequest $request)
    {
        try {
            $value = $request->input();

            $user           = new User();
            $user->name     = $value['name'];
            $user->email    = $value['email'];
            $user->password = bcrypt($value['password']);
            $user->save();

            return new AuthResource(true, 'Register user success', $user);
        } catch (\Throwable $th) {
            return new AuthResource(false, 'An error occurred while registering user. Please try again later.', []);
        }
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email'    => 'required|string|email',
                'password' => 'required'
            ]);

            $user = User::firstWhere("email", $request->email);

            if (!$user || !Hash::check($request->password, $user->password)) {
                return new AuthResource(true, 'Wrong email or password', []);
            } else {
                $token = $user->createToken("sanctum_token")->plainTextToken;
                $data = [
                    'user' => $user,
                    'token' => $token
                ];
                return new AuthResource(true, 'Login user success', $data);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Throwable $th) {
            return new AuthResource(false, 'An error occurred while login user. Please try again later.', []);
        }
    }

    public function logout()
    {
        try {
            auth()->user()->tokens()->delete();
            return new AuthResource(true, 'Logout user success', []);
        } catch (\Throwable $th) {
            return new AuthResource(false, 'An error occurred while logout user. Please try again later.', []);
        }
    }
}
