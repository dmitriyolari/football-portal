@extends('admin.layouts.layout')

@section('header')
    <div>Редактирование категории {{ $category->title }}</div>
@endsection

@section('admin-header-name', 'Редактирование категории')

@section("admin-content")
    <form action="{{ route("admin.categories.item.update", ['category' => $category->id]) }}" method="POST">
        <div>
            <label class="label">
                <h6>Слаг</h6>
                <input name="slug" type="text" value="{{ $category->slug }}" class="label_input">
            </label>
        </div>

        <div>
            <label class="label">
                <h6>Название</h6>
                <input name="title" type="text" value="{{ $category->title }}" class="label_input">
            </label>
        </div>

        <div>
            <label class="label">
                <h6>Предпросмотр</h6>
                <textarea name="preview_text" type="text" rows="10" class="label_input">{{ $category->preview_text }}</textarea>
            </label>
        </div>
        @csrf
        <button class="btn btn-warning" type="submit">Обновить</button>
    </form>
@endsection
