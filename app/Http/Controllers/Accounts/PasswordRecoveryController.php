<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRecoveryRequest;
use App\Mail\PasswordRecovery;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;

class PasswordRecoveryController extends Controller
{

    /**
     * @return View
     */
    public function passwordRecoveryForm(): View
    {
        return view('user.password_recovery');
    }

    /**
     * @param PasswordRecoveryRequest $request
     * @return View
     */
    public function passwordRecoverySendToEmail(PasswordRecoveryRequest $request):View
    {
        $user = User::where('email', $request['email'])->first();
        $user_email = $user->email;
        if ($request->validated()) {
            Mail::to('dumitrashikeu@gmail.com')->send(new PasswordRecovery($user));
        }

        return view('user.password_recovery-confirmation')->with(['user_email' => $user_email]);
    }

}
