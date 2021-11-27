<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    /**
     * @return View
     */
    public function loginForm(): View
    {
        return view('user.login');
    }

    /**
     * @param LoginUserRequest $request
     *
     * @return RedirectResponse
     */
    public function login(LoginUserRequest $request): RedirectResponse
    {

        if (Auth::attempt(
            [
                'email' => $request->email,
                'password' => $request->password,
            ]
        )) {
            /** @var User $user */
            $user = Auth::user();
            if ($user->isAdmin()) {
                return redirect()->route("admin.index");
            } else {
                return redirect()->route("home");
            }
        }

        $email = $request->old('email');

        return redirect()->back()->withInput($request->except('password'))->with('error', 'Неправильный логин/пароль');
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
