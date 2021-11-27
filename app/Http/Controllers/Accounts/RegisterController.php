<?php

namespace App\Http\Controllers\Accounts;

use App\DTO\Domain\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterUserRequest;
use App\Mail\GreetingRegisterUser;
use App\Models\User;
use App\Notifications\GreetingRegisterUserNotification;
use App\Services\User\UserRegisterService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

/**
 * Class RegisterController
 *
 * @package App\Http\Controllers
 */
class RegisterController extends Controller
{

    /**
     * @return View
     */
    public function create(): View
    {
        return view('user.create');
    }

    /**
     * @param RegisterUserRequest $request
     * @param UserRegisterService $service
     *
     * @return RedirectResponse
     * @throws UnknownProperties
     */
    public function register(RegisterUserRequest $request, UserRegisterService $service): RedirectResponse
    {
        $user = $service->register(new UserDTO($request->validated()));
        $user->notify(new GreetingRegisterUserNotification());

        session()->flash('success-registration', "Регистрация завершена! Вам отправлено приветственное письмо на $user->email");

        Auth::login($user);
        return redirect()->route('home');
    }

}
