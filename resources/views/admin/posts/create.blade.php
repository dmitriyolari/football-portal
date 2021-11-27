@extends('admin.layouts.layout')

@section('header', 'Создание статьи')

@section('admin-header-name', 'Создание статьи')

@section("admin-content")
    <form action="{{ route("admin.posts.item.store") }}" enctype="multipart/form-data" method="POST">
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

        <div>
            <label class="label">
                <h6>Текст</h6>
                <textarea name="text" type="text" rows="10" class="label_input"></textarea>
            </label>
        </div>

        <select name="category_id" class="label">
            <option value="{{ null }}" selected>Выберите категорию</option>
            @foreach($categories as $category => $value)
                <option value="{{ $category }}">{{ $value }}</option>
            @endforeach
        </select>
        <ul class="list-unstyled mt-2">
            @foreach($tags as $tag => $value)
                <li>
                    <label class="label">
                        <input type="checkbox" name="tags[]" value="{{ $tag }}">
                        {{ $value }}
                    </label>
                </li>
            @endforeach
        </ul>
        <div>
            <label class="label">
                <h6>Изображение</h6>
                <input name="image" type="file" class="label_input">
            </label>
        </div>
        @csrf
        <button class="btn btn-success" type="submit">Создать</button>
    </form>
@endsection
