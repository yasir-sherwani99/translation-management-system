<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Services\UserService;
use App\Http\Requests\UserStoreRequest;

class AuthController extends Controller
{
    protected $user;

    public function __construct(UserService $userService)
    {
        $this->user = $userService;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function register(UserStoreRequest $request)
    {
        $data = [];

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        $userr = $this->user->store($data);

        // authenticate user
        Auth::attempt($request->only('email', 'password'));
        $token = $userr->createToken('translationToken')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Well-done! You are loggedin successfully',
            'accessToken' => $token
        ], 200);
    }

    /**
     * Authenticate user
     *
     * @param  array  $data
     * @return [string] token
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|string|exists:users,email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

         // attempt to log the user in using email and password
        if(Auth::attempt($request->only('email', 'password'))) 
        {
            $userr = $this->user->getUserByEmail($request->email);
            $token = $userr->createToken('translationToken')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Well-done! You are loggedin successfully',
                'accessToken' => $token,
                'user' => $userr
            ], 200);
        } else {
             // if authentication fails, add a custom validation error
            $validator->errors()->add('credentials', 'Invalid login credentials.');

            // return the validation error with the custom message
            return response()->json(['errors' => $validator->errors()], 422);
        }
    }

    /**
     * Logout user (revoke the token).
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        auth('sanctum')->user()->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'You are logged out successfully'
        ], 200);
    }
}
