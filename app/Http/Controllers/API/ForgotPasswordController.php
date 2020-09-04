<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordResetPasswordRequest;
use App\Http\Requests\ForgotPasswordSendCodeRequest;
use App\Http\Requests\ForgotPasswordVerifyCodeRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Tymon\JWTAuth\Facades\JWTAuth;

class ForgotPasswordController extends Controller
{

    public function resetPassword(ForgotPasswordResetPasswordRequest $request)
    {
        try {
            $user = Auth::user();
            $user->password = bcrypt($request->new_password);
            $user->save();

            return response([
                'status' => 'success',
                'message' => 'Your password updated successfully!',
            ], 200);
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage(),
                'status' => 'error'
            ], 422);
        }
    }

    public function verifyCode(ForgotPasswordVerifyCodeRequest $request)
    {
        try {
            if (Cache::has('f_p_'.$request->email)) {
                $code = Cache::get('f_p_'.$request->email);

                if ($request->code == $code) {
                    $user = User::where('email', $request->email)->firstOrFail();
                    $token = JWTAuth::fromUser($user);

                    return response([
                        'status' => 'success',
                        'message' => 'Great! Your email has been verified. You can reset your password now.',
                        'token' => $token,
                    ], 200);
                } else {
                    return response([
                        'message' => 'The verification code is incorrect.',
                        'status' => 'error'
                    ], 422);
                }
            } else {
                return response([
                    'message' => 'The verification code has been expired. Please try to resend.',
                    'status' => 'error'
                ], 422);
            }
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage(),
                'status' => 'error'
            ], 422);
        }
    }

    public function sendCode(ForgotPasswordSendCodeRequest $request)
    {
        try {
            $code = mt_rand(100000,999999);

            Cache::put('f_p_'.$request->email, $code, 600); // 10 minutes

            return response([
                'message' => 'Verfication code sent to '. $request->email,
                'code' => $code,
                'status' => 'success'
            ], 200);
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage(),
                'status' => 'error'
            ], 422);
        }
    }
}
