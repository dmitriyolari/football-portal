<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PersonalArea\DeleteAccountRequest;
use App\Http\Requests\Admin\PersonalArea\UpdateEmailRequest;
use App\Http\Requests\Admin\PersonalArea\UpdateNameRequest;
use App\Http\Requests\Admin\PersonalArea\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * @param User $user
     * @return View
     */
    public function index(User $user): View
    {
        return view('admin.area.index')->with(['user' => $user]);
    }

    /**
     * @param UpdateNameRequest $request
     * @return RedirectResponse
     */
    public function editName(UpdateNameRequest $request): RedirectResponse
    {
        Auth::user()->update($request->validated());

        return back()->with('success', 'Имя изменено');
    }

    /**
     * @param UpdateEmailRequest $request
     * @return RedirectResponse
     */
    public function editEmail(UpdateEmailRequest $request): RedirectResponse
    {
        Auth::user()->update($request->validated());

        return back()->with('success', 'Email изменен');
    }

    /**
     * @return View
     */
    public function editPasswordForm(): View
    {
        return view('admin.area.password');
    }

    /**
     * @param UpdatePasswordRequest $request
     * @return RedirectResponse
     */
    public function editPassword(UpdatePasswordRequest $request): RedirectResponse
    {
        Auth::user()->update(['password' =>bcrypt($request->password)]);

        return redirect()->route('admin.area.index')->with('success', 'Пароль изменен');
    }

    /**
     * @return View
     */
    public function deleteAccountForm(): View
    {
        return view('admin.area.delete');
    }

    /**
     * @param DeleteAccountRequest $request
     * @param User $user
     * @return RedirectResponse|void
     */
    public function deleteAccount(DeleteAccountRequest $request, User $user)
    {
        if ($request->validated()) {
            User::destroy($request->user()->id);
            return redirect()->home()->with('success', 'Аккаунт был удален');
        }
    }
}
