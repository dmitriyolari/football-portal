@inject('userHelper', 'App\Helpers\Blade\UserHelper')

@extends('layouts.layout')

@section('home-page_name', 'Личный кабинет')

@section('personal-area-header')
    <h4 class="mb-3 ms-3">Добро пожаловать!</h4>
@endsection

@section('personal_area-body')
    <section class="mt-2 ms-3">
        <h6 class="mb-3">Здесь Вы можете изменить Ваши личные данные</h6>
        @include('layouts.alerts')
        <form action="{{ route('user.name.update', ['name' => $userHelper->userName()]) }}" method="POST" class="mb-3">
            @csrf
            @method('PUT')
            <input name="name" type="text" value="{{ $userHelper->userName() }}" class="mr-2">
            <button type="submit" class="btn btn-primary">Изменить</button>
        </form>
        <form action="{{ route('user.email.update', ['email' => $userHelper->userEmail()]) }}" method="POST" class="mb-3">
            @csrf
            @method('PUT')
            <input name="email" type="text" value="{{ $userHelper->userEmail() }}" class="mr-2">
            <button type="submit" class="btn btn-primary">Изменить</button>
        </form>
        <div class="d-flex">
            <div class="me-2">Подписка на уведомления о новых статьях</div>
            @if($userHelper->isSubscribed())
                <form action="{{ route('user.subscription.cancel') }}" method="POST" class="mb-3">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-secondary btn-sm">Отменить</button>
                </form>
            @else
                <form action="{{ route('user.subscription.return') }}" method="POST" class="mb-3">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-secondary btn-sm">Вернуть</button>
                </form>
            @endif
        </div>
        <div>
            <a href="{{ route('user.password') }}" class="btn btn-warning mb-3">Изменить пароль</a>
        </div>
        <div>
            <a href="{{ route('user.account.form.delete') }}" class="btn btn-danger">Удалить аккаунт</a>
        </div>
    </section>
@endsection
