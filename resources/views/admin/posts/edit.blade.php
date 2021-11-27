@extends('admin.layouts.layout')

@section('header')
    <div>Редактирование статьи {{ $post->title }}</div>
@endsection

@section('admin-header-name', 'Редактирование статьи')

@section("admin-content")
    <form action="{{ route("admin.posts.item.update", ['post' => $post]) }}" enctype="multipart/form-data" method="POST">
        <div>
            <label class="label">
                <h6>Слаг</h6>
                <input name="slug" type="text" value="{{ $post->slug }}" class="label_input">
            </label>
        </div>

        <div class="mt-3">
            <label class="label">
                <h6>Название</h6>
                <input name="title" type="text" value="{{ $post->title }}" class="label_input">
            </label>
        </div>

        <div>
            <label class="label">
                <h6>Предпросмотр</h6>
                <textarea name="preview_text" type="text" rows="10" class="label_input">{{ $post->preview_text }}</textarea>
            </label>
        </div>

        <div>
            <label class="label">
                <h6>Текст</h6>
                <textarea name="text" rows="10" class="label_input">{{ $post->text }}</textarea>
            </label>
        </div>
        <select name="category_id" class="mb-2 label">
            <option value="{{null}}" selected>Выберите категорию</option>
            @foreach($categories as $category => $value)
                <option value="{{ $category }}" @if ((!is_null($post->categories)) && ($post->categories->id == $category))selected @endif>{{ $value }}</option>
            @endforeach
        </select>

        <ul class="list-unstyled mt-2">
            @foreach($tags as $tag => $value)
                <li>
                    <label class="label">
                        <input type="checkbox" name="tags[]" value="{{ $tag }}" @if($post->tags->where('id', $tag)->first())checked @endif>
                        {{ $value }}
                    </label>
                </li>
            @endforeach
        </ul>
        @foreach($post->getMedia('post_images') as $media)
            <img src="{{ $media->getFullUrl() }}" alt=""><br>
            <label class="label">
                <input type="checkbox" name="image_delete" value="{{ true }}">
                Удалить изображение
            </label>
        @endforeach
        <div>
            <label class="label">
                <h6>Изображение</h6>
                <input name="image" type="file" class="label_input">
            </label>
        </div>
        @csrf
        <button class="btn btn-warning mt-2" type="submit">Обновить</button>
    </form>
@endsection
