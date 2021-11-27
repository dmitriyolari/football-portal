@extends('admin.layouts.layout')

@section('header', 'Создание тега')

@section('admin-header-name', 'Создание тега')

@section("admin-content")
    <form action="{{ route("admin.tags.item.store") }}" method="POST">
        <div>
            <label class="label">
                <h6>Слаг</h6>
                <input name="slug" type="text" class="label_input">
            </label>
        </div>

        <div class="mb-4">
            <label class="label">
                <h6>Название</h6>
                <input name="title" type="text" class="label_input">
            </label>
        </div>
        @csrf
        <button type="submit" class="btn btn-success">Создать</button>
    </form>
@endsection
