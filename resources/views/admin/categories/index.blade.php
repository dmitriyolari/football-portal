@extends('admin.layouts.layout')

@section('header', 'Список категорий')

@section('admin-header-name', 'Список категорий')

@section("admin-content")
    <div>
        <a class="btn btn-success mb-2" href="{{ route("admin.categories.item.create") }}">Создать</a>
    </div>
    <table class="table table-bordered text-center">
        <thead>
        <tr>
            <th>ID</th>
            <th>Слаг</th>
            <th>Название</th>
            <th>Предпросмотр</th>
            <th>Создан</th>
            <th>Изменить</th>
            <th>Статьи</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td class="align-middle">{{ $category->id }}</td>
                <td class="align-middle">{{ $category->slug }}</td>
                <td class="align-middle">{{ $category->title }}</td>
                <td class="align-middle">{{ $category->preview_text }}</td>
                <td class="align-middle">{{ $category->created_at->format('d-m-Y H:i:s') }}</td>
                <td class="align-middle">
                    <a class="btn btn-warning" title="{{ $category->updated_at->format('d-m-Y H:i:s') }}" href="{{ route("admin.categories.item", ['category' => $category->id]) }}">Редактировать</a>
                </td>
                <td class="align-middle">{{ count($category->posts) }}</td>
                <td class="align-middle">
                    <form action="{{ route("admin.categories.item.delete", ['category' => $category->id]) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" type="submit">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
