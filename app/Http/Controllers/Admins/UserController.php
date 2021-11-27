<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\User\UserDeleteService;
use App\Services\User\UserMakeToAdminService;
use App\Services\User\UserRestoreService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $users = User::withTrashed()->get();
        return view('admin.users.index')->with(['users' => $users]);
    }

    /**
     * @param User $user
     * @return RedirectResponse
     */
    public function makeAdmin(User $user, UserMakeToAdminService $service): RedirectResponse
    {
        $service->makeAdmin($user);
        session()->flash('success', "$user->name сделан админом");

        return redirect()->back();
    }

    /**
     * @param User $user
     * @param UserDeleteService $service
     * @return RedirectResponse
     */
    public function delete(User $user, UserDeleteService $service): RedirectResponse
    {
        $service->delete($user);
        session()->flash('success', 'Пользователь удален');

        return redirect()->back();
    }

    /**
     * @param User $user
     * @param UserRestoreService $service
     * @return RedirectResponse
     */
    public function restoreUser(User $user, UserRestoreService $service): RedirectResponse
    {
        $service->restore($user);
        session()->flash('success', 'Пользователь восстановлен');

        return redirect()->back();
    }
}
