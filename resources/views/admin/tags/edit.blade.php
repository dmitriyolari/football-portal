@extends('admin.layouts.layout')

@section('header')
    <div>Редактирование тега {{ $tag->title }}</div>
@endsection

@section('admin-header-name', 'Редактирование тега')

@section("admin-content")
    <form action="{{ route("admin.tags.item.update", ['tag' => $tag->id]) }}" method="POST">
        <div>
            <label class="label">
                <h6>Слаг</h6>
                <input name="slug" type="text" value="{{ $tag->slug }}" class="label_input">
            </label>
        </div>

        <div class="mb-4">
            <label class="label">
                <h6>Название</h6>
                <input name="title" type="text" value="{{ $tag->title }}" class="label_input">
            </label>
        </div>

        @csrf
        <button class="btn btn-warning" type="submit">Обновить</button>
    </form>
@endsection
