<?php namespace App\Http\Controllers;

use App\EmailVerification;

class UserController extends Controller {

    public function verifyEmail($code)
    {
        $emailVerification = EmailVerification::where('code', $code)->first();

        if ($emailVerification) {
            $user = $emailVerification->user;
            $user->email_verified_at = now();
            $user->save();

            $emailVerification->delete();

            return view('alerts.success')->with('message', 'Great! Your account verified successfully! You can continue to login with app.');

        } else {
            abort(403, 'The email verification code has been expired.');
        }
    }
}
