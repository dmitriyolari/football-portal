@extends('layouts.post_layout')

@section('home-page_name')
    Текстовый отчет о матче
@endsection

@section('content_main-articles')
    @include('layouts.alerts')
    <section class="text-center">
        <table class="table table-bordered text-center">
            <thead>
            @if(!is_null($post->categories))
                <tr>
                    <th class="match-statistics--header" colspan="2">
                        {{ $post->categories->title }}
                    </th>
                </tr>
            @endif
            <tr>
                <th class="match-statistics--header" colspan="2">
                    {{ Date::parse($post->created_at)->format('j F') }}. -й тур.
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="match-statistics">Реал Мадрид</td>
                <td class="match-statistics">Осасуна</td>
            </tr>
            <tr>
                <td class="match-statistics">Тибо Куртуа</td>
                <td class="match-statistics">Серхио Эррера</td>
            </tr>
            <tr>
                <td class="match-statistics">Ферлан Менди, 69</td>
                <td class="match-statistics">Мануэль Санчес</td>
            </tr>
            <tr>
                <td class="match-statistics">Давид Алаба</td>
                <td class="match-statistics">Хуан Крус</td>
            </tr>
            <tr>
                <td class="match-statistics">Эдер Милитао</td>
                <td class="match-statistics">Давид Гарсия</td>
            </tr>
            <tr>
                <td class="match-statistics">Даниэль Карвахаль, 69</td>
                <td class="match-statistics">Унай Гарсия</td>
            </tr>
            <tr>
                <td class="match-statistics">Тони Кроос</td>
                <td class="match-statistics">Начо Видаль</td>
            </tr>
            <tr>
                <td class="match-statistics">Каземиро</td>
                <td class="match-statistics">Хави Мартинес, 67</td>
            </tr>
            <tr>
                <td class="match-statistics">Эдуарду Камавинга, 46</td>
                <td class="match-statistics">Лукас Торро</td>
            </tr>
            <tr>
                <td class="match-statistics">Винисиус Жуниор</td>
                <td class="match-statistics">Хон Монкайола, 90</td>
            </tr>
            <tr>
                <td class="match-statistics">Марко Асенсио, 69</td>
                <td class="match-statistics">Кике Гарсия, 89</td>
            </tr>
            <tr>
                <td class="match-statistics">Карим Бензема</td>
                <td class="match-statistics">Эсекьель Авила, 67</td>
            </tr>
            <tr>
                <td class="match-statistics--header" colspan="2">Замены:</td>
            </tr>
            <tr>
                <td class="match-statistics">Родриго, 46</td>
                <td class="match-statistics">Дарко Брашанац, 67</td>
            </tr>
            <tr>
                <td class="match-statistics">Марсело, 69</td>
                <td class="match-statistics">Рубен Гарсия, 67</td>
            </tr>
            <tr>
                <td class="match-statistics">Лукас Васкес, 69</td>
                <td class="match-statistics">Иван Барберо, 89</td>
            </tr>
            <tr>
                <td class="match-statistics">Эден Азар, 69</td>
                <td class="match-statistics">Ойер, 90</td>
            </tr>
            <tr>
                <td class="match-statistics--header" colspan="2">Наказания:</td>
            </tr>
            <tr>
                <td class="match-statistics">Эдуарду Камавинга, 28</td>
                <td class="match-statistics"> Унай Гарсия, 15</td>
            </tr>
            </tbody>
        </table>
        <div class="content_article-wrapper">
            <div class="content_article-full">
                <img src="{{ $post->getFirstMediaUrl('post_images') }}" alt="">
                <p class="text-start">{{ $post->text }}</p>
            </div>
            <div>
                <p>
                    <b>Лучший игрок матча — </b>
                </p>
            </div>
        </div>
    </section>
    <section class="user-comments">
        @guest
            <div class="mb-4">
                Для добавления комментариев
                <a href="{{ route('login.create') }}">Войдите</a> или <a href="{{ route('register.create') }}">Зарегистрируйтесь</a>
            </div>
        @endguest
        @auth
            <div>
                <h6 class="fw-bold">Добавить комментарий</h6>
                <form class="mb-4" action="{{ route('comment.item.store', ['post' => $post]) }}" method="post">
                    <textarea name="text" style="width: 100%" placeholder="Написать комментарий"></textarea>
                    <button class="btn btn-primary float-end" type="submit">Отправить</button>
                    @csrf
                </form>
            </div>
        @endauth
        <h6 class="fw-bold">Комментарии</h6>
        <ul class="p-0 user-comments-list">

            @foreach($comments as $comment)

                @auth
                    <li class="user-comment list-unstyled">
                        <div>@for($i = 0; $i < $comment->lvl*5; $i++)-@endfor</div>
                        <div class="comment-body">
                            <div class="user-comment_name text-primary mr-2">
                                @if($comment->user_id == $user->id)
                                    Я
                                @elseif($comment->user_is_admin)
                                    {{ $comment->user_name }} <span class="text-danger">(администратор)</span>
                                @else
                                    {{ $comment->user_name }}
                                @endif
                            </div>
                            <div class="user-comment_text d-flex justify-content-between">
                                @if(is_null($comment->deleted_at))
                                    <div>{{ $comment->text }}</div>
                                @else
                                    @if($comment->user_id == $user->id)
                                        <div>{{ $comment->text }}</div>
                                    @else
                                        <div><del>Комментарий был удалён</del></div>
                                    @endif
                                @endif
                                @if( $comment->user_id == $user->id() )
                                    @if(is_null($comment->deleted_at))
                                        <form action="{{ route('comment.item.delete', ['comment' => $comment->id]) }}"
                                              method="post">
                                            <button class="btn btn-outline-danger btn-sm" type="submit">Удалить</button>
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @else
                                        <form action="{{ route('comment.item.restore', ['comment' => $comment->id]) }}"
                                              method="post">
                                            <button class="btn btn-outline-warning btn-sm" type="submit">Восстановить
                                            </button>
                                            @csrf
                                        </form>
                                    @endif
                                @endif
                            </div>
                            @if(!is_null($comment->deleted_at))
                                <small class="user-comment_time text-secondary">Удален {{ Date::parse($comment->deleted_at)->ago() }}</small>
                            @else
                                <small class="user-comment_time text-secondary">{{ Date::parse($comment->created_at)->ago() }}</small>
                            @endif
                            @if(is_null($comment->deleted_at))
                                <div class="user-comment list-unstyled mb-2">
                                    <form class="mb-4"
                                          action="{{ route('comment.item.answer', ['post' => $post, 'comment' => $comment->id]) }}"
                                          method="post">
                                        <div class="d-flex flex-row-reverse mb-2">
                                            @if(!($comment->user_id == $user->id))
                                                <textarea name="text" style="width: 97%">{{ $comment->user_name }}, </textarea>
                                            @else
                                                <textarea name="text" style="width: 97%" placeholder="Ответить себе"></textarea>
                                            @endif
                                        </div>
                                        <div class="d-flex flex-row-reverse">
                                            <button class="btn btn-outline-dark btn-sm float-end" type="submit">Ответить
                                            </button>
                                        </div>
                                        @csrf
                                    </form>
                                </div>
                            @endif
                        </div>

                    </li>





                @endauth
                @guest

                        <li class="user-comment list-unstyled mb-2">
                            <div>@for($i = 0; $i < $comment->lvl*5; $i++)-@endfor</div>
                            <div class="comment-body">
                                <div class="user-comment_name text-primary mr-2">
                                    @if($comment->user_is_admin)
                                        {{ $comment->user_name }} <span class="text-danger">(администратор)</span>
                                    @else
                                        {{ $comment->user_name }}
                                    @endif
                                </div>
                                <div class="user-comment_text d-flex justify-content-between">
                                    @if(is_null($comment->deleted_at))
                                        <div>{{ $comment->text }}</div>
                                    @else
                                        <div><del>Комментарий был удалён</del></div>
                                    @endif
                                </div>
                                @if(!is_null($comment->deleted_at))
                                    <small class="user-comment_time text-secondary">Удален {{ Date::parse($comment->deleted_at)->ago() }}</small>
                                @else
                                    <small class="user-comment_time text-secondary">{{ Date::parse($comment->created_at)->ago() }}</small>
                                @endif
                            </div>
                        </li>

                @endguest
            @endforeach
        </ul>
    </section>
@endsection
