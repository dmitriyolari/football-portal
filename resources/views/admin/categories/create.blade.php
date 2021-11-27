@extends('admin.layouts.layout')

@section('header', 'Создание категории')

@section('admin-header-name', 'Создание категории')

@section("admin-content")
    <form action="{{ route("admin.categories.item.store") }}" method="POST">
        <div>
            <label class="label">
                <h6>Слаг</h6>
                <input name="slug" type="text" class="label_input">
            </label>
        </div>

        <div>
            <label class="label">
                <h6>Название</h6>
                <input name="title" type="text" class="label_input">
            </label>
        </div>

        <div>
            <label class="label">
                <h6>Предпросмотр</h6>
                <textarea name="preview_text" type="text" rows="10" class="label_input"></textarea>
            </label>
        </div>
        @csrf
        <button class="btn btn-success" type="submit">Создать</button>
    </form>
@endsection
