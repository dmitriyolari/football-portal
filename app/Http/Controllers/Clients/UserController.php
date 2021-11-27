<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PersonalArea\DeleteAccountRequest;
use App\Http\Requests\User\PersonalArea\UpdateEmailRequest;
use App\Http\Requests\User\PersonalArea\UpdateNameRequest;
use App\Http\Requests\User\PersonalArea\UpdatePasswordRequest;
use App\Models\User;
use App\Services\User\UserChangeSubscriptionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * @return View
     */
    public function personalArea(): View
    {
        return view('client.area');
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
        return view('client.password');
    }

    /**
     * @param UpdatePasswordRequest $request
     * @return RedirectResponse
     */
    public function editPassword(UpdatePasswordRequest $request): RedirectResponse
    {
        Auth::user()->update(['password' => bcrypt($request->password)]);

        return redirect()->route('user.area')->with('success', 'Пароль изменен');
    }

    /**
     * @return View
     */
    public function deleteAccountForm(): View
    {
        return view('user.delete');
    }

    public function deleteAccount(DeleteAccountRequest $request, User $user)
    {
        if ($request->validated()) {
            User::destroy($request->user()->id);

            return redirect()->home()->with('success-registration', 'Аккаунт был удален');
        }
    }

    /**
     * @param UserChangeSubscriptionService $service
     * @return RedirectResponse
     */
    public function returnSubscription(UserChangeSubscriptionService $service): RedirectResponse
    {
        $service->returnSubscription();
        session()->flash('success', 'Вы вернули подписку');

        return redirect()->back();
    }

    /**
     * @param UserChangeSubscriptionService $service
     * @return RedirectResponse
     */
    public function cancelSubscription(UserChangeSubscriptionService $service): RedirectResponse
    {
        $service->cancelSubscription();
        session()->flash('success', 'Вы вернули подписку');

        return redirect()->back()->with(['success' => 'Вы отменили подписку']);
    }
}
