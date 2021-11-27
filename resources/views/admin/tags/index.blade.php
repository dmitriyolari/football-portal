@extends('admin.layouts.layout')

@section('admin-header-name', 'Список тегов')

@section('header', 'Список тегов')

@section('admin-content')
    <div>
        <a class="btn btn-success mb-2" href="{{ route("admin.tags.item.create") }}">Создать</a>
    </div>
    <table class="table table-bordered text-center" class="align-middle">
        <thead>
        <tr>
            <th>ID</th>
            <th>Слаг</th>
            <th>Название</th>
            <th>Создан</th>
            <th>Изменить</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tags as $tag)
            <tr>
                <td class="align-middle">{{ $tag->id }}</td>
                <td class="align-middle">{{ $tag->slug }}</td>
                <td class="align-middle">{{ $tag->title }}</td>
                <td class="align-middle">{{ $tag->created_at->format('d-m-Y H:i:s') }}</td>
                <td class="align-middle">
                    <a class="btn btn-warning" title="{{ $tag->updated_at->format('d-m-Y H:i:s') }}" href="{{ route("admin.tags.item", ['tag' => $tag->id]) }}">Редактировать</a>
                </td>
                <td class="align-middle">
                    <form action="{{ route("admin.tags.item.delete", ['tag' => $tag]) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" title="" type="submit">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
