@extends('admin.layouts.layout')

@section('admin-header-name', 'Список статей')

@section('header', 'Список статей')

@section("admin-content")
    <div>
        <a class="btn btn-success mb-2" href="{{ route("admin.posts.item.create") }}">Создать</a>
    </div>
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Категория</th>
                <th>Слаг</th>
                <th>Название</th>
                <th>Предпросмотр</th>
                <th>Текст</th>
                <th>IMG</th>
                <th>Комменты</th>
                <th>Создан</th>
                <th>Изменить</th>
                <th>Удален</th>
            </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td class="align-middle">{{ $post->id }}</td>
                <td class="align-middle">@if(!is_null($post->categories)) {{ $post->categories->title }} @else - @endif</td>
                <td class="align-middle">{{ $post->slug }}</td>
                <td class="align-middle">{{ $post->title }}</td>
                <td class="align-middle">{{ $post->preview_text }}</td>
                <td class="align-middle">{{ $post->text }}</td>
                <td class="align-middle"><img src="{{ $post->getFirstMediaUrl('post_images') }}" alt="" style="width: 70px"></td>
                <td class="align-middle">{{ count($post->comments) }}</td>
                <td class="align-middle">{{ $post->created_at->format('d-m-Y H:i:s') }}</td>
                <td class="align-middle">
                    @if(is_null($post->deleted_at))
                        <a class="btn btn-warning" title="{{ $post->updated_at->format('d-m-Y H:i:s') }}" href="{{ route("admin.posts.item", ['post' => $post->id]) }}">Редактировать</a>
                    @else
                        {{ $post->updated_at }}
                    @endif
                </td>
                <td class="align-middle">
                    @if(is_null($post->deleted_at))
                        <form action="{{ route("admin.posts.item.delete", ['post' => $post]) }}" method="POST">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger" type="submit">Удалить</button>
                        </form>
                    @else
                        <form action="{{ route("admin.posts.item.restore", ['post' => $post->id]) }}" method="POST">
                            <button class="btn btn-primary" type="submit" title="{{ $post->deleted_at->format('d-m-Y H:i:s') }}">Восстановить</button>
                            @csrf
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
