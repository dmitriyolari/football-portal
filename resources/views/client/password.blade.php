@extends('layouts.layout')

@section('home-page_name', 'Изменение пароля')

@section('personal-area-header')
    <h4 class="mb-3 ms-3">Изменение пароля</h4>
@endsection

@section('personal_area-body')
    <section class="mt-2 ms-3">
        <h6 class="mb-3">Введите пароли</h6>
        @include('layouts.alerts')
        <form action="{{ route('user.password') }}" method="POST">
            @csrf
            @method('PUT')
            <input name="current_password" type="password" class="mr-2 mb-3" placeholder="Старый пароль"><br>
            <input name="password" type="password" class="mr-2 mb-3" placeholder="Новый пароль"><br>
            <input name="password_confirmation" type="password" class="mr-2 mb-3" placeholder="Подтвердите пароль"><br>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </section>
@endsection
