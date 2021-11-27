@extends('layouts.layout')

@section('home-page_name', 'Футбол - новости футбола, портал, аналитика')

@section('content_main-articles')
    @foreach($posts as $post)
            <section class="content_article @if($post == $posts->last()) last @endif">
                <h3>{{ $post->title }}</h3>
                <h4><a href="#">@if(!is_null($post->categories)){{ $post->categories->title }}.@endif</a> -й тур.</h4>
                <p>{{ Date::parse($post->created_at)->format('j F') }}. Грозный. Стадион "Ахмат Арена".</p>

                <div class="content_article_main">
                    <img src="{{ $post->getFirstMediaUrl('post_images') }}" alt="">
                    <p>
                        {{ $post->preview_text }}
                    </p>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('post.current', ['post' => $post]) }}" class="btn btn-secondary btn-sm">Подробнее</a>
                </div>

                @if(!($post == $posts->last()))
                    <div class="d-flex justify-content-center">
                        <hr>
                    </div>
                @endif
            </section>
    @endforeach
@endsection

