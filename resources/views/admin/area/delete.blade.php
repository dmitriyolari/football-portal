@inject('userHelper', 'App\Helpers\Blade\UserHelper')

@extends('admin.layouts.layout')

@section('header')
    <span class="ml-3">{{ $userHelper->userName() }}</span>
@endsection

@section('admin-header-name', 'Удаление аккаунта')

@section('admin-content')
    @include('layouts.alerts')
    <form action="{{ route('admin.account.delete') }}" method="POST">
        @csrf
        @method('DELETE')
        <input name="current_password" type="password" class="mr-2 mb-3" placeholder="Введите пароль"><br>
        <button type="submit" class="btn btn-danger">Удалить</button>
    </form>
@endsection
