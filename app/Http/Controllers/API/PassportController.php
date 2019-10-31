<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiResponse;
use App\Http\Requests\RegisterUserRequest;
use App\Profile;
use App\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\UserRegistered;
use App\Role;
use App\User;

class PassportController extends Controller
{
    /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterUserRequest $request)
    {
        try {
            $user = User::create([
                'name'     => $request->input('name'),
                'email'    => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);

            $userRole = Role::where('name', 'user')
                ->first();

            event(new UserRegistered($user, $userRole));

            $token = $user->createToken('TutsForWeb')->accessToken;
            $profile = Profile::where('user_id', $user->id)
                ->first();

            return ApiResponse::success(compact('token', 'user', 'profile'));
        } catch (\Exception $e) {
            return ApiResponse::fail(500, $e->getMessage());
        }

    }

    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {
            $credentials = [
                'email'    => $request->input('email'),
                'password' => $request->input('password')
            ];

            if (auth()->attempt($credentials)) {
                $user = auth()->user();
                $token = $user->createToken('TutsForWeb')->accessToken;
                $profile = Profile::where('user_id', $user->id)
                    ->first();
                return ApiResponse::success(compact('token', 'user', 'profile'));
            } else {
                return ApiResponse::fail(401);
            }
        } catch (\Exception $e) {
            return ApiResponse::fail(500, $e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->token()->revoke();
            return ApiResponse::success();
        } catch (\Exception $e) {
            return ApiResponse::fail(500, $e->getMessage());
        }
    }

    /**
     * Returns Authenticated User Details
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function details()
    {
        try {
            $universities = University::all();
            $user = auth()->user();
            $profile = Profile::where('user_id', $user->id)
                ->first();
            return response()->json(compact('universities', 'user', 'profile'), 200);
        } catch (\Exception $e) {
            return ApiResponse::fail(500, $e->getMessage());
        }
    }
}