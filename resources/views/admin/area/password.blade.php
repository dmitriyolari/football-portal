@inject('userHelper', 'App\Helpers\Blade\UserHelper')

@extends('admin.layouts.layout')

@section('header')
    <span class="ml-3">{{ $userHelper->userName() }}</span>
@endsection

@section('admin-header-name', 'Изменение пароля')

@section('admin-content')
    @include('layouts.alerts')
    <form action="{{ route('admin.password') }}" method="POST">
        @csrf
        @method('PUT')
        <input name="current_password" type="password" class="mr-2 mb-3" placeholder="Старый пароль"><br>
        <input name="password" type="password" class="mr-2 mb-3" placeholder="Новый пароль"><br>
        <input name="password_confirmation" type="password" class="mr-2 mb-3" placeholder="Подтвердите пароль"><br>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection
