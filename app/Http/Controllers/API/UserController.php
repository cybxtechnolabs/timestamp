<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Mail\UserRegisteredMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function changePassword(Request $request)
    {
        $rules = [
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first(),
                'status' => 'error'
            ], 422);

        }

        $user = auth()->user();
        if (Auth::once(['email' => $user->email, 'password' => $request->current_password])) {
            $user->update([
                'password' => bcrypt($request->new_password)
            ]);

            return response([
                'message' => 'Your password changed successfully!',
                'status' => 'success'
            ], 200);

        } else {
            return response([
                'message' => 'Your current password does not match.',
                'status' => 'error'
            ], 422);
        }
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
        ]);

        return response(['user' => auth()->user(), 'message' => 'Profile updated successfully!', 'status' => 'success'], 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            $token = JWTAuth::attempt($credentials);

            if (!$token) {
                $data['message'] = 'Your email and password does not match.';
                $data['status'] = 'error';
                return response($data, 422);


            } else {
                $user = JWTAuth::user();
                if ($user->isAccountVerified()) {
                    $data['message'] = 'Please verify your account first.';
                    $data['status'] = 'error';
                    return response($data, 422);
                }

                $data['token'] = $token;
                $data['user'] = $user;
                $data['message'] = 'You have beed logged in successfully!';
                $data['status'] = 'success';
                return response($data, 200);
            }
        } catch (JWTException $e) {
            $data['message'] = 'Server error. Unable to process your request.';
            $data['status'] = 'error';

            return response($data, 422);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);

        if($validator->fails()) {

            return response([
                'message' => $validator->errors()->first(),
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'user_type' => 'user'
        ]);

        $token = JWTAuth::fromUser($user);

        $emailVerificationKey = Str::random(100);
        $user->emailVerification()->create(['code' => $emailVerificationKey]);
        Mail::to($user)->send(new UserRegisteredMail($user));

        $data['user'] = $user;
        $data['token'] = $token;
        $data['status'] = 'success';
        $data['message'] = 'Your account created successfully!';

        return response($data, 200);
    }

    public function getAuthenticatedUser()
        {
            try {
                if (! $user = JWTAuth::parseToken()->authenticate()) {
                    $data['message'] = 'User not found';
                    $data['status_code'] = 404;
                    return response()->json($data);
                }
            } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

                $data['message'] = 'Token expired';
                $data['status_code'] = $e->getStatusCode();
                return response()->json($data);
            } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

                $data['message'] = 'Token invalid';
                $data['status_code'] = $e->getStatusCode();
                return response()->json($data);
            } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

                $data['message'] = 'Token absent';
                $data['status_code'] = $e->getStatusCode();
                return response()->json($data);
            }

            $data['user'] = $user;
            $data['status_code'] = 200;
            return response()->json($data);
        }
}
