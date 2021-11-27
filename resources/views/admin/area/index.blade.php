@inject('userHelper', 'App\Helpers\Blade\UserHelper')

@extends('admin.layouts.layout')

@section('header')
    Добро пожаловать, {{ $userHelper->userName() }}!
@endsection

@section('admin-header-name', 'Личный кабинет')

@section('admin-content')
    @include('layouts.alerts')
    <form action="{{ route('admin.name.update', ['name' => $userHelper->userName()]) }}" method="POST" class="mb-3">
        @csrf
        @method('PUT')
        <input name="name" type="text" value="{{ $userHelper->userName() }}" class="mr-2">
        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>
    <form action="{{ route('admin.email.update', ['email' => $userHelper->userEmail()]) }}" method="POST" class="mb-3">
        @csrf
        @method('PUT')
        <input name="email" type="text" value="{{ $userHelper->userEmail() }}" class="mr-2">
        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>
    <div>
        <a href="{{ route('admin.password') }}" class="btn btn-warning mb-3">Изменить пароль</a>
    </div>
    <div>
        <a href="{{ route('admin.account.form.delete') }}" class="btn alert-danger">Удалить аккаунт</a>
    </div>
@endsection
