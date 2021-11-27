@extends('layouts.layout')

@section('home-page_name', 'Удаление аккаунта')

@section('personal-area-header')
    <h4 class="mb-3 ms-3">Удаление аккаунта</h4>
@endsection

@section('personal_area-body')
    <section class="mt-2 ms-3">
        <h6>Введите пароль</h6>
        @include('layouts.alerts')
        <form action="{{ route('user.account.delete') }}" method="POST">
            @csrf
            @method('DELETE')
            <input name="current_password" type="password" class="mr-2 mb-3" placeholder="Текущий пароль"><br>
            <button type="submit" class="btn btn-danger">Удалить</button>
        </form>
    </section>
@endsection
